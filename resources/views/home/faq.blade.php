@extends('layouts.home')

@section('title',"Frequently Asked Question")


@section('headerjs')

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $( function() {
    $( "#accordion" ).accordion();
    } );
</script>
    
@endsection

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('home')}}">Home</a></li>
            <li class="active">Frequently Asked Question</li>
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
            <div id="accordion">
                @foreach ($datalist as $rs)
                    <h3>{{$rs->question}}</h3> 
                    <div>
                        <p>{!! $rs->answer !!}</p>  
                    </div>
             @endforeach
            </div>
           
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
@endsection