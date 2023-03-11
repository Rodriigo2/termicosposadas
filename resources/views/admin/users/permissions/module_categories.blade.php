<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="tittle"><i class="fa-regular fa-folder-closed"></i> Módulo Categoría</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="categories" @if (kvfj($u->permissions, 'categories')) checked
                    
                @endif>
                <label for="categories">Puede ver el listado de categorias.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="category_add" @if (kvfj($u->permissions, 'category_add')) checked
                    
                @endif>
                <label for="category_add">Puede crear categorias.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="category_edit" @if (kvfj($u->permissions, 'category_edit')) checked
                    
                @endif>
                <label for="category_edit">Puede editar categorias.</label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="category_delete" @if (kvfj($u->permissions, 'category_delete')) checked
                    
                @endif>
                <label for="category_delete">Puede eliminar categorias.</label>
            </div>
        </div>
    </div>
</div>