@foreach($children as $subcategory) <!-- childrenlarla altkategori  gelir -->
        <ul class="list-links">
            @if(count($subcategory->children)) <!-- altkategorileri var ise -->
            <!--alt kategorisi var ise ismini yazdırdım sonra o alt kategri için tekrar o fonksiyonu çağırdım-->
                <li style="color: #1D00AF;font-family: 'Arial Black' ">   {{$subcategory->title}}</li>
                <ul class="list-links">
                    @include('home.categorytree',['children' => $subcategory->children])
                </ul>
                <hr>
            @else
                <li><a href="{{route('categoryproducts',['id'=>$subcategory->id, 'slug'=>$subcategory->slug])}}">{{$subcategory->title}}</a> </li>
            @endif
        </ul>
@endforeach
