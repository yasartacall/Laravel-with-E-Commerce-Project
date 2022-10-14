<!-- category nav -->
@php
    $parentCategories = \App\Http\Controllers\HomeController::categorylist()
@endphp
<!-- category nav -->
  
<div class="category-nav @if (!isset($page)) show-on-click @endif  "> <!-- eğer page diye bişey yoksa anasayfada değilim demektir ve bunu göster dedik bizde-->
    <span class="category-header">Categories <i class="fa fa-list"></i></span>
    <ul class="category-list">

        @foreach($parentCategories as $rs)
            <li class="dropdown side-dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">{{$rs->title}} <i class="fa fa-angle-right"></i></a>
                <div class="custom-menu">
                    <div class="row">

                        @if(count($rs->children))
                            @include('home.categorytree',['children' => $rs->children]) <!-- alt kategorileri var ise categorytree sayfasına gider ve children ismiyle alt kategorilerini yollar -->
                        @endif

                    </div>
                </div>
            </li>
        @endforeach

    </ul>
</div>
<!-- /category nav -->
