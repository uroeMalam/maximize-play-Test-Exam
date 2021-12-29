<?php

namespace App\Http\Controllers;

use App\Models\th_mlm;
use App\Models\tm_pengguna;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class MlmController extends Controller
{
    public function DataTable()
    {
        $table = tm_pengguna::where('id','!=',1);
        return DataTables::of($table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn_detail = '<button type="button" class="btn btn-sm btn-success" id="detail" data-id="' . $row->id . '"><i class="fas fa-eye"></i></button>';
                $btn_edit = '<button type="button" class="btn btn-sm btn-info" id="editData" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                $btn_hapus = '<button type="button" class="btn btn-sm btn-danger" id="hapusData" data-id="' . $row->id . '" data-Text="' . $row->nama . '"><i class="fas fa-trash"></i></button>';
                
                $btn = '<div class="btn-group" role="group" aria-label="LihatData">' .
                    $btn_detail .   
                    $btn_edit .
                    $btn_hapus .
                    '</div>';
                return $btn;
            })
            ->addColumn('jumlah', function ($row) {
                $j = th_mlm::where('id_pengguna',$row->id)->count();
                return $j . ' Orang';
            })
            ->rawColumns(['action','jumlah'])
            ->setRowClass('{{ "border-top-0 text-muted px-2 py-4 "}}') //untuk kasih class di data table
            ->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = tm_pengguna::max('id') +1;
        $data['uid'] = 'MLM'.str_pad($id, 4, '0', STR_PAD_LEFT);
        $data['upline'] = tm_pengguna::all();
        $cek = th_mlm::where('id_pengguna',2)->count();
        // var_dump($cek) or die;
        return view('crud.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = th_mlm::where('id_pengguna',$request->upline)->where('deleted_at',null)->count();
        if ($cek >= 2) {
            return response()->json(['status' => false, 'message' => 'Upline Sudah memiliki 2 Downline']);
        }else{
            $validateData = $request->validate([
                'daftar_nomor_id' => 'required',
                'upline' => 'required',
                'nama' => 'required',
                'nomor_telepon' => 'required',
                'alamat' => 'required',
            ]);
            $get_Pengguna = tm_pengguna::create($validateData);
            th_mlm::create([
                'id_pengguna'=>$request->upline,
                'id_downline'=>$get_Pengguna->id,
                'keterangan'=>'Data Tersimpan',
            ]);
            return response()->json(['status' => true, 'message' => 'berhasil']);

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
        $pengguna = new th_mlm();
        $data['pengguna'] = $pengguna->joinData($id);
        $data['downline'] =$pengguna->Downline($id);
        // var_dump($data['downline']) or die;
        return view('crud.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['id']=$id;
        $pengguna = new th_mlm();
        $data['pengguna'] = $pengguna->joinData($id);
        return view('crud.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required'
        ]);
        tm_pengguna::where('id', $request->id)->update($validateData);
        return response()->json(['status' => true, 'message' => 'berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        tm_pengguna::findOrFail($request->id)->delete();
        th_mlm::where('id_downline',$request->id)->delete();
        return response()->json(['status' => true, 'message' => 'berhasil']);
    }

    public function getDataByID($id)
    {
        $data = tm_pengguna::where('id',$id)->get();
        echo json_encode($data);
    }

}
