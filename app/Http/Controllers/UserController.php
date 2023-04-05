<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator, Image, Str, Auth, Config, Hash;

use App\Models\User;
use App\Http\Models\Coverage;
use App\Http\Models\UserAddress;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getAccountEdit(){
        $bithday = (is_null(Auth::user()->bithday)) ? [null,null,null] : explode('-',Auth::user()->bithday);
        $data = ['bithday' => $bithday];
        return view('user.account_edit', $data);
    }

    public function postAccountAvatar(Request $request){
      $rules = [
        'avatar' => 'required'
    ];

    $messages = [
        'avatar.required' => 'Seleccione una imagen.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);
    if($validator->fails()):
        return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
    else:
        if($request->hasFile('avatar')):
            $path = '/'.Auth::id();
            $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads_user.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));

            $filename= rand(1,999). '_'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $u = User::find(Auth::id());
            $aa = $u->avatar;
            $u->avatar = $filename;

            if($u->save()):
                if($request->hasFile('avatar')):
                    $fl = $request->avatar->storeAs($path,$filename,'uploads_user');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/av_'.$filename);
                endif;
                unlink($upload_path.'/'.$path.'/'.$aa);
                unlink($upload_path.'/'.$path.'/av_'.$aa);
                return back()->with('message','Avatar actualizado con éxito.')->with('typealert','success');
            endif;
            endif;
    endif;
    }

    public function postAccountPassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];
    
        $messages = [
            'apassword.required' => 'Escriba su contraseña actual.',
            'apassword.min' => 'La contraseña actual debe de tener al menos 8 caracteres.',
            'password.required' => 'Escriba su nueva contraseña.',
            'password.min' => 'La contraseña nueva debe de tener al menos 8 caracteres.',
            'cpassword.required' => 'Confirme su nueva contraseña.',
            'cpassword.min' => 'La confirmación de la nueva contraseña debe de tener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden'
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $u = User::find(Auth::id());
            if(Hash::check($request->input('apassword'), $u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                return back()->with('message','La contraseña se actualizo con éxito')->with('typealert','success');
                endif;
            else:
                return back()->with('message','Su contraseña actual es errónea')->with('typealert','danger');
            endif;
        endif;
    }

    public function postAccountInfo(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:10',
            'year' => 'required',
            'day' => 'required'
        ];
    
        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'lastname.required' => 'Su apellido es requerido.',
            'phone.required' => 'Su número de teléfono es requerido.',
            'phone.min' => 'El número de teléfono debe tener como minimo 10 dígitos.',
            'year.required' => 'Su año de nacimiento es requerido.',
            'day.required' => 'Su día de nacimiento es requerido.'
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $u = User::find(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->bithday = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            $u->gender = e($request->input('gender'));
            if($u->save()):
                return back()->with('message','Su información se actualizo con éxito')->with('typealert','success');
                endif;
        endif;
    }

    public function getAccountAddress(){
        $states = Coverage::where('ctype', '0')->pluck('name','id');
        $data = ['states' => $states];
        return view('user.account_address', $data);
    }

    public function postAccountAddressAdd(Request $request){
        $rules = [
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'add1' => 'required',
            'add2' => 'required',
            'add3' => 'required'
        ];
    
        $messages = [
            'name.required' => 'Es requerido un nombre para la dirección.',
            'state.required' => 'Seleccione una provincia.',
            'city.required' => 'Seleccione una ciudad.',
            'add1.required' => 'Ingrese el nombre de su localidad o barrio.',
            'add2.required' => 'Ingrese su calle / avenida.',
            'add3.required' => 'Ingrese el número de casa / departamento.'
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
        else:
            $address = new UserAddress;
            $address->name = e($request->input('name'));
            $address->user_id = Auth::id();
            $address->state_id = $request->input('state');
            $address->city_id = $request->input('city');
            $info = ['add1' => e($request->input('add1')), 'add2' => e($request->input('add2')), 'add3' => e($request->input('add3')), 'add4' => e($request->input('add4'))];
            $address->addr_info = json_encode($info);
            if(count(collect(Auth::user()->getAddress))== "0"):
                $address->default = "1";
            endif;
            if($address->save()):
                return back()->with('message','La dirección fue guardada con éxito')->with('typealert','success');
                endif;
        endif;
    }

    public function getAccountAddressSetDefault(UserAddress $address){
        if(Auth::id() != $address->user_id):
            return back()->with('message','No puede editar esta dirección de entrega')->with('typealert','danger');
        else:
            //Remove default prew address
            //$default = Auth::user()->getAddressDefault->id;
            $default = UserAddress::find(Auth::user()->getAddressDefault->id);
            $default->default = "0";
            $default->save();

            //New Default Address  
            $address->default = "1";
            if($address->save()):
                return back()->with('message','La dirección se asigno como dirección principal de entrega')->with('typealert','success');
                endif;
        endif;
    }

    public function getAccountAddressDelete(UserAddress $address){
        if(Auth::id() != $address->user_id):
            return back()->with('message','No tienes permiso para eliminar esta dirección.')->with('typealert','danger');
        else:
            if($address->default == "0"):
            if($address->detele()):
                return back()->with('message','La dirección se elimino con éxito.')->with('typealert','success');
            endif;
        else:
            return back()->with('message','No se puede eliminar una dirección principal.')->with('typealert','danger');
        endif;
        endif;
    }
}
