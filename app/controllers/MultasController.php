<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 07/05/2015
 * Time: 02:24 PM
 */


use SysCR\Entities\Multa;
use SysCR\Entities\Persona;
class MultasController extends BaseController{

    public function index($id){

        $multas = Persona::find($id)->multas;
        if($multas->count()>0){
            dd('si tiene');
        }else{
            dd('no tiene');
        }
    }

    public function getPersonasbyMultas($criterio){

        if($criterio=='*'){
            $criterio='';
        }
        $personas = Persona::where('tipo','like','Apoderado')->where(function ($query) use ($criterio){
            $query->where('nombre', 'like','%'.$criterio.'%');
            $query->orWhere('apellidoP', 'like','%'.$criterio.'%');
            $query->orWhere('apellidoM', 'like','%'.$criterio.'%');
        })->paginate(15);

        return View::make('reuniones/viewPersonasByMultas',compact('personas','criterio'));
       // dd('hola');
    }


    public function viewDeudasByPersonas($id){
        //$multas = Persona::find($id)->multas;
        $persona = Persona::find($id);

        return View::make('multas/viewMultas',compact('persona'));

        //dd($multas);
    }

    public function payDeuda(){
        $data = Input::all();


        $multa = Multa::find($data['txtMultaId']);

        $idPersona= $multa->apoderado->id;

        $multa->n_comprobante=$data['nComprobante'];
        $multa->estado='pagado';
        $multa->save();
        return Redirect::route('viewDeudasByPersonas',array('id'=>$idPersona))
            ->with(array('confirm' => 'La deuda a sido paga'));



    }

     public function getMultasByPersona($id){




     }

} 