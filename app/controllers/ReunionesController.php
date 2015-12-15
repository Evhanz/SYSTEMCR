<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 28/04/2015
 * Time: 12:58 AM
 */
use SysCR\Repositories\ReunioneRepo;
use SysCR\Entities\Reunione;
use SysCR\Entities\Persona;
use SysCR\Entities\Multa;


class ReunionesController extends BaseController {

    protected $reunioneRepo;

    public function __construct(ReunioneRepo $reunioneRepo){

        $this->reunioneRepo = $reunioneRepo;
    }

    public function getReunionesByCriterioAndFecha($criterio,$fechaI,$fechaF){


        if($fechaI=='n' || $fechaF =='n'){
            $reuniones = $this->reunioneRepo->getReunionesByCriterio($criterio);
        }else{
            $reuniones = $this->reunioneRepo->getReunionesByCriterioAndFecha($criterio,$fechaI,$fechaF);
        }

        return View::make('reuniones/viewReuniones',compact('reuniones','criterio','fechaI','fechaF'));


    }


    public function frmNewReunion(){

        return View::make('reuniones/viewNewReuniones');

    }

    public function regReunion(){

        $data = Input::all();

        $bandera = $this->reunioneRepo->regReunion($data);

        if($bandera === 1){
            return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
                ->with(array('confirm' => 'Te has registrado correctamente.'));
        }
        else{
            return Redirect::back()->withInput()->withErrors($bandera);
        }

    }

    public function  frmEditReunion($id){

        $reunione = Reunione::find($id);

        if($reunione->id >= 1){
            return View::make('reuniones/viewEditReuniones',compact('reunione'));
        }

    }

    public function editReunion(){

        $data = Input::all();

        $bandera = $this->reunioneRepo->editReunion($data);
        if($bandera === 1){
            return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
                ->with(array('confirm' => 'La reunion a sido actualizada correctamente.'));
        }
        else{
            return Redirect::back()->withInput()->withErrors($bandera);
        }
    }

    public function delReunion(){
        $id = Input::get('txtId');
        $reunion = Reunione::find($id);
        try{

            if($reunion->apoderados()->count() <1){
                $reunion->delete();
                return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
                    ->with(array('confirm' => 'La reunion a sido eliminada correctamente.'));
            }else
                return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
                    ->with(array('fail' => 'La reunion a no a podido ser eliminada , revise sus asignaciones'));

        }catch (Exception $e){
            return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
                ->with(array('fail' => 'La reunion a no a podido ser eliminada , revise sus asignaciones'));

        }
    }

    public function frmRegAsistencia($id){

        $reunion = Reunione::find($id);

        if($reunion->fecha != date("Y-m-d") ){
            $bandera = 'Error: La fecha no es correcta para acceder';
            return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
                ->with(array('fail' => $bandera));
        }else

        return View::make('reuniones/viewRegAsistencia',compact('reunion'));

    }


    public function getApoderado(){

        $data = Input::all();
        $idReunion =$data['idReunion'];
        $codigo = $data['txtCodigo'];


        $reunion = Reunione::find($idReunion);

        try{
            $apoderado = Persona::where('dni','=',$codigo)->where('tipo','like','Apoderado')->firstOrFail();
            return $apoderado->nombre.','.$apoderado->apellidoP.' '.$apoderado->apellidoM;

        }catch (Exception $e){
            return 'Error: El DNI es incorrecto';
        }

    }


    public function newAsistencia(){

        //tomamos los datos
        $data = Input::all();

        //
        $reunion=  Reunione::find($data['idReunion']);


        if($reunion->hora < date("G:i:s")){
            $bandera = 'Error: A pasado la hora limite'.date("G:i:s");
        }else {
            //$bandera = $this->reunioneRepo->newAsistencia($data);
            $bandera = $this->reunioneRepo->newAsistencia($data);
        }

        return $bandera;

    }


    public function cierreReunion(){

        $data = Input::all();
        $id=$data['txtReunionId'];

        $reunion = Reunione::find($id);

        $apoderados = Persona::where('tipo','like','Apoderado')->where('estado','=',true)->get();

        //para bandera

        $bandera = Reunione::find($id)->apoderados;

        foreach($apoderados as $apoderado){
            if($bandera->find($apoderado->id)){

            }else
            {
                $stime=date("G:i:s");
                $reunion->apoderados()->attach($apoderado,array('estado'=>false,'hora'=>$stime));
                $multa = new Multa();
                $multa->persona_id = $apoderado->id;
                $multa->reunion_id = $id;
                $multa->estado = 'deuda';
                $multa->multa = $reunion->multa;
                $multa->save();

                $reunion->estado = 'cierre';
                $reunion->save();
                //para modificar estado de reunion

            }

        }

        return Redirect::route('getReuniones',array('criterio'=>'*','fechaI'=>'n','fechaF'=>'n'))
            ->with(array('confirm' => 'La reunion cerro con exito.'));

    }



    public function selectAsistencia($id){

        $reunion = Reunione::find($id);
        $personas = Reunione::find($id)->apoderados()->orderBy('hora','asc')->get();

        return View::make('reuniones/viewDetailAsistencias',compact('reunion','personas'));


    }

    public function index(){
        dd('hola');
    }

} 