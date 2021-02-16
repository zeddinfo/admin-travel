@extends('admin.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
      {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
      <a href="{{url("/kategori/create")}}" class="btn btn-primary active float-left" role="button"
      > <i class="fa fa-plus"></i> Tambah Data</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>#</th>
          {{-- <th>Gambar</th> --}}
          {{-- <th>Deskripsi</th> --}}
          <th>Kategori</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
   
        </tbody>

      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection

@section('script')
    <script>
      function hapus(param){
        $.confirm({
            title: 'Perhatian',
            content: 'Apakah Anda Yakin akan menghapus data ini?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Hapus: function () {
                  $.ajax({
                    url: `{{url('kategori/delete/${param}')}}`,
                    type: 'POST',
                    data: {
                      "_token": "{{ csrf_token() }}",
                    },
                    success: function (res) {
                        // toastr.info(res.message);
                        $.alert(res.message);
                        $("#example2").DataTable().ajax.reload();
                    }
                  });
                },
                Batalkan: function () {
                    $.alert('Dibatalkan');
                },
            }
        });
      }


        $(document).ready(function(){
            $('#example2').dataTable({
              processing: true,
              serverside: true,
              responsive: true,
              ajax: {
                url: "{{url('api/kategori/list')}}",
                method: "GET",
                dataType: "JSON"
              },
              columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
              },
              {
                data: 'nama',
                name: 'nama',
              },
              {
                data: 'deskripsi',
                name: 'desrkipsi',
              },
              {
                data: 'aksi',
                name: 'aksi',
              }
            ],
            order: [[
              0, 'asc'
            ]]
            })
        })
    </script>
@endsection