<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PushSubscriptionController extends Controller
{
    /**
     * Store or update a push subscription for the logged-in user or admin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|string|max:500',
            'keys.p256dh' => 'required|string',
            'keys.auth' => 'required|string',
        ]);

        // Detect user guard (web or admin)
        $user = Auth::guard('web')->user() ?? Auth::guard('admin')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $endpoint = $request->endpoint;
        $key = $request->keys['p256dh'];
        $token = $request->keys['auth'];
        $encoding = $request->content_encoding ?? 'aesgcm'; // default content encoding for webpush

        $user->updatePushSubscription($endpoint, $key, $token, $encoding);

        return response()->json(['message' => 'Subscription saved successfully.']);
    }

    /**
     * Delete a push subscription.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'endpoint' => 'required|string|max:500',
        ]);

        $user = Auth::guard('web')->user() ?? Auth::guard('admin')->user();

        if ($user) {
            $user->deletePushSubscription($request->endpoint);
        }

        return response()->json(['message' => 'Subscription deleted successfully.']);
    }

    /**
     * Send a test push notification to the logged-in user's device.
     */
    public function sendTestPush(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('admin')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $dummyAnnouncement = new \App\Models\Announcement([
                'id' => 9999,
                'message' => '🎉 Tes Notifikasi HP Daaru Hiraa Berhasil! Perangkat Anda sudah siap menerima notifikasi pengingat harian.',
                'sound_type' => 'brimo_ai',
                'repeat_type' => 'once',
            ]);

            \Illuminate\Support\Facades\Notification::send($user, new \App\Notifications\AnnouncementNotification($dummyAnnouncement));

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi tes berhasil dikirim ke perangkat Anda!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim notifikasi tes: ' . $e->getMessage()
            ], 500);
        }
    }
}
