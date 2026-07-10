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
}
