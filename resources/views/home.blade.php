@extends('master')

@section('title', 'Inicio')
    
@section('content')
<section>
    <div class="home_action_bar shadow">
        <div class="row">
            <div class="col-md-3">
                <div class="categories">
                    <a href="#"><i class="fa-solid fa-bars-staggered"></i> Categorías</a>
                    <ul class="shadow">
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{url('/store/category/'.$category->id.'/'.$category->slug)}}">
                                <img src="{{url('/uploads/'.$category->file_path.'/'.$category->icono)}}" alt="">
                                {{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                {!! Form::open(['url' => '/search']) !!}
                <div class="input-group">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        {!! Form::text('search_query', null, ['class' => 'form-control', 'placeholder' => '¿Buscas algo?', 'required']) !!}
                        <button class="btn" type="submit" id="button-addon2">Buscar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<section>
    @include('components/sliders_home')
</section>

<section>
    <h2 class="home_title mtop32">Productos destacados</h2>
      <div class="products_list" id="products_list"></div>
        {{-- <div class="load_more_products">
            <a href="#" id="load_more_products">Cargar mas productos</a>
        </div> --}}
</section>
@endsection