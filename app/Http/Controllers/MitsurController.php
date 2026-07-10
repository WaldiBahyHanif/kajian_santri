<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MitsurPair;
use App\Models\MitsurMessage;

class MitsurController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $pair = $user->mitsurPair();
        $partner = null;
        
        if ($pair) {
            $partner = $pair->student_id_1 == $user->id ? $pair->student2 : $pair->student1;
        }

        $checkedItems = [];
        if ($pair && $pair->last_checked_date === now()->toDateString()) {
            $checkedItems = $pair->checked_items ?? [];
        }

        // Query all pairs from the database to build the real leaderboard
        $dbPairs = MitsurPair::with(['student1', 'student2'])->get();
        $leaderboard = [];
        
        foreach ($dbPairs as $p) {
            if ($p->student1 && $p->student2) {
                $name1 = collect(explode(' ', $p->student1->name))->first();
                $name2 = collect(explode(' ', $p->student2->name))->first();
                $isCurrentUser = ($p->student_id_1 == $user->id || $p->student_id_2 == $user->id);
                
                $leaderboard[] = [
                    'name_1' => $name1,
                    'name_2' => $name2,
                    'avatar_1' => $p->student1->avatar ?? ($p->student1->username ?? $p->student1->name),
                    'avatar_2' => $p->student2->avatar ?? ($p->student2->username ?? $p->student2->name),
                    'streak' => $p->current_pair_streak,
                    'score' => $p->current_pair_streak * 85,
                    'is_current_user' => $isCurrentUser
                ];
            }
        }

        // Sort leaderboard by streak desc to show correct rank
        usort($leaderboard, function($a, $b) {
            return $b['streak'] <=> $a['streak'];
        });

        return view('mitsur', compact('pair', 'partner', 'leaderboard', 'checkedItems'));
    }

    public function updateReport(Request $request)
    {
        $user = auth()->user();
        $pair = $user->mitsurPair();

        if (!$pair) {
            return redirect()->back()->with('error', 'Anda belum memiliki partner.');
        }

        $items = $request->input('items', []);
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        $lastChecked = $pair->last_checked_date;
        $currentStreak = $pair->current_pair_streak;
        $checkedCount = count($items);

        // Calculate streak: "dihitung jika mengupdate tiap hari miniimal 2 ceklist baru bisa bertambah streaknya"
        if ($checkedCount >= 2) {
            if ($lastChecked === $today) {
                // If they are updating today and streak was 0 (less than 2 items checked previously today), 
                // check if yesterday was also updated. If yes, increment yesterday's streak (or set to 1).
                // But to keep it simple and robust:
                if ($currentStreak === 0) {
                    // Let's assume streak is 1 or reset. But typically, if they already submitted today and it's 0, we can just set it to 1.
                    $currentStreak = 1; 
                }
            } elseif ($lastChecked === $yesterday) {
                $currentStreak++;
            } else {
                $currentStreak = 1;
            }
        } else {
            // Less than 2 items checked resets the streak to 0
            $currentStreak = 0;
        }

        $pair->update([
            'last_checked_date' => $today,
            'checked_items' => $items,
            'current_pair_streak' => $currentStreak,
        ]);

        return redirect()->route('mitsur')->with('success', 'Laporan harian berhasil diperbarui!');
    }

    public function getMessages(Request $request)
    {
        $user = auth()->user();
        $pair = $user->mitsurPair();

        if (!$pair) {
            return response()->json(['error' => 'No partner.'], 403);
        }

        // Auto-cleanup: Delete messages older than the current month
        MitsurMessage::where('created_at', '<', now()->startOfMonth())->delete();

        // Get messages for this pair
        $messages = MitsurMessage::where('mitsur_pair_id', $pair->id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($user) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'is_own' => $msg->sender_id == $user->id,
                    'sender_name' => $msg->sender_id == $user->id ? 'Anda' : explode(' ', $msg->sender->name)[0],
                    'time' => $msg->created_at->timezone('Asia/Jakarta')->format('H:i'),
                ];
            });

        return response()->json([
            'messages' => $messages,
            'partner_name' => $pair->student_id_1 == $user->id ? explode(' ', $pair->student2->name)[0] : explode(' ', $pair->student1->name)[0],
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $user = auth()->user();
        $pair = $user->mitsurPair();

        if (!$pair) {
            return response()->json(['error' => 'No partner.'], 403);
        }

        // Auto-cleanup: Delete messages older than the current month
        MitsurMessage::where('created_at', '<', now()->startOfMonth())->delete();

        $msg = MitsurMessage::create([
            'mitsur_pair_id' => $pair->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'message' => $msg->message,
                'is_own' => true,
                'sender_name' => 'Anda',
                'time' => $msg->created_at->timezone('Asia/Jakarta')->format('H:i'),
            ]
        ]);
    }
}
