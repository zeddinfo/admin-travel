<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata\WisataModel;
use Yajra\DataTables\DataTables;

class ApiWisataController extends Controller
{
    public function list(Request $request){
        $list = WisataModel::where('is_delete', 0)->get();

        return DataTables::of($list)
        ->addIndexColumn()
        ->addColumn('gambar', function($data){
            if($data->url_gambar == ''){
                $image = url('storage/file/gambar/no-photo.png');
            } else {
                $image = url('storage/file/gambar/wisata/'.$data->gambar);
            }
            return $image;
            // dd('image', $image);
        })
        ->addColumn('aksi', function($data){
            $button = '';
            $button .= '<a href="'.url("wisata/update/".$data->id).'" title = "Edit" data-id="'.$data->id.'" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i> Edit</a>';
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