@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products/1')}}"><i class="fa-solid fa-boxes-stacked"></i>Productos</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">

    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-pen-to-square"></i> Editar producto</h2>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/admin/product/'.$p->id.'/edit', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-12">
                    <label for="name">Nombre de producto:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                    {!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
                </div>
                </div>

            </div>
            <div class="row mtop16">
                <div class="col-md-6">
                    <label for="category">Categoría padre:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! Form::select('category', $cats, $p->category_id, ['class' => 'form-select', 'id' => 'category']) !!}

                        {!! Form::hidden('subcategory_actual', $p->subcategory_id, ['id' => 'subcategory_actual']) !!}
                </div>
                </div>

                <div class="col-md-6">
                    <label for="subcategory">Subcategoría:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! Form::select('subcategory', [], null, ['class' => 'form-select', 'id' => 'subcategory', 'required']) !!}
                </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-3">
                        <label for="indiscount">¿En descuento?:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                            {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->in_discount, ['class' => 'form-select']) !!}
                    </div>
                    </div>

                    <div class="col-md-3">
                        <label for="discount">Descuento:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                            {!! form::number('discount', $p->discount, ['class' => 'form-control', 'min'=>'0.00', 'step' => 'any']) !!}
                    </div>
                    </div>

                    <div class="col-md-3">
                        <label for="discount_until_date">Fecha límite de descuento:</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                            {!! form::date('discount_until_date', $p->discount_until_date, ['class' => 'form-control']) !!}
                    </div>
                    </div>

                    <div class="col-md-3">
                        <label for="img">Imagen destacada:</label>
                        <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        {!! Form::file('img', ['class' => 'form-control', 'id' => 'inputGroupFile01', 'accept'=>'image/*']) !!}
                    </div>
                    </div>
                </div>

                

            </div>

            <div class="row">

                <div class="col-md-3">
                    <label for="code">Código de sistema:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! form::text('code', $p->code, ['class' => 'form-control']) !!}
                </div>
                </div>

                <div class="col-md-3">
                    <label for="status">Estado:</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="fa-solid fa-keyboard"></i></div>
                        {!! Form::select('status', ['0' => 'Borrador', '1' => 'Público'], $p->status, ['class' => 'form-select']) !!}
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="content">Descripción</label>
                    {!! Form::textarea('content', $p->content,['class' => 'form-control', 'id' => 'editor']) !!}
                </div>
            </div>

            <div class="row">
                <div class="mtop8">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-regular fa-image"></i> Imagen Destacada</h2>
            <div class="inside">
                <img src="{{url('/uploads/'.$p->file_path.'/'.$p->image)}}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="panel shadow mtop16">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-images"></i> Galería</h2>
        </div>
        <div class="inside product_gallery">
            @if(kvfj(Auth::user()->permissions, 'product_gallery_add'))
            {!! Form::open(['url' => '/admin/product/'.$p->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
            {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display: none;', 'required']) !!}
            {!! Form::close() !!}

            <div class="btn-submit">
                <a href="#" id="btn_product_file_image"><i class="fa-solid fa-plus"></i></a>
                @endif
            </div>

            <div class="tumbs">
                @foreach ($p->getGallery as $img)
                    <div class="tumb">
                        @if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
                        <a href="{{ url('/admin/product/'.$p->id.'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                        @endif
                        <img src="{{url('/uploads/'.$img->file_path.'/t_'.$img->file_name)}}"> 
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
</div>

</div>
@endsection