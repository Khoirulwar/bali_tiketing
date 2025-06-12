<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('public/images/contents_images');

        $content = Content::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
        ]);

        return redirect()->route('contents.index')->with('success', 'Content created successfully.');
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'sometimes|image',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($content->image);
            $imagePath = $request->file('image')->store('public/images/contents_images');
            $validated['image'] = $imagePath;
        }

        $content->update($validated);

        return redirect()->route('contents.index')->with('success', 'Content updated successfully.');
    }
    
    public function show($id)
    {
        $contents = Content::findOrFail($id);
        return view('contents.show', compact('contents'));
    }
    // public function detail($id)
    // {
    //     $ticket = Ticket::findOrFail($id);
    //     $paymentConfirmations = PaymentConfirmation::where('ticket_id', $ticket->id)->get();
    
    //     // Mengembalikan view partial yang akan dimuat ke dalam modal
    //     return view('dataTiket.transaksi.detail', compact('ticket', 'paymentConfirmations'));
    // }    

    public function destroy(Content $content)
    {
        Storage::delete($content->image);
        $content->delete();

        return redirect()->route('contents.index')->with('success', 'Content deleted successfully.');
    }
}

