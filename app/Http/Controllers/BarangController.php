<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Kategori;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.barang.daftar_barang', [
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
            $data = $barang->find($request->data);

            $penawaran = Penawaran::where('barang_id', $request->data)->first();
            return response()->json([$data, $penawaran], 200);
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

            if ($request->has('proses')) {
                $barang->update(['proses' => $data['proses']]);

                $flasher->addSuccess("Proses Pelelangan Dirubah");

                return back();
            }

            if ($request->has('status_lelang')) {

                if ($data['status_lelang'] == 'ditutup') {
                    $barang->update([
                        'status_lelang' => $data['status_lelang'],
                        'proses' => 'belum'
                    ]);

                    Lelang::where('barang_id', $barang->id)->delete();

                    $flasher->addSuccess("Pelelangan Ditutup, Data terhapus");

                    return back();
                }

                $valid_data = Validator::make($data, [
                    'tgl_mulai' => ['required', 'date'],
                    'tgl_selesai' => ['required', 'date'],
                ], [
                    'tgl_mulai.required' => "input ini harus diisi",
                    'tgl_mulai.date' => "input ini harus berupa tanggal",
                    'tgl_selesai.required' => "input ini harus diisi",
                    'tgl_selesai.date' => "input ini harus berupa tanggal",
                ]);

                if(!$valid_data->fails()){
                    $lelang = Lelang::create([
                        'barang_id' => $barang->id,
                        'harga_awal' => $barang->harga_barang,
                        'tgl_mulai' => $request->tgl_mulai,
                        'tgl_selesai' => $request->tgl_selesai,
                    ]);

                    if ($lelang) {
                        $barang->update([
                            'status_lelang' => $data['status_lelang'],
                            'proses' => 'sedang'
                        ]);

                        $flasher->addSuccess("Pelelangan Dibuka");

                        return back();
                    }
                }

                $flasher->addError("Pelelangan Gagal dibuka");

                return back()->withErrors($valid_data->errors())->withInput();
            }

            if ($request->hasFile('foto')) {
                if (!is_null($barang->foto) && Storage::disk("public_path")->exists($barang->foto)) {
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
