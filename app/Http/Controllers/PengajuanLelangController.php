<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Pengajuan_lelang;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePengajuan_lelangRequest;
use App\Http\Requests\UpdatePengajuan_lelangRequest;
use App\Mail\PermohonanDisetujui;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Mail;

class PengajuanLelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth('petugas')->check()) {

            return view('admin.lelang.data_pengajuan', [
                'page_header' => 'Permohonan Lelang Konsumen',
                'dataArr' => request()->has('status_pengajuan') ? Pengajuan_lelang::with(['kategori', 'user'])
                    ->where('status_pengajuan', "=", request()->get('status_pengajuan'))->paginate(15)
                    : Pengajuan_lelang::with(['kategori', 'user'])->paginate(15),
                'kategori' => Kategori::all(),
                'user' => User::all(),
            ]);
        }

        $aktif = Pengajuan_lelang::with(['kategori', 'user'])
            ->where('user_id', '=', auth('web')->user()->id)
            ->where('status_pengajuan', '=', 'disetujui')
            ->paginate(15);

        $tidak_aktif = Pengajuan_lelang::with(['kategori', 'user'])
            ->where('user_id', '=', auth('web')->user()->id)
            ->where('status_pengajuan', '=', 'tidak_setujui')
            ->paginate(15);


        return view('web.pengajuan-lelang', [
            'header' => 'Pengajuan Lelang',
            'arsip' => $aktif,
            'data_baru' => $tidak_aktif,
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_pengajuan(Request $request, FlasherInterface $flasher)
    {
        // dd($request->all());
        $data = $request->all();

        $validData = Validator::make($data, [
            'nama_pemilik' => ['required'],
            'nama_barang' => ['required'],
            'kategori_id' => ['required'],
            'harga_barang' => ['required', 'integer'],
            'harga_lelang' => ['required', 'integer'],
            'tgl_mulai' => ['required', 'date'],
            'tgl_akhir' => ['required', 'date'],
        ], [
            'nama_pemilik.required' => 'Input ini harus diisi',
            'nama_barang.required' => 'Input ini harus diisi',
            'kategori_id.required' => 'Input ini harus diisi',
            'harga_barang.required' => 'Input ini harus diisi',
            'harga_barang.integer' => 'Input ini harus berupa angka',
            'harga_lelang.required' => 'Input ini harus diisi',
            'harga_lelang.integer' => 'Input ini harus berupa angka',
            'tgl_mulai.required' => 'Input ini harus diisi',
            'tgl_mulai.date' => 'Input ini harus berupa tanggal',
            'tgl_akhir.required' => 'Input ini harus diisi',
            'tgl_akhir.date' => 'Input ini harus berupa tanggal',
        ]);

        if (!$validData->fails()) {
            $user = User::where('nama_lengkap', $data['nama_pemilik'])->first();

            if ($user != null) {
                Pengajuan_lelang::create([
                    'user_id' => $user->id,
                    'kategori_id' => $data['kategori_id'],
                    'nama_barang' => $data['nama_barang'],
                    'harga_barang' => $data['harga_barang'],
                    'harga_lelang' => $data['harga_lelang'],
                    'lelang_dimulai' => $data['tgl_mulai'],
                    'lelang_diakhiri' => $data['tgl_akhir'],
                ]);
                $flasher->addSuccess('Permohonan Pelelangan Sudah Diajukan, Jika Sudah Disetujui akan kami Kabarkan Melalui Email');

                return back();
            }

            $flasher->addError('User Tidak Ditemukan');

            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengajuan_lelangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePengajuan_lelangRequest $request, FlasherInterface $flasher)
    {
        // dd($request->all());
        if ($request->validated()) {
            Pengajuan_lelang::create([
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'harga_lelang' => $request->harga_lelang,
                'lelang_dimulai' => $request->lelang_dimulai,
                'lelang_diakhiri' => $request->lelang_diakhiri,
            ]);

            $flasher->addSuccess('Berhasil Membuat Data Pengajuan');

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan_lelang  $pengajuan_lelang
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan_lelang $pengajuan_lelang, Request $request)
    {
        if ($request->has('getData') && $request->getData) {
            $data = $pengajuan_lelang->find($request->data);

            return response()->json($data, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan_lelang  $pengajuan_lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan_lelang $pengajuan_lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengajuan_lelangRequest  $request
     * @param  \App\Models\Pengajuan_lelang  $pengajuan_lelang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePengajuan_lelangRequest $request, Pengajuan_lelang $pengajuan_lelang, FlasherInterface $flasher)
    {
        // dd();
        $data = $request->all();

        if ($request->has('status_pengajuan')) {
            $user = User::find($pengajuan_lelang->user_id);

            if ($data['status_pengajuan'] == 'tidak_setujui') {
                $pengajuan_lelang->update([
                    'status_pengajuan' => $data['status_pengajuan']
                ]);

                $flasher->addSuccess('Status Permohonan Diubah');

                return back();
            }

            $pengajuan_lelang->update([
                'status_pengajuan' => $data['status_pengajuan']
            ]);

            $data = $pengajuan_lelang->find($pengajuan_lelang->id);

            Mail::to($user->email)->send(new PermohonanDisetujui($user->nama_lengkap, $data));

            $flasher->addSuccess('Permohonan Disetujui, Email Sudah Terkirim');

            return back();
        }

        $flasher->addSuccess('Terkirim');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan_lelang  $pengajuan_lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan_lelang $pengajuan_lelang, FlasherInterface $flasher)
    {
        if ($pengajuan_lelang->destroy($pengajuan_lelang->id)) {
            $flasher->addSuccess('Berhasil Menghapus Data Pengajuan');

            return back();
        }
        $flasher->addError('Gagal Menghapus Data Pengajuan');

        return back();
    }
}
