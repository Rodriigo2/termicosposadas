<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('/static/images/logo.png') }}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">Hola:</span>
            <div class="name">
                {{Auth::user()->name}} {{Auth::user()->lastname}}
                <a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
            <div class="email">{{Auth::user()->email}}</div>
        </div>
    </div>
    <div class="main">
        <ul>
            <li>
                <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fa-solid fa-house-chimney"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ url('/admin/products') }}" class="lk-products lk-product_add lk-product_edit lk-product_gallery_add"><i class="fa-solid fa-boxes-stacked"></i> Productos</a>
            </li>
            <li>
                <a href="{{ url('/admin/categories/0') }}" class="lk-categories lk-category_add lk-category_edit lk-category_delete"><i class="fa-regular fa-folder-closed"></i> Categorías</a>
            </li>
            <li>
                <a href="{{ url('/admin/users') }}" class="lk-user_list"><i class="fa-solid fa-users"></i> Usuarios</a>
            </li>
        </ul>
    </div>
</div>



