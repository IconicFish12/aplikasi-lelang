<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Lelang;

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
            'kategori' => Kategori::all(),
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

            $barang = Barang::create($data);

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
        $validate = $request->validated();

        if ($validate) {
            $data = $request->all();

            if ($request->has('status_lelang')) {
                $input = $barang->find($data['barang_id']);

                if ($data['status_lelang'] == 'ditutup') {
                    $barang->update(['status_lelang' => $data['status_lelang']]);

                    $barang->destroy($input->id);

                    Storage::disk('public_path')->delete($input->foto);

                    $flasher->addSuccess("Pelelangan Ditutup, Data terhapus");

                    return back();
                }

                $lelang = Lelang::create([
                    'barang_id' => $input->id,
                    'harga_awal' => $input->harga_barang,
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_selesai' => $request->tgl_selesai,
                ]);

                if ($lelang) {
                    $barang->update(['status_lelang' => $data['status_lelang']]);

                    $flasher->addSuccess("Pelelangan Dibuka");

                    return back();
                }
                $flasher->addError("Pelelangan Gagal dibuka");

                return back();
            }

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
        } else {
            $flasher->addError("Gagal Merubah Data Barang");

            return back()->withErrors($validate)->withInput();
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
}
