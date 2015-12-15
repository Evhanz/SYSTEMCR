<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 12/05/2015
 * Time: 01:31 AM
 */
use SysCR\Entities\Persona;
use SysCR\Entities\PersonaDTO;
use SysCR\Entities\Multa;

class ReportesController extends BaseController{

    public function index($id){

        $persona = Persona::find($id);
        $parameter = array();
        $parameter['persona'] = $persona;
        $pdf = PDF::loadView('reportes/reportes', $parameter);
        return $pdf->stream();


    }

    public function frmReportes(){
        return View::make('reportes/reportesDeudas');
    }


    public function getDeudasByGradoAndSeccion(){

        $array = array();
        $data = Input::all();

        $nivel = $data['nivel'];

        $grado =$data['grado'];
        $seccion = $data['seccion'];

        try{
            $array = $this->getData($nivel,$grado,$seccion);

            return View::make('reportes/reportesDeudas',compact('array','data'));
        }catch (Exception $e){

            $fail ='Un alumno no tiene apoderado registrado';
            return View::make('reportes/reportesDeudas',compact('array','data','fail'));

        }
    }

    public function pdfReporte($nivel,$grado,$seccion){
        $array = array();

        $array = $this->getData($nivel,$grado,$seccion);
        $valor = array($nivel,$grado,$seccion);

        $parameter = array();
        $parameter['personas'] = $array;
        $parameter['valor'] = $valor;
        $pdf = PDF::loadView('reportes/reporteDeudasPDF', $parameter);
        return $pdf->stream();

    }


    public function getData($nivel,$grado,$seccion){

        $array = array();

        $personas = Persona::where('nivel','like',$nivel)
            ->where('grado','like',$grado)->where('seccion','like',$seccion)->where('tipo','like','Alumno')->get();

        foreach($personas as $persona){

            if($persona->apoderado!= null){
                $apoderado = $persona->apoderado;
                // dd($apoderado);


                $multas = Multa::where('persona_id',$apoderado->id)->where('estado','like','deuda')->get();

                if($multas->count() >0){
                    $personaDTO = new PersonaDTO();
                    $personaDTO->id = $persona->id;
                    $personaDTO->name = $persona->name;
                    $personaDTO->apoderado = $apoderado->name;
                    $personaDTO->multas = $multas;
                    array_push($array,$personaDTO);

                }

            }



           // dd($multas);

        }

        return $array;


    }

} 