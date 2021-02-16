<?php

namespace App\Http\Controllers\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori\KategoriModel;
use DB;

class KategoriController extends Controller
{
    public function index(){
        $title = 'Page Kategori';
        return view('kategori.index', compact('title'));
    }

    public function create(Request $request){
        $model = new KategoriModel();

        $title = 'Buat Kategori Baru';

        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = new KategoriModel();
                $model->nama = $request->nama;
                $model->deskripsi = $request->deskripsi;
                $model->is_delete = 0;
                $model->save();
                DB::commit();
                return redirect('kategori')->with(['success' => 'Kategori baru berhasil disimpan']);
            }catch (\Exception $e){
                return $e;
            }
        }

        return view('kategori.forminput', compact('model', 'title'));
    }

    public function update(Request $request){
        $model = KategoriModel::query()->where(['id' => $request->id])->first();
        $title = 'Update Kategori';

        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = KategoriModel::find($request->id);
                $model->nama = $request->nama;
                $model->deskripsi = $request->deskripsi;
                $model->is_delete;
                $model->save();
                DB::commit();
                return redirect('kategori')->with(['success' => 'Data berhasil di update']);
            }catch(\Exception $e){
                return $e;
            }
        }
        return view('kategori.forminput', compact('model', 'title'));
    }

    public function delete($id){
        $model = KategoriModel::where(['id' => $id])->first();

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
