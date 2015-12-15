<?php

use SysCR\Repositories\PersonaRepo;
use SysCR\Entities\Persona;

class PersonasController extends BaseController {

    protected $personaRepo;

    public function __construct(PersonaRepo $personaRepo){

        $this->personaRepo = $personaRepo;
    }

    public function index(){

        return View::make('personas/allPersonas',compact('personas'));
    }

    public function viewPersona($id){
        $persona = $this->personaRepo->find($id);
        // dd($persona);
        return View::make('personas/viewPersonas',compact('persona'));
    }

    public function selectPersona(){

        $criterio = Input::get('txtCriterio');
        $tipo = strtoupper(Input::get('txtTipo')) ;

        $personas = $this->personaRepo->getAllPersonByCriterioAndTipo($criterio,$tipo);
        //dd($personas);


        return View::make('personas/tablePersonas',compact('personas'));
    }


    //tabla del maestro del detalle
    public function getAllPersonByCriterioAndTipo($criterio){

        $tipo="";
        $personas = $this->personaRepo->getAllPersonByCriterioAndTipo($criterio,$tipo);
        //dd($personas);

        return View::make('personas/tablePersonas',compact('personas'));
    }





    //esta es la funcion principal de seleccionar personas en el FRM principal
    public function getPersonasByCriterioAndTipo($tipo,$criterio){

        $personas = $this->personaRepo->getPersonasByCriterioAndTipo($criterio,$tipo);

        return View::make('personas/frmgetPersonas',compact('personas','tipo','criterio'));

    }
    public function frmNewPersona($tipo){

        if($tipo == 'Alumno'){
            return View::make('personas/frmNewPersona');
        }
        if($tipo == 'Apoderado'){

           // dd($tipo);

            return View::make('personas/frmNewApoderado');
        }

    }

    public function regPersona(){

       // $persona = new Persona();
        $data = Input::all();


        $bandera = $this->personaRepo->regPersona($data);

        if($bandera === 1){
           return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
               ->with(array('confirm' => 'Te has registrado correctamente.'));
        }
        else{
           return Redirect::back()->withInput()->withErrors($bandera);
        }
    }

    public function  editAlumno($tipo,$id){

        $persona = $this->personaRepo->find($id);

       if($persona != null){

           if($tipo == 'Alumno')
           return View::make('personas/frmEditAlumno',compact('tipo','persona'));
           if($tipo == 'Apoderado'){
               $alumnos = $this->personaRepo->getPersonasByApoderados($id);
               return View::make('personas/frmNewApoderado',compact('tipo','persona','alumnos'));
               //dd($alumnos);
           }
       }

    }

    public function  updatAlumno(){

        $data = Input::all();

        //dd($data);
        $bandera = $this->personaRepo->updatAlumno($data);

        if($bandera === 1){
            return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
            ->with(array('confirm' => 'Los Datos an sido Actualizado con exito'));
        }
        else{
            return Redirect::back()->withInput()->withErrors($bandera);
        }

    }

    public function deletAlumno(){
        $id = Input::get('txtId');
        $tipo = Input::get('txtTipo');
        $persona = Persona::find($id);


        if($persona->id>0){

            if($persona->tipo == 'Alumno'){


                try {
                    $persona->delete();
                    return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
                        ->with(array('confirm' => 'El Alumno se a eliminado'));
                }
                catch (Exception $e){
                    return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
                        ->with(array('fail' => 'El Alumno no puede ser eliminado, revise si no existe vinculo con otros datos'));
                }

            }
            if($persona->tipo == 'Apoderado'){

                $yDelet = 1;

                try {
                    $persona->delete();
                }
                catch (Exception $e){
                    $yDelet = 0;
                }

                if($yDelet == 1){
                return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Apoderado','criterio'=>'*'))
                    ->with(array('confirm' => 'El Apoderado se a eliminado'));}
                else
                    return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Apoderado','criterio'=>'*'))
                        ->with(array('fail' => 'El Apoderado no puede ser eliminado, revise si no existe vinculo con otros datos'));

            }


        }else
            return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
                ->with(array('fail' => 'El usuario no existe'));
    }





    public function regApoderado(){


        $data = Input::all();

        $bandera = $this->personaRepo->regApoderado($data);


        if($bandera >=1 ){

            if(isset($data['alumnos'])){
                //declaramos el array de alumnos
                $alumnos = explode(",", $data['alumnos']);
                $res = $this->personaRepo->updateApoderadoAlumno($alumnos,$bandera);

                if($res!=1){
                    $persona = Persona::find($bandera);
                    $persona->delete();
                    return 'Error: Los alumnos no an podido ser actualizados';
                }
            }

        }else
            return 'Error: El Apoderado  no a  podido ser registrado';


        // $persona = new Persona();
        //$data = Input::all();



       // $bandera = $this->personaRepo->regApoderado($data['archivo']);

       // $this->personaRepo->regApoderado($$file);
      //  dd($data['nombre']);
        /*
        $bandera = $this->personaRepo->regPersona($data);

        if($bandera === 1){
            return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
                ->with(array('confirm' => 'Te has registrado correctamente.'));
        }
        else{
            return Redirect::back()->withInput()->withErrors($bandera);
        }*/
    }


    public function updatApoderado(){

        $data = Input::all();

        //dd($data);

        $bandera = $this->personaRepo->updatApoderado($data);

        if($bandera >=1 ){

            $this->personaRepo->deleteApoderadoAlumno($bandera);

            if(isset($data['alumnos'])){
                //declaramos el array de alumnos
                $alumnos = explode(",", $data['alumnos']);
                $res = $this->personaRepo->updateApoderadoAlumno($alumnos,$bandera);

                if($res!=1){
                    $persona = Persona::find($bandera);
                    $persona->delete();
                    return 'Error: Los alumnos no an podido ser actualizador';
                }
            }

        }else
            return 'Error: El Apoderado  no a  podido actualizado';


        /*
        $bandera = $this->personaRepo->updatAlumno($data);

        if($bandera === 1){
            return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>'Alumno','criterio'=>'*'))
                ->with(array('confirm' => 'Los Datos an sido Actualizado con exito'));
        }
        else{
            return Redirect::back()->withInput()->withErrors($bandera);
        }
        */
    }

} 