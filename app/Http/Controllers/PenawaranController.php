<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;
use App\Http\Requests\StorePenawaranRequest;
use App\Http\Requests\UpdatePenawaranRequest;
use Illuminate\Support\Facades\Auth;

class PenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.penawaran.data_penawaran', [
            'page_header' => "Data Penawaran Kosumen",
            'dataArr' => Penawaran::with(['barang', 'user'])->paginate(request('paginate') ?? 10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNextPage(Request $request)
    {
        if($request->has('showData') && $request->showData){
            $data = Penawaran::where('barang_id', $request->data)->orderBy('harga_penawaran', 'DESC')->get();

            return response()->json($data, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenawaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenawaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function show(Penawaran $penawaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Penawaran $penawaran)
    {
        return view('web.detail_penawaran', [
            'dataArr' => $penawaran->with(['barang', 'user'])
            ->where('user_id', Auth::guard('web')->user()->id)
            ->paginate(15)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenawaranRequest  $request
     * @param  \App\Models\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenawaranRequest $request, Penawaran $penawaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penawaran  $penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penawaran $penawaran)
    {
        //
    }
}
