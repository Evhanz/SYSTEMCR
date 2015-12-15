<?php
/**
 * Created by PhpStorm.
 * User: Evhanz
 * Date: 25/03/15
 * Time: 12:53
 */

use SysCR\Entities\User;
use SysCR\Managers\RegisterManager;
use SysCR\Repositories\PersonaRepo;
use SysCR\Managers\UpdateManager;

class UsersController extends BaseController  {

    protected $personaRepo;

    public function __construct(PersonaRepo $personaRepo) {
        $this->personaRepo = $personaRepo;
    }


    public function index(){
        $personas = User::paginate(10);
        return View::make('users/frmUsuarios',compact('personas'));

    }

    public function getUsuarios(){
        $data = Input::all();
        $criterio =$data['criterio'];

        $personas = User::where('usuario','like','%'.$criterio.'%')->paginate(10);
        return View::make('users/frmUsuarios',compact('personas'));
    }

    public function editUsuario($id){

        $user = User::find($id);
        return View::make('users/account',compact('user'));
    }


    public function signUp(){
        return View::make('users/sign-up');
    }

    public function register(){


        $user = new User();
        $user->user_type = 'usuario';
        $manager = new RegisterManager($user, Input::all());

        //$data = Input::only(['email','password','password_confirmation']);
        /*
        $rules= [
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];
    */
        /*
        $validation = \Validator::make($data,$rules);

        if( $validation->passes())
        {
            $user = new User($data);
            $user->user_type = 'usuario';
            $user->save();
            //User::create($data);
            return Redirect::route('home');
        }
        */

        if($manager->save()){ return Redirect::route('frmUsuarios')->with(array('confirm' => 'Usuario Creado Correctamente'));}

        return Redirect::back()->withInput()->withErrors($manager->getErrors());

       // dd(Input::all());
    }


    public function updateAccount(){

        $data = Input::all();
        //$user = Auth::user();
        $user = User::find($data['id']);
        //dd($user);
        $manager = new UpdateManager($user, Input::all());

        if($manager->save()){ return Redirect::route('home');}

        return Redirect::back()->withInput()->withErrors($manager->getErrors());

        // dd(Input::all());
    }


    //para mostara formulario para la edicion
    public function account(){

        $user = Auth::user();

        return View::make('users/account',compact('user'));


    }


    public function  deleteUsuario(){
        $data = Input::all();
        $user = User::find($data['txtId']);


        try{

        $user->delete();
            return Redirect::back()->with(array('confirm' => 'Usuario Eliminado'));
        }
        catch(Exception $e){
            return Redirect::back()->with(array('fail' => 'UsuarioNo puede ser eliminado, contacte con el Admin'));
        }
    }


} 