@extends('admin.dashboard')

@section('content')
<div class="col-md-8 center">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Input Kategori</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
    </div>
  @endif

  @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>{{ $message }}</strong>
    </div>
  @endif
    <form method="POST" action="{{url()->current()}}">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Kategori</label>
          <textarea class="form-control" placeholder="Nama Kategori" name="nama">{{isset($model) ? $model->nama : ''}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Deskripsi Kategori</label>
            <textarea class="form-control" placeholder="Deskripsi Kategori" name="deskripsi">{{isset($model) ? $model->deskripsi : ''}}</textarea>
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