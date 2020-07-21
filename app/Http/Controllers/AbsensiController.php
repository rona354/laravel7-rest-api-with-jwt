<?php

namespace App\Http\Controllers;

use App\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'waktu_masuk' => 'required|date_format:H:i',
            'waktu_keluar' => 'required|date_format:H:i|after:waktu_masuk',
            'aktivitas' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $absen = Absensi::create(array_merge(
            $validator->validated()
        ));

        return response()->json([
            'message' => 'Absensi berhasil tercatat',
            'data' => $absen
        ], 201);
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
