 @extends('layouts.admin')

 @section('title', 'Category List')

 @section('content')
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a type="button" class="btn btn-info" href="{{route('admin_category_add')}}">Add Category</a>
        </div>

        <div class="card">
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Id</th>
                <th>Parent</th>
                <th>Title</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($datalist as $rs) <!--datayı foreach ile döndürüyoruz title bilgisini yazdırıyoruz-->
                <tr>
                  <td>{{ $rs->id }}</td>
                  <td>
                    {{ \App\Http\Controllers\Admin\CategoryController::getParentsTree($rs, $rs->title) }}
                  </td>
                  <td>{{ $rs->title }}</td>
                  <td>{{ $rs->status }}</td>
                  <td><a href="{{route('admin_category_edit', ['id' => $rs->id])}}"><img src="{{asset('assets/admin/images')}}/edit.png" height="25"></a></td>
                  <td><a href="{{route('admin_category_delete', ['id' => $rs->id])}}" onclick="return confirm('Delete ! Are you sure?')"><img src="{{asset('assets/admin/images')}}/delete.png" height="25"></a></td>
                </tr>
                @endforeach
              
            </table>
          </div>
        </div>

        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('footer')
  <script src="{{ asset('assets') }}/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
  <!-- DataTables -->
  <script src="{{ asset('assets') }}/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('assets') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets') }}/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('assets') }}/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
  @endsection