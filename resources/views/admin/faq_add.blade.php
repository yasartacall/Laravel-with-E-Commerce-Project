 @extends('layouts.admin')

 @section('title', 'Add FAQ')
 @section('javascript')
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   
      <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
 @endsection
 @section('content')
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add FAQ</li>
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
          <h3 class="card-title">Add FAQ</h3>
        </div>
        <div class="card-body">
          

       
            <!-- form start -->
            <form role="form" action="{{route('admin_faq_store')}}" method="POST" enctype="multipart/form-data"> <!--resim yüklenebilmesi için formun multipart olması gerekiyor.-->
              @csrf <!--güvenliki için-->
              <div class="card-body">
                
                <div class="form-group">
                  <label>Position</label>
                  <input type="number" name="position" class="form-control" value="0"  >
                </div>
                <div class="form-group">
                  <label>Question</label>
                  <input type="text" name="question" class="form-control"  >
                </div>
               
                <div class="form-group">
                  <label>Answer</label>
                  <textarea id="answer" name="answer"></textarea>
                  <script>
                    ClassicEditor
                            .create( document.querySelector( '#answer' ) )
                            .then( editor => {
                                    console.log( editor );
                            } )
                            .catch( error => {
                                    console.error( error );
                            } );
                  </script>
                </div>
               
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control select2" name="status" style="width: 100%;">
                    <option selected="selected">False</option>
                    <option>True</option>
                  </select>
                </div>
                
                
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          
        <!-- /.card-body -->
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