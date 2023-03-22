const base = location.protocol+'//'+location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');
var page = 1;
var page_section = "";
var products_list_ids_temp = [];

$(document).ready(function(){
    $('.slick-slider').slick({
        dots:true, infinite:true, autoplay:true, autoplaySpeed: 2000});
});

document.addEventListener('DOMContentLoaded', function(){
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    var slider = new MDSlider;
    var btn_avatar_edit = document.getElementById('btn_avatar_edit');
    var form_avatar_change = document.getElementById('form_avatar_change');
    var avatar_change_overlay = document.getElementById('avatar_change_overlay');
    var input_file_avatar = document.getElementById('input_file_avatar');
    var products_list = document.getElementById('products_list');
    var load_more_products = document.getElementById('load_more_products');
    if (btn_avatar_edit){
        btn_avatar_edit.addEventListener('click', function (e) {
                e.preventDefault();
                input_file_avatar.click();
            })
        }
        if (load_more_products){
            load_more_products.addEventListener('click', function (e) {
                    e.preventDefault();
                    load_products(page_section);
                })
            }
        if(input_file_avatar){
            input_file_avatar.addEventListener('change',function(){
                var load_img = '<img src="'+base+'/static/images/loader_white.svg"/>';
                avatar_change_overlay.innerHTML = load_img;
                avatar_change_overlay.style.display = 'flex';
                form_avatar_change.submit();
            })
        }

        slider.show();

        if(route == "home"){
            load_products('home');
        }
    }
);

function load_products(section){
    page_section = section; 
    var url = base + '/md/api/load/products/'+page_section+'?page='+page;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-Token', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            page = page + 1;
            var data = this.responseText;
            data = JSON.parse(data);
            if(data.data.length == 0){
                load_more_products.style.display = "none";
            }
            data.data.forEach(function(product, index)
            {
                products_list_ids_temp.push(product.id);
                var div="";
                div += "<div class='product'>";
                div += "<div class=\"image\">"
                div +="<div class=\"overlay\">"
                div += "<div class=\"btns\">"
                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\"><i class=\"fa-solid fa-eye\"></i></a>";
                div += "<a href=\"\"><i class=\"fa-solid fa-cart-plus\"></i></a>";
                if(auth == "1"){
                div += "<a href=\"\" id=\"favorite_1_"+product.id+"\" onclick=\"add_to_favorites('"+product.id+"', '1'); return false;\"><i class=\"fa-solid fa-heart\"></i></a>";
                }else{
                    div += "<a href=\"\" id=\"favorite_1_"+product.id+"\" onclick=\"Swal.fire({title:'Oops...', text: 'Hola invitado. Para agregar a favoritos, ingresa a tu cuenta.', icon: 'warning', footer: '<a href='+base+'/login>Iniciar sesión o registrarse</a>'}); return false;\"><i class=\"fa-solid fa-heart\"></i></a>";
                }
                div += "</div>";
                div +="</div>";
                div +="<img src=\""+base+"/uploads/"+product.file_path+"/t_"+product.image+"\"/>";
                div+="</div>";
                div += "<a href=\""+base+"/product/"+product.id+"/"+product.slug+"\" title=\""+product.name+"\">";
                div += "<div class='title'>"+product.name+"</div>";
                div += "<div class='price'>"+currency+product.price+"</div>";
                div += "<div class='options'></div>";
                div += "</div>";
                div += "</a>";
                products_list.innerHTML += div;
            });
            if(auth == "1"){
            mark_user_favorites(products_list_ids_temp);
            products_list_ids_temp = [];
            
            }

        }else{
            //mensaje de error
        }
    }
}

function mark_user_favorites(objects){
    var url = base + '/md/api/load/user/favorites';
    var params = 'module=1&objects='+objects;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-Token', csrfToken);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            data = JSON.parse(data);
            if(data.count > "0"){
                data.objects.forEach(function(favorite, index){
                document.getElementById('favorite_1_'+favorite).removeAttribute('onclick');
                document.getElementById('favorite_1_'+favorite).classList.add('favorite_active');
            });
            }

        }
    }
}

function add_to_favorites(object, module) {
    url = base+'/md/api/favorites/add/'+object+'/'+module;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-Token', csrfToken);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
             data = JSON.parse(data);
            if(data.status == "success"){
                document.getElementById('favorite_'+module+'_'+object).removeAttribute('onclick');
                document.getElementById('favorite_'+module+'_'+object).classList.add('favorite_active');
            }
        }
    }
}

function aviso_login(icon,title,text) {
    Swal.fire(
       { icon:  icon, 
         title: title,
         text:  text,
         footer: '<a href="'+base+'/login">Iniciar sesión o registrarse</a>' 
       });

    }