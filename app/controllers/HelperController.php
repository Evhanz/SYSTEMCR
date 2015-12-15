<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 11/05/2015
 * Time: 02:45 AM
 */
use SysCR\Entities\Persona;
class HelperController extends BaseController{

    public function getDniPersona(){

        $data = Input::all();


        try{
            $bandera = Persona::where('dni','=',$data['dni'])->firstOrFail();
            return 'Error: El DNI no puede ser repetido';
        }catch (Exception $e){
            return 'Ok';
        }



    }

    public function changeEstado(){
        $data = Input::all();
       // dd($data['txtIdChange']);
        try{
            $persona = Persona::find($data['txtIdChange']);
            if($persona->estado == true){
                $persona->estado=false;

            }else{
                $persona->estado = true;
            }
            $persona->save();

            return Redirect::route('getAllPersonasByTipoAndCriterio',array('tipo'=>$persona->tipo,'criterio'=>$persona->nombre))
                ->with(array('confirm' => 'Se actualizo el estado de: '.$persona->name));

            //dd($persona->id);
        }catch (Exception $e){

        }
    }

} 