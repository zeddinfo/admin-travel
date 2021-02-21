@extends('admin.dashboard')

@section('content')
<style>
  img.thumbnail {
    vertical-align: middle;
    border-style: none;
    width: 80px;
    height: 80px;
    /* border: 1px solid black; */
    border-radius: 5px;
  }
</style>
<div class="card">
    <div class="card-header">
      {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
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
      <a href="{{url("/armada/create")}}" class="btn btn-primary active float-left" role="button"
      > <i class="fa fa-plus"></i> Tambah Data</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>#</th>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Kategori</th>
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
      // var id = url.substring(url.lastIndexOf('/') + 1);
      
      // function aksiHapus(id){
      //     $.ajax({
      //       url: `{{url('informasi/delete/${id}')}}`,
      //       type: 'POST',
      //       data: {
      //         "_token": "{{ csrf_token() }}",
      //       },
      //       success: function (res) {
      //           // toastr.info(res.message);
      //           alert(res.message);
      //           $("#example2").DataTable().ajax.reload();
      //       }
      //     });
      // }
      
      function hapus(param){
        $.confirm({
            title: 'Perhatian',
            content: 'Apakah Anda Yakin akan menghapus data ini?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Hapus: function () {
                  $.ajax({
                    url: `{{url('armada/delete/${param}')}}`,
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
                url: "{{url('api/armada/list')}}",
                method: "GET",
                dataType: "JSON"
              },
              columns:[
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'gambar', name: 'gambar', render: function(data,type, full, meta){
                  return "<img src=" + data + " class='thumbnail'/>";
                }},
                {data: 'nama', name: 'nama'},
                {data: 'kategori', name: 'kategori'},
                {data: 'aksi', name: 'aksi', width: '20%'}
              ],
              order: [
                [0, 'asc']
              ]
            })
        })
    </script>
@endsection