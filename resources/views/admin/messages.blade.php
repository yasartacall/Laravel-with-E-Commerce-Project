 @extends('layouts.admin')

 @section('title', ' Contact Messages List')

 @section('content')
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Messages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="# ">Home</a></li>
              <li class="breadcrumb-item active">Messages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        @include('home.message')

        <div class="card">
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email(s)</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Admin Note</th>
                  <th style="width: 5px" colspan="3"> Actions</th>

              </tr>
              </thead>
              <tbody>
                @foreach ($datalist as $rs)
                <tr>
                  <td>{{ $rs->id }}</td>
                  <td>{{ $rs->name }}</td>
                  <td>{{ $rs->email }}</td>
                  <td>{{ $rs->phone }}</td>
                  <td>{{ $rs->subject }}</td>
                  <td>{{ $rs->message }}</td>
                  <td>{{ $rs->note }}</td>
                  <td>{{ $rs->status }}</td>
                 
                  <td>
                    <a href="{{route('admin_message_edit',['id' => $rs->id])}}" onclick="return !window.open(this.href, '','top=50 left=100 width=800,height=600')">
                      <img height="30" src="{{asset('assets/admin/images')}}/edit.png" alt="">
                    </a>
                  </td>
                  <td><a href="{{route('admin_message_delete', ['id' => $rs->id])}}" onclick="return confirm('Delete ! Are you sure?')"><img src="{{asset('assets/admin/images')}}/delete.png" height="25"></a></td>
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