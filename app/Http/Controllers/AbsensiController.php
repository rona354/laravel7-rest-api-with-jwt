<?php

namespace App\Http\Controllers;

use App\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Absensi::all();
        //mengecek apakah data kosong atau tidak
        if (count($data) > 0) {
            $res['message'] = "Sukses";
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = "Data belum tersedia";
            return response($res);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id_user = $request->input('id_user');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $tanggal_masuk = $request->input('tanggal_masuk');
        $waktu_masuk = $request->input('waktu_masuk');
        $waktu_keluar = $request->input('waktu_keluar');
        $aktivitas = $request->input('aktivitas');

        $data = new Absensi();
        $data->id_user = $id_user;
        $data->latitude = $latitude;
        $data->longitude = $longitude;
        $data->tanggal_masuk = $tanggal_masuk;
        $data->waktu_masuk = $waktu_masuk;
        $data->waktu_keluar = $waktu_keluar;
        $data->aktivitas = $aktivitas;

        if ($data->save()) {
            $res['message'] = "Sukses membuat absensi baru";
            $res['value'] = $data;
            return response($res);
        } else {
            $res['message'] = "Gagal membuat absensi baru";
            $res['value'] = $data;
            return response($res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Absensi::Where('id', $id)->get();
        if (count($data) > 0) {
            $res['message'] = "Success mendapatkan absensi dengan id: $id";
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = "Absensi dengan id : $id tidak ada";
            return response($res);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Absensi::find($id);
        $data->fill($request->all());

        if ($data->save()) {
            $res['message'] = "Sukses update absensi dengan id: $id";
            $res['value'] = $data;
            return response($res);
        } else {
            $res['message'] = "Gagal update absensi dengan id: $id";
            return response($res);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Absensi::where('id', $id)->first();

        if ($data->delete()) {
            $res['message'] = "Sukses menghapus absensi dengan id : $id";
            return response($res);
        } else {
            $res['message'] = "Gagal menghapus absensi dengan id : $id";
            return response($res);
        }
    }
}
