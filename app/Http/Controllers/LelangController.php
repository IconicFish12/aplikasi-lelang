<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLelangRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateLelangRequest;
use App\Models\Backup_barang;
use App\Models\History_lelang;
use Spatie\Backup\BackupDestination\Backup;

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
    public function eksekusi_pelelangan(Request $request, FlasherInterface $flasher)
    {
        // dd();
        $input =  $request->all();
        $data = Penawaran::where('harga_penawaran', $request->harga_penawaran)->first();
        // dd($data);

        $validate =  Validator::make($input, [
            "lelang_id" => "required",
            "user_id" => "required",
            "barang_id" => "required",
            "harga_penawaran" => "required",
        ]);

        if (!$validate->fails()) {

            $update = Barang::where('id', $input['barang_id'])->update([
                'status_lelang' => 'ditutup',
                'proses' => 'sudah',
            ]);

            if ($update) {
                $barang = Barang::findOrFail($input['barang_id']);
                $lelang = Lelang::findOrFail($input['lelang_id']);

                $backup = Backup_barang::create([
                    'nama_barang' => $barang->nama_barang,
                    'kategori_id' => $barang->kategori_id,
                    'harga_barang' => $barang->harga_barang,
                    'deskripsi_barang' => $barang->deskripsi_barang,
                    'status_lelang' => $barang->status_lelang,
                    'proses' => $barang->proses
                ]);

                if ($backup) {
                    Storage::disk('public_path')->delete($barang->foto);

                    Barang::destroy($barang->id);

                    Lelang::where('id', $input['lelang_id'])->update([
                        'backup_id' => $backup->id,
                        'user_id' => $input['user_id'],
                        'petugas_id' => auth('petugas')->user()->id,
                        'harga_lelang' => $input['harga_penawaran'],
                        'tgl_lelang' => date(now())
                    ]);

                    History_lelang::create([
                        'lelang_id' => $lelang->id,
                        'penawaran_id' => $data->id,
                    ]);
                }
            }

            $flasher->addSuccess('Barang Telah Dilelang');

            return redirect()->to('admin/daftar-lelang');
        }

        $flasher->addError('Data Tidak Boleh Kosong');

        return back();
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
    public function tambah_penawaran(Request $request, FlasherInterface $flasher)
    {
        // dd($request->all());
        $data = Validator::make($request->all(), [
            'user_id' => "required",
            'barang_id' => "required",
            "harga_penawaran" => "required|integer"
        ], [
            "user_id.required" => "Input Harus Diisi",
            "barang_id.required" => "Input Harus Diisi",
            "harga_penawaran.required" => "Input Harus Diisi",
            "harga_penawaran.integer" => "input Harus berupa angka",
        ]);

        if (!$data->fails()) {
            Penawaran::create($request->all());

            $flasher->addSuccess('Penawaran Telah Diajukan');

            return back();
        }

        return back()->withErrors($data->errors());
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
        $data = $lelang->findOrFail($lelang->id);

        // dd($data->barang_id ==  Barang::find($data->barang_id));

        if ($data->barang_id == Barang::find($data->barang_id)) {
            Barang::find($data->barang_id)->update([
                'status_lelang' => "ditutup",
                'proses' => "belum"
            ]);

            $lelang->destroy($lelang->id);

            $flasher->addSuccess("Data Lelang Berhasil Di Hapus");

            return back();
        } elseif ($data->barang_id != Barang::find($data->barang_id)) {
            $backup = Backup_barang::findOrFail($lelang->backup_id);
            Penawaran::where('barang_id', $lelang->barang_id)->delete();

            Barang::create([
                'nama_barang' => $backup->nama_barang,
                'kategori_id' => $backup->kategori_id,
                'harga_barang' => $backup->harga_barang,
                'deskripsi_barang' => $backup->deskripsi_barang
            ]);

            Backup_barang::destroy($backup->id);

            $lelang->destroy($lelang->id);

            $flasher->addSuccess("Data Lelang Berhasil Di Hapus");

            return back();
        }
        $flasher->addError("Gagal Menghapus Data Lelang");

        return back();
    }

    public function daftar()
    {
        if (request()->has("getData")) {
            $data = Penawaran::with(["barang.kategori", "user"])
                ->where("barang_id", request()->get("data"))
                ->get();

            $tertingi = Penawaran::with(["barang.kategori", "user"])
                ->where("barang_id", request()->get("data"))
                ->orderBy("harga_penawaran", "DESC")->first();

            $lelang = Lelang::with(['barang.kategori', 'user', 'petugas'])
                ->where("barang_id", request()->get('data'))->first();

            return response()->json([$tertingi, $lelang, $data], 200);
        }

        return view('admin.barang_lelang', [
            'dataArr' => Lelang::with(['petugas', 'user', 'barang.kategori'])->paginate(10)
        ]);
    }
}
