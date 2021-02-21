<?php

namespace App\Http\Controllers\Informasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Informasi\InfoModel;
use App\Models\Kategori\KategoriModel;
use DB; 
// use Carbon\Carbon;
use Storage;

class InformasiController extends Controller
{
    public function index(){
        $title = 'Informasi';
        return view('informasi.index', compact('title'));
    }
    public function create(Request $request){
        $model = new InfoModel();
        $kategori = KategoriModel::get();
        // dd($model);
        $title = 'Buat Informasi Baru';

        if($request->isMethod('post')){
            // dd($request->all());
            DB::beginTransaction();
            try{
                $model = new InfoModel();
                $model->contact = $request->contact;
                $model->deskripsi = $request->deskripsi;
                $model->alamat = $request->alamat;
                if($request->gambar){
                    // dd($request->gambar->file);
                    $path = $request->gambar;
                    $file = $path;
                    // dd($file->file);
                    $fileName = str_replace(' ','_',$file->getClientOriginalName());
                    $save = $file->storeAs('public/file/gambar/informasi', $fileName);
                    $pathGbr = 'public/file/gambar/informasi/'.$fileName;

                    $model->gambar = $fileName;
                } else {
                    $model->gambar = 'Tidak ada gambar';
                }
                $model->is_delete = 0;
                $model->id_kategori = $request->kategori;
                $model->url_gambar = $request->gambar ? $pathGbr : $model->url_gambar;
                
                $model->save();
                DB::commit();
                return redirect('informasi')->with(['success' => 'Informasi baru berhasil disimpan']);
            } catch(\Exception $e){
                DB::rollBack();
                // return redirect('informasi/create')->with(['danger' => 'Informasi gagal disimpan']);
                return $e;
            }
        }

        return view('informasi.forminput', compact('title', 'model', 'kategori'));
    }

    public function update(Request $request){
        $model = InfoModel::query()->where(['id' => $request->id])->first();
        $title = 'Update Informasi';
        $kategori = KategoriModel::get();
        if($request->isMethod('post')){
            DB::beginTransaction();
            try{
                $model = InfoModel::find($request->id);
                $model->contact = $request->contact;
                $model->deskripsi = $request->deskripsi;
                $model->alamat = $request->alamat;
                if($request->gambar){
                    $path = $request->gambar;
                    $file = $path;
                    // dd($file->file);
                    $fileName = str_replace(' ','_',$file->getClientOriginalName());
                    $save = $file->storeAs('public/file/gambar/informasi', $fileName);
                    $pathGbr = 'public/file/gambar/informasi/'.$fileName;

                    $model->gambar = $fileName;
                } else {
                    $model->gambar = 'Tidak ada gambar(update)';
                }
                $model->is_delete = 0;
                $model->id_kategori = $request->kategori;
                $model->url_gambar = $request->gambar ? $pathGbr : '';

                $model->save();
                DB::commit();
                return redirect('informasi')->with(['success' => 'Data Berhasil di Update']);
            }catch(\Exceptopn $e){
                DB::rollBack();
                return $e;
            }
        }
        return view('informasi.forminput', compact('title', 'model', 'kategori'));
    }

    public function delete($id){
        $model = InfoModel::where(['id' => $id])->first();

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
