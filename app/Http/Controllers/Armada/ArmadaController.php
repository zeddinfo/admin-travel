<?php

namespace App\Http\Controllers\Armada;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Armada\ArmadaModel;
use DB;

class ArmadaController extends Controller
{
    public function index(){
        $title = 'Armada';
        return view('armada.index', compact('title'));
    }
    
    public function create(Request $request){
        $model = new ArmadaModel();
        $title = 'Buat Armada Baru';

        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = new ArmadaModel();
                $model->nama = $request->nama;
                if($request->gambar){
                    $path = $request->gambar;
                    $file = $path;
                    $fileName = str_replace(' ','_',$file->getClientOriginalName());
                    $save = $file->storeAs('public/file/gambar/armada', $fileName);
                    $pathGbr = 'public/file/gambar/armada/'.$fileName;

                    $model->gambar = $fileName;
                } else {
                    $model->gambar = 'Tidak ada gambar';
                }
                $model->is_delete = 0;
                $model->id_kategori = $request->kategori;
                $model->url_gambar = $request->gambar ? $pathGbr : $model->url_gambar;
                $model->save();
                DB::commit();
                return redirect('armada')->with(['success' => 'Data berhasil disimpan']);
            } catch(\Exception $e){
                DB::rollBack();
                return $e;
            }
        }
        return view('armada.forminput', compact('title', 'model'));
    }

    public function update(Request $request){
        $model = ArmadaModel::query()->where(['id' => $request->id])->first();
        $title = 'Update Armada';

        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = ArmadaModel::find($request->id);
                $model->nama = $request->nama;
                          if($request->gambar){
                    $path = $request->gambar;
                    $file = $path;
                    $fileName = str_replace(' ','_',$file->getClientOriginalName());
                    $save = $file->storeAs('public/file/gambar/armada', $fileName);
                    $pathGbr = 'public/file/gambar/armada/'.$fileName;

                    $model->gambar = $fileName;
                } else {
                    $model->gambar = $model->gambar;
                }
                $model->is_delete = 0;
                $model->id_kategori = $request->id_kategori;
                $model->url_gambar = $request->gambar ? $pathGbr : '';
                $model->save();
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
                return $e;
            }
        }
        return view('armada.forminput', compact('title', 'model'));
    }

    public function delete($id){
        $model = ArmadaModel::where(['id' => $id])->first();

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
