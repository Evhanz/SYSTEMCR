<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 28/04/2015
 * Time: 01:03 AM
 */

namespace SysCR\Repositories;
use SysCR\Entities\Reunione;
use SysCR\Entities\Persona;

class ReunioneRepo {

    public function getReunionesByCriterioAndFecha($criterio,$fechaInicio,$fechaFin){




        if($criterio == '*'){
            $reuniones = Reunione::where('fecha','>=',$fechaInicio)->
            where('fecha','<=',$fechaFin)->where('descripcion','like','%%')->paginate(3);
        }else{
            $reuniones = Reunione::where('fecha','>=',$fechaInicio)->
            where('fecha','<=',$fechaFin)->where('descripcion','like','%'.$criterio.'%')->paginate(3);
        }


        return $reuniones;
        //$valor = $criterio.' - '.$fechaInicio.' - '.$fechaFin;
        //dd($valor);
    }


    public function getReunionesByCriterio($criterio){
        if($criterio == '*'){
            $reuniones = Reunione::where('descripcion','like','%%')->paginate(3);
        }else{
            $reuniones = Reunione::where('descripcion','like','%'.$criterio.'%')->paginate(3);
        }
        return $reuniones;
    }

    public function regReunion($data){

        $rules=[
            'descripcion' => 'required|min:4',
            'fecha' => 'required',
            'hora' => 'required',
            'multa' => 'required',
        ];
        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $reunion = new Reunione($data);
            $reunion->save();
            return 1;
        }else
            return $validation->messages();


    }

    public function editReunion($data){

        $id = $data['id'];

        $rules=[
            'descripcion' => 'required|min:4',
            'fecha' => 'required',
            'hora' => 'required',
            'multa' => 'required',
        ];
        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $reunion = Reunione::find($id);
            $reunion->descripcion = $data['descripcion'];
            $reunion->fecha = $data['fecha'];
            $reunion->hora = $data['hora'];
            $reunion->multa = $data['multa'];
            $reunion->save();
            return 1;
        }else
            return $validation->messages();


    }

    public function newAsistencia($data){

        $idReunion =$data['idReunion'];
        $codigo =$data['codigo'];
        $bandera = Persona::where('dni','=',$codigo)->firstOrFail();
        $idPersona = $bandera->id;


        if($bandera->tipo == 'Apoderado'){

            $apoderados = Reunione::find($idReunion)->apoderados;


            if($apoderados->find($idPersona)){
                return 'Error: El usuario ya a sido registrado';
            }else{
                $stime=date("G:i:s");
                $apoderado = Persona::find($idPersona);
                $reunion = Reunione::find($idReunion);

                try{
                    $reunion->apoderados()->attach($apoderado,array('estado'=>true,'hora'=>$stime));
                }catch (Exception $e){
                    return $e->getMessage();
                }
                return 'Correcto:';
            }
        }else
            return 'Error: El codigo no le pertenece a un apoderado';

    }

    public function prueba($data){
        dd($data);
    }

} 