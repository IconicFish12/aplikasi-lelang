<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori_barang', [
            'dataArr' => Kategori::paginate(request("paginate") ?? 10),
            'page_header' => 'Kagetori Barang'
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
     * @param  \App\Http\Requests\StoreKategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategoriRequest $request, FlasherInterface $flasher)
    {
        if($request->validated()){
            Kategori::create([
                'nama_kategori'=> $request->nama_kategori
            ]);

            $flasher->addSuccess('Berhasil Menambah Kategori');

            return back();
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori, Request $request)
    {
        if($request->has('getData') && $request->getData){
            return response()->json(Kategori::find($request->data), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKategoriRequest  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori, FlasherInterface $flasher)
    {
        if($request->validated()){
            if($request->nama_kategori == $kategori->nama_kategori){
                $flasher->addInfo("Tidak Ada Yang di Ubah");

                return back();
            }

            $kategori->find($kategori->id)->update([
                'nama_kategori' => $request->nama_kategori
            ]);

            $flasher->addSuccess("Berhasil Merubah Data Kategori");

            return back();
        }
        $flasher->addSuccess("Gagal Merubah Data Kategori");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori, FlasherInterface $flasher)
    {
        if($kategori->destroy($kategori->id)){
            $flasher->addSuccess("Berhasil Menghapus Data Kategori");

            return back();
        }
        $flasher->addError("Gagal Menghapus Data Kategori");

        return back();
    }
}
