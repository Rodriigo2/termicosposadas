<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-solid fa-boxes-stacked"></i> Módulo Productos</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="products" @if (kvfj($u->permissions, 'products')) checked
                    
                @endif>
                <label for="products">Puede ver el listado de productos.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="products_add" @if (kvfj($u->permissions, 'products_add')) checked
                    
                @endif>
                <label for="products_add">Puede agregar nuevos productos.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="products_edit" @if (kvfj($u->permissions, 'products_edit')) checked
                    
                @endif>
                <label for="products_edit">Puede editar productos.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="products_delete" @if (kvfj($u->permissions, 'products_delete')) checked
                    
                @endif>
                <label for="products_delete">Puede eliminar productos.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="product_gallery_add" @if (kvfj($u->permissions, 'product_gallery_add')) checked
                    
                @endif>
                <label for="product_gallery_add">Puede agregar imágenes a la galería.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="product_gallery_delete" @if (kvfj($u->permissions, 'product_gallery_delete')) checked
                    
                @endif>
                <label for="product_gallery_delete">Puede eliminar imágenes a la galería.</label>
            </div>
        </div>
    </div>
</div>