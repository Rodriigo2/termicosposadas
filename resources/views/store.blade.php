@extends('master')

@section('title', 'Tienda')
    
@section('content')
<div class="store">
<div class="row">
    <div class="col-md-3 mtop32">
        <div class="categories_list shadow">
            <h2 class="title"><a href="#"><i class="fa-solid fa-bars-staggered"></i> Categorías</a></h2>
            <ul>
                @foreach ($categories as $category)
                <li><a href="#"><img src="{{url('/uploads/'.$category->file_path.'/'.$category->icono)}}" alt=""> {{ $category->name }}</a></li>
                    
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-9">
        <div class="store_white mtop32">
        <section>
            <h2 class="home_title"><i class="fa-solid fa-store"></i> Últimos productos agregados</h2>
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