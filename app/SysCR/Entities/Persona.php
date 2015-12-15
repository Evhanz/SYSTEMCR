<?php namespace SysCR\Entities;

class Persona extends \Eloquent {
	//protected $fillable = [];

    protected $name;

    protected $fillable = array('nombre','apellidoP','apellidoM','dni',
        'direccion','correo','telefono','celular','nivel','grado','seccion');





    /*para relacion recursiva
     *hijo : relacion de uno a muchos que significa
     * que una perona tiene muchas personas asignadas
     * Apoderado: que una persona solo puede tener un apoderado
    */
    public function hijos(){
       // return $this->hasMany('Content', 'parent_id', 'id');
        //$this->belongsTo('entitie', 'foreign_key', 'local_key');
        return $this->hasMany('SysCR\Entities\Persona','apoderado_id','id');
    }

    public function apoderado(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('SysCR\Entities\Persona','apoderado_id','id');
    }

    /*relacion fotocheck*/
    public function fotocheck(){
        return $this->belongsTo('SysCR\Entities\Fotocheck','fotocheck_id','id');
    }

    public function multas(){
        return $this->hasMany('SysCR\Entities\Multa','persona_id','id');
    }


    //para formatear los nombre
    public function getNameAttribute() {
        return $this->nombre.' '.$this->apellidoP.' '.$this->apellidoM;
    }
}