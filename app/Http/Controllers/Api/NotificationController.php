<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Customer;

class NotificationController extends Controller
{
    public function sendToAll(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string'
        ]);

        $customers = Customer::all();

        foreach ($customers as $customer) {
            Notification::create([
                'user_id' => $customer->user_id,
                'message' => $request->message,
                'title' => $request->title,
            ]);
        }

        return response()->json(['message' => 'Notification sent to all customers'], 200);
    }

    public function sendToSpecific(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'title' => 'required|string'
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Notification sent to the customer'], 200);
    }

    public function getNotifications($userId)
    {
        $notifications = Notification::where('user_id', $userId)->get();
        return response()->json($notifications);
    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Notification deleted'], 200);
    }
}
