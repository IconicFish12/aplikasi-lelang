<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Kategori;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.daftar_barang', [
            'page_header' => "Daftar Barang Pelelang",
            'dataArr' => Barang::with('kategori')->paginate(request("paginate") ?? 10),
            'kategori' => Kategori::all()
        ]);
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
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request, FlasherInterface $flasher)
    {
        if ($request->validated()) {
            $data = $request->all();
            $data['foto'] = $request->file('foto')->store('/images', "public_path");

            Barang::create($data);

            $flasher->addSuccess("Berhasil Menambah Data Barang");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang, Request $request)
    {
        if ($request->has('getData') && $request->getData) {
            return response()->json($barang->find($request->data), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, Barang $barang, FlasherInterface $flasher)
    {
        // dd($request->all());
        if ($request->validated()) {
            $data = $request->all();

            if ($request->hasFile('foto')) {
                if (Storage::disk("public_path")->exists($barang->foto)) {
                    Storage::disk("public_path")->delete($barang->foto);
                }
                $data['foto'] = $request->file('foto')->store('images', "public_path");
            }

            if ($barang->update($data)) {
                $flasher->addSuccess("Berhasil Merubah Data Barang");

                return back();
            }
            $flasher->addError("Gagal Merubah Data Barang");

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang, FlasherInterface $flasher)
    {
        if ($barang->destroy($barang->id)) {
            Storage::disk("public_path")->delete($barang->foto);

            $flasher->addSuccess("Berhasil Menghapus Data Barang");

            return back();
        }
        $flasher->addError("Gagal Menghapus Data Barang");

        return back();
    }

    public function tambah_lelang()
    {
    }
}
