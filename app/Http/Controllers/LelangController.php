<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use App\Http\Requests\StoreLelangRequest;
use App\Http\Requests\UpdateLelangRequest;
use App\Models\Barang;
use App\Models\Penawaran;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.daftar_lelang', [
            "dataArr" => Lelang::with(['petugas', 'user', 'barang'])->paginate(12),
            "page_header" => "Daftar Lelang"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_penawaran(Request $request)
    {
        if ($request->has('getData') && $request->getData) {
            return response()->json(Penawaran::where("barang_id", $request->data), 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLelangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLelangRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function show(Lelang $lelang, Request $request)
    {
        if ($request->has('getData') && $request->getData) {
            return response()->json($lelang->find($request->data), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(Lelang $lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLelangRequest  $request
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLelangRequest $request, Lelang $lelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lelang $lelang, FlasherInterface $flasher)
    {
        if ($lelang->destroy($lelang->id)) {
            $barang = Barang::find($lelang->barang_id)->update([
                'status_lelang' => "ditutup"
            ]);

            $flasher->addSuccess("Berhasil Menghapus Data Lelang");

            return back();
        }
        $flasher->addError("Gagal Menghapus Data Lelang");

        return back();
    }

    public function daftar()
    {
        if (request()->has("getData")) {
            return response()->json(Penawaran::with(["barang", "user"])->where("barang_id", request()->get("data"))->paginate(3), 200);
        }
        return view('admin.barang_lelang', [
            'dataArr' => Lelang::with(['petugas', 'user', 'barang'])->paginate(10)
        ]);
    }
}
