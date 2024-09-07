<?php

namespace App\Http\Controllers;

use App\Models\ExLists;
use Illuminate\Http\Request;

class ExListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exList = ExLists::all();

        return view('index', compact('exList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'fotoMantan' => 'mimes:png,jpg,jpeg|max:5120',
            'status' => 'required',
            'lama_pacaran' => 'required|numeric'
        ]);

        $exListData = [
            'nama' => $request->input('nama'),
            'status' => $request->input('status'),
            'lama_pacaran' => $request->input('lama_pacaran')
        ];

        // Mengecek apakah ada file foto diunggah atau tidak
        if ($request->hasFile('fotoMantan')) {
            $fotoMantan = $request->file('fotoMantan');
            $imageNameMantan = time() . '.' . $fotoMantan->extension();
            $fotoMantan->move(public_path('FotoMantan'), $imageNameMantan); //Simpan Foto Mantan ke dalam folder FotoMantan
            $exListData['fotoMantan'] = 'FotoMantan/' . $imageNameMantan; //Simpan path ke dalam exListData
        }

        ExLists::create($exListData);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $specificEx = ExLists::find($id);
        return view('Features.edit', compact('specificEx'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $specificEx = ExLists::find($id);

        // validate the request
        $request->validate([
            'nama' => 'required|max:255',
            'fotoMantan' => 'mimes:png,jpg,jpeg|max:5120',
            'status' => 'required',
            'lama_pacaran' => 'required|numeric'
        ]);

        $exListData = [
            'nama' => $request->input('nama'),
            'status' => $request->input('status'),
            'lama_pacaran' => $request->input('lama_pacaran')
        ];

        // Mengecek apakah ada file foto diunggah atau tidak
        if ($request->hasFile('fotoMantan')) {
            $fotoMantan = $request->file('fotoMantan');
            $imageNameMantan = time() . '.' . $fotoMantan->extension();
            $fotoMantan->move(public_path('FotoMantan'), $imageNameMantan); //Simpan Foto Mantan ke dalam folder FotoMantan
            $exListData['fotoMantan'] = 'FotoMantan/' . $imageNameMantan; //Simpan path ke dalam exListData

        }else {
            //Jika tidak ada foto baru, gunakan foto lama
            $exListData['fotoMantan'] = $specificEx->fotoMantan;
        }

        $specificEx->update($exListData);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specificEx = ExLists::find($id);
        // Hapus foto mantan dari folder FotoMantan
        if ($specificEx->fotoMantan) {
            $oldImage = public_path($specificEx->fotoMantan);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }
        
        $specificEx->delete();

        return redirect('/');
    }
}
