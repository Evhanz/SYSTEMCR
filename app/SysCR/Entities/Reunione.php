<?php namespace SysCR\Entities;
use Carbon\Carbon;
class Reunione extends \Eloquent {
	//protected $fillable = [];
    protected $fillable = array('descripcion','fecha','hora','multa');

    protected $fechaf;


    /*
    public function getFechaAttribute($attr) {
        return Carbon::parse($attr)->format('d-m-Y'); //Change the format to whichever you desire
    }
    */


    public function getFechafAttribute() {
        return Carbon::parse($this->fecha)->format('d-m-Y'); //Cambia el formato al comunmente usado
    }

    public function apoderados(){
        return $this->belongsToMany('SysCR\Entities\Persona')->withPivot('estado','hora');
    }
}