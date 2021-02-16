@extends('admin.dashboard')


@section('content')
<div class="col-md-8 center">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Input Armada</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{url()->current()}}" enctype="multipart/form-data">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Deskripsi Informasi</label>
          {{-- <textarea class="form-control" placeholder="deskripsi informasi" name="deskripsi">{{isset($model) ? $model->deskripsi : ''}}</textarea> --}}
            <input type="text" name="nama" class="form-control col-md-7" placeholder="Nama Armada" value="{{isset($model) ? $model->nama : ''}}"/>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Kategori Armada</label>
            <select class="form-control col-md-5" aria-label="Default select example" name="kategori">
                <option selected="selected">{{isset($model) && $model->id_kategori ? $model->id_kategori : 'Silahkan Pilih Kategori'}}</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
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
  @endsection