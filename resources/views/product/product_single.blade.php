@extends('master')

@section('title', $product->name)

@section('content')

<div class="product_single">
    <div class="container">
        <div class="row">
            <!-- Featureds img & gallery -->
            <div class="col-md-4 pleft0">
                <div class="slick-slider">
                <div>
                <a href="{{url ('/uploads/'.$product->file_path.'/'.$product->image)}}" data-fancybox="gallery">
                <img src="{{url ('/uploads/'.$product->file_path.'/'.$product->image)}}" class="img fluid img-thumbnail">
                </a>
                </div>
                @if(count($product->getGallery)> 0)
                @foreach ($product->getGallery as $gallery)
                <div>
                <a href="{{url ('/uploads/'.$gallery->file_path.'/'.$gallery->file_name)}}" data-fancybox="gallery">
                <img src="{{url ('/uploads/'.$gallery->file_path.'/'.$gallery->file_name)}}" class="img fluid img-thumbnail">
                </a>
            </div>
                @endforeach
                @endif
            </div>
            </div>

            <div class="col-md-8">
                <h2 class="title">{{$product -> name}}
                </h2>
            </div>
        </div>
    </div>
</div>
@endsection