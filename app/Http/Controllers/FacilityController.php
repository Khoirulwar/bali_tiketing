<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('facilities.index', compact('facilities'));
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
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    try {
        DB::beginTransaction();

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('storage/images'), $imageName);
        }

        Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        DB::commit();

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Gagal menambahkan fasilitas: ' . $e->getMessage());
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (Storage::exists('public/images/'.$facility->image)) {
                Storage::delete('public/images/'.$facility->image);
            }

            // Simpan gambar baru
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/images'), $imageName);
            $facility->image = $imageName;
        }

        $facility->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        // Hapus gambar
        if (Storage::exists('public/images/'.$facility->image)) {
            Storage::delete('public/images/'.$facility->image);
        }

        $facility->delete();
        return redirect()->route('facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
