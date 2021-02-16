<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Armada\ArmadaModel;
use Yajra\DataTables\DataTables;


class ApiArmadaController extends Controller
{
    public function list(){
        $list = ArmadaModel::where('is_delete', 0)->get();
        
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
                $image = url('storage/file/gambar/armada/'.$data->gambar);
            }
            return $image;
        })
        ->addColumn('aksi', function($data){
            $button = '';
            $button .= '<a href="'.url("armada/update/".$data->id).'" title = "Edit" data-id="'.$data->id.'" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> Edit</a>';
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
}
