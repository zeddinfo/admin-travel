<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\InfoModel;
use Yajra\DataTables\DataTables;

class ApiInfoController extends Controller
{
    public function list(){
        $list = InfoModel::where('is_delete', 0)->with('kategori')->get();
        // dd($list);
        return DataTables::of($list)
        ->addIndexColumn()
        ->editColumn('kategori', function($data){
            $kategori = $data->kategori->nama;
            return $kategori;
        })
        ->addColumn('gambar', function($data){
          if($data->url_gambar == ''){
              $image = url('storage/file/gambar/no-photo.png');
          } else {
              $image = url('storage/file/gambar/informasi/'.$data->gambar);
          }
          return $image;
        })
        ->addColumn('aksi', function($data){
            $button = '';
            $button .= '<a href="'.url("informasi/update/".$data->id).'" title = "Edit" data-id="'.$data->id.'" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> Edit</a>';
            $button .= '&nbsp';
            $button .= '<button type="button" title="Hapus" data-id="'.$data->id.'" onclick="hapus('.$data->id.')" class="btn btn-warning btn-sm"> 
                            <i class="fas fa-fw fa-trash"></i> Hapus
                        </button>';
            $button .= '&nbsp';

            return $button;
        })
        ->rawColumns(['aksi'])
        ->make(true);

    }

    public function Api(Request $request){

        $id = $request->id;
        if($id == null){
            $model = InfoModel::where('is_delete', 0)->with('kategori')->get();
        } else {
            $model = InfoModel::query()->where(['id' => $id])->first();
        }

        return response()->json([
            'status' => 200,
            'message' => 'respon plain',
            'data' => $model,
        ]);
    }
}
