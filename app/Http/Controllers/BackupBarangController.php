<?php

namespace App\Http\Controllers;

use App\Models\Backup_barang;
use App\Http\Requests\StoreBackup_barangRequest;
use App\Http\Requests\UpdateBackup_barangRequest;

class BackupBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreBackup_barangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBackup_barangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backup_barang  $backup_barang
     * @return \Illuminate\Http\Response
     */
    public function show(Backup_barang $backup_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backup_barang  $backup_barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Backup_barang $backup_barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBackup_barangRequest  $request
     * @param  \App\Models\Backup_barang  $backup_barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBackup_barangRequest $request, Backup_barang $backup_barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backup_barang  $backup_barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backup_barang $backup_barang)
    {
        //
    }
}
