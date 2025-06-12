<?php

namespace App\Http\Controllers;

use App\Models\TicketPrice;
use Illuminate\Http\Request;

class TicketPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketPrices = TicketPrice::all();
        return view('ticketPrices.index', compact('ticketPrices'));
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
            'adult_price_weekday' => 'required|numeric',
            'child_price_weekday' => 'required|numeric',
            'adult_price_weekend' => 'required|numeric',
            'child_price_weekend' => 'required|numeric',
        ]);

        TicketPrice::create($request->all());
        return redirect()->route('ticket-prices.index')->with('success', 'Ticket price added successfully.');
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
    public function update(Request $request, TicketPrice $ticketPrice)
    {
        $request->validate([
            'adult_price_weekday' => 'required|numeric',
            'child_price_weekday' => 'required|numeric',
            'adult_price_weekend' => 'required|numeric',
            'child_price_weekend' => 'required|numeric',
        ]);

        $ticketPrice->update($request->all());
        return redirect()->route('ticket-prices.index')->with('success', 'Ticket price updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketPrice $ticketPrice)
    {
        $ticketPrice->delete();
        return redirect()->route('ticket-prices.index')->with('success', 'Ticket price deleted successfully.');
    }
}
