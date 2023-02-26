<?php

namespace App\Http\Controllers;

use App\Models\History_lelang;
use App\Http\Requests\StoreHistory_lelangRequest;
use App\Http\Requests\UpdateHistory_lelangRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;

class HistoryLelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lelang.riwayat_lelang', [
            'page_header' => 'Riwayat Pelelangan',
            'dataArr' => History_lelang::with(['kategori', 'petugas', 'user'])->paginate(request('paginate') ?? 25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_pdf()
    {
        // $pdf = FacadePdf::loadview('admin.laporan', [
        //     'title' => 'Laporan Hasil Pelelangan',
        //     'dataArr' => History_lelang::all()
        // ]);

        // return $pdf->stream('laporan.pdf');

        return view('admin.lelang.laporan', [
            'title' => 'Laporan Hasil Pelelangan',
            'dataArr' => History_lelang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHistory_lelangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistory_lelangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function show(History_lelang $history_lelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(History_lelang $history_lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistory_lelangRequest  $request
     * @param  \App\Models\History_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistory_lelangRequest $request, History_lelang $history_lelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(History_lelang $history_lelang)
    {
        //
    }
}
