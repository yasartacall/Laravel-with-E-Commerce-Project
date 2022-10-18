@extends('layouts.home')

@section('title','My Products')

@section('content')

    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('home')}}">Home</a></li>
                <li class="active">User Product</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-2">
                    @include('home.usermenu')
                </div>
                <!-- /ASIDE -->

                <!-- MAIN -->
                
                <div class="card col-md-10">
                    <div class="card-header">
                      <a type="button" class="btn btn-info" href="{{route('user_product_add')}}">Add Product</a>
                      @include('home.message')
                    </div>
            
                    <div class="card">
                      <div class="card-body">
                        
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Category</th>
                              <th>Title(s)</th>
                              <th>Quantitiy</th>
                              <th>Price</th>
                              <th>Image</th>
                              <th>Image Gallery</th>
                              <th>Status</th>
                              <th style="width: 5px" colspan="2"> Actions</th>
            
                          </tr>
                          </thead>
                          <tbody>
                            @foreach ($datalist as $rs)
                            <tr>
                              <td>{{ $rs->id }}</td>
                              <td>
                                {{ \App\Http\Controllers\Admin\CategoryController::getParentsTree($rs->category, $rs->category->title) }}  
                              </td><!--burada aslında category şeyimiz yok ama bi öncekinde yaptığımız ilişkiden dolayı bu şekilde yollayabiliyoruz-->
                              <td>{{ $rs->title }}</td>
                              <td>{{ $rs->quantity }}</td>
                              <td>{{ $rs->price }}</td>
                              <td>
                                @if ( $rs->image ) <!--resim var ise -->
                                    <img src="{{Storage::url($rs->image)}}" height="30" alt="">
                                @endif
                              </td>
                              <td>
                                <a href="{{route('user_image_add',['product_id' => $rs->id])}}" onclick="return !window.open(this.href, '','top=50 left=100 width=1100,height=700')">
                                  <img height="30" src="{{asset('assets/admin/images')}}/gallery.png" alt="">
                                </a>
                              </td>
             
                              <td>{{ $rs->status  }}</td>
                              <td><a href="{{route('user_product_edit', ['id' => $rs->id])}}"><img src="{{asset('assets/admin/images')}}/edit.png" height="25"></a></td>
                              <td><a href="{{route('user_product_delete', ['id' => $rs->id])}}" onclick="return confirm('Delete ! Are you sure?')"><img src="{{asset('assets/admin/images')}}/delete.png" height="25"></a></td>
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

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection
