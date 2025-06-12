<?php

namespace App\Http\Controllers\Api;

use App\Models\PaymentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function confirmPayment(Request $request){
        // $tickets = Ticket::find($request->tickets_id);

        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_owner' => 'required|string',
            'nominal' => 'required|string',
            'transfer_date' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = str_replace('public/', '', $image->store('public/images'));

            $paymentConfirmation = PaymentConfirmation::create([
                // 'tickets' => $tickets->id,
                'ticket_id' => $request->ticket_id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_owner' => $request->account_owner,
                'nominal' => $request->nominal,
                'transfer_date' => $request->transfer_date,
                'image_path' => $path,
            ]);

            return response()->json(['success' => 'Payment confirmed', 'data' => $paymentConfirmation]);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }
}
