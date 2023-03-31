@extends('master')

@section('title', 'Tienda - '. $category->name)

@section('custom_meta')
<meta name="category_id" content="{{ $category->id }}">
@stop
    
@section('content')
<div class="store">
<div class="row">
    <div class="col-md-3 mtop32">
        <div class="categories_list shadow">
            <h2 class="title"><a href="#"><i class="fa-solid fa-bars-staggered"></i> {{ $category->name }}</a></h2>
            <ul>
                @if ($category->parent != "0")
                    <li><a href="{{ url('/store/category/'.$category->getParent->id.'/'.$category->getParent->slug) }}"><small><i class="fa-solid fa-caret-left"></i> Regresar a {{ $category->getParent->name }}</small></a></li>
                @endif
                @if ($category->parent == "0")
                <li><a href="{{ url('/store/') }}"><small><i class="fa-solid fa-caret-left"></i> Regresar a tienda</small></a></li>
                    <li><a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}"><small><i class="fa-solid fa-caret-down"></i> Subcategorías</a></li></small>
                @endif
                @foreach ($categories as $cat)
                <li>
                    <a href="{{url('/store/category/'.$cat->id.'/'.$cat->slug)}}">
                        <img src="{{url('/uploads/'.$cat->file_path.'/'.$cat->icono)}}" alt=""> {{ $cat->name }}
                    </a>
                </li>
                    
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-9">
        <div class="store_white mtop32">
        <section>
            <h2 class="home_title"><i class="fa-solid fa-store"></i> {{ $category->name }}</h2>
              <div class="products_list" id="products_list"></div>
                 <div class="load_more_products">
                    <a href="#" id="load_more_products"><i class="fa-solid fa-paper-plane"></i> Cargar mas productos</a>
                </div> 
        </section>
    </div>
    </div>
</div>
</div>
@endsection