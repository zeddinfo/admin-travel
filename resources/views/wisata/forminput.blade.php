@extends('admin.dashboard')

@section('content')
<div class="col-md-8 center">
  <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Input Wisata</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
          @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <textarea class="form-control" placeholder="tulis disini" name="nama">{{isset($model) ? $model->nama : ''}}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Deskripsi Informasi</label>
            <textarea class="form-control" placeholder="deskripsi informasi" name="deskripsi">{{isset($model) ? $model->deskripsi : ''}}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Gambar Pendukung</label>
            <div class="input-group col-md-5">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Pilih gambar</label>
              </div>
            </div>
            <h6>File Terupload : {{isset($model) ? $model->gambar : '-'}}</h6>
          </div>
        </div>
        <!-- /.card-body -->
  
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.card -->
@endsection