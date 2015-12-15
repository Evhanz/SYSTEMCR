<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 06/05/2015
 * Time: 12:06 AM
 */

use SysCR\Repositories\ReunioneRepo;
use SysCR\Entities\Reunione;
use SysCR\Entities\Persona;
use SysCR\Entities\Multa;

class AsistenciasController extends BaseController {
    protected $reunioneRepo;

    public function __construct(ReunioneRepo $reunioneRepo){

        $this->reunioneRepo = $reunioneRepo;
    }


    public function viewMulta(){

        $multas = Multa::all();

        dd($multas);

    }

}