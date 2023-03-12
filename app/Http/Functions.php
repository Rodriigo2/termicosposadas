<?php 


//Key value from Json
function kvfj($json, $key){
    if($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
    
}

function getModulesArray(){
    $a = [
        '0' => 'Productos',
        '1' => 'Blog'
    ];

    return $a;
}


function getRoleUserArray($mode, $id){
    $roles = [
        '0' => 'Usuario normal',
        '1' => 'Administrador'
    ];
    if(!is_null($mode)):
        return $roles;
    else:
        return $roles[$id];
endif;
}

function getUserStatusArray($mode, $id){
    $status = [
        '0' => 'Registrado',
        '1' => 'Verificado',
        '100' => 'Suspendido'
    ];
    if(!is_null($mode)):
        return $status;
    else:
        return $status[$id];
endif;
}

function user_permissions(){
    $p = [
        'dashboard' => [
            'icon' => '<i class="fa-solid fa-house-chimney"></i>',
            'title' => 'Módulo de Dashboard',
            'keys' => [
                'dashboard' => 'Puede ver el dashboard.',
                'dashboard_small_stats' => 'Puede ver el las estadisticas rápidas.',
                'dashboard_sell_today' => 'Puede ver lo facturado del día.',
            ]
            ],
            'products' => [
            'icon' => '<i class="fa-solid fa-boxes-stacked"></i>',
            'title' => 'Módulo de Productos',
            'keys' => [
                'products' => 'Puede ver el listado de productos.',
                'products_add' => 'Puede agregar nuevos productos.',
                'products_edit' => 'Puede editar productos.',
                'products_search' => 'Puede buscar productos.',
                'products_delete' => 'Puede eliminar productos.',
                'products_restore' => 'Puede restaurar productos.',
                'product_gallery_add' => 'Puede agregar imágenes a la galería.',
                'product_gallery_delete' => 'Puede eliminar imágenes a la galería.'
            ]
            ],
            'categories' => [
                'icon' => '<i class="fa-regular fa-folder-closed"></i>',
                'title' => 'Módulo de Categorías',
                'keys' => [
                    'categories' => 'Puede ver el listado de categorias.',
                    'category_add' => 'Puede crear categorias.',
                    'category_edit' => 'Puede editar categorias.',
                    'category_delete' => 'Puede eliminar categorias.'
                ]
                ],
            'users' => [
                'icon' => '<i class="fa-solid fa-users"></i>',
                'title' => 'Módulo de Usuarios',
                'keys' => [
                        'user_list' => 'Puede ver la lista de usuarios.',
                        'user_edit' => 'Puede editar usuarios.',
                        'user_banned' => 'Puede suspender usuarios.',
                        'user_permissions' => 'Puede administrar permisos de usuarios.'
                    ]
                    ],
    ];
    return $p;
}

