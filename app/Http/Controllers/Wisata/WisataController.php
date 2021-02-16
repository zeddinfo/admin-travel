<?php

namespace App\Http\Controllers\Wisata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata\WisataModel;
use DB;

class WisataController extends Controller
{
    public function index(){
        $title = 'Halaman Wisata';
        return view('wisata.index', compact('title'));
    }

    public function create(Request $request){
        $model = new WisataModel();
        $title = 'Buat Data Wisata';

        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = new WisataModel();
                $model->nama = $request->nama;
                $model->deskripsi = $request->deskripsi;
                if($request->gambar){
                    $path = $request->gambar;
                    $file = $path;
                    $fileName = str_replace(' ','_',$file->getClientOriginalName());
                    $save = $file->storeAs('public/file/gambar/wisata', $fileName);

                    $pathGbr = 'public/file/gambar/wisata/'.$fileName;

                    $model->gambar = $fileName;
                
                } else {
                    $model->gambar = 'Tidak ada gambar';
                }
                $model->is_delete = 0;
                $model->url_gambar = $request->gambar ? $pathGbr : $model->url_gambar;
                $model->save();
                DB::commit();
                return redirect('wisata')->with(['success' => 'Data berhasil disimpan']);
            } catch(\Exception $e){
                DB::rollBack();
                return $e;
            }
        }
        return view('wisata.forminput', compact('title', 'model'));
    }

    public function update(Request $request){
        $model = WisataModel::query()->where(['id' => $request->id])->first();
        $title = 'Update Data Wisata';

        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = WisataModel::find($request->id);
                $model->nama = $request->nama;
                $model->deskripsi = $request->deskripsi;
                $model->deskripsi = $request->deskripsi;
                if($request->gambar){
                    $path = $request->gambar;
                    $file = $path;
                    $fileName = str_replace(' ','_',$file->getClientOriginalName());
                    $save = $file->storeAs('public/file/gambar/wisata', $fileName);

                    $pathGbr = 'public/file/gambar/wisata/'.$fileName;

                    $model->gambar = $fileName;
                
                } else {
                    $model->gambar = $model->gambar;
                }
                $model->is_delete = 0;
                $model->url_gambar = $request->gambar ? $pathGbr : $model->url_gambar;
                $model->save();
                DB::commit();
                return redirect('wisata')->with(['success' => 'Data berhasil disimpan']);
            } catch(\Exception $e){
                DB::rollBack();
                return $e;
            }
        }
        return view('wisata.forminput', compact('title', 'model'));
    }

    public function delete($id){
        $model = WisataModel::where(['id' => $id])->first();

        if(empty($model)){
            abort(404);
        }

        DB::beginTransaction();
        try{
            $model->is_delete = 1;
            $model->update();
            DB::commit();
        } catch(\Exception $e){
            DB::rollBack();
            return $e;
        }
        return response()->json([
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
