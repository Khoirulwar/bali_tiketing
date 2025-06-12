<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentConfirmation::all();
        return view('dataTiket.konfirmasiPembayaran.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                'ticket_id' => $request->ticket_id,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'account_owner' => $request->account_owner,
                'nominal' => $request->nominal,
                'transfer_date' => $request->transfer_date,
                'image_path' => $path,
            ]);

            return redirect()->route('payments.index')->with('success', 'Payment confirmation created successfully.');
        }

        return back()->withInput()->withErrors(['image' => 'Image upload failed']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = PaymentConfirmation::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment confirmation deleted successfully.');
    }

    
}
