<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 06/05/2015
 * Time: 12:17 AM
 */

namespace SysCR\Entities;


class Multa extends \Eloquent{

    public function apoderado(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('SysCR\Entities\Persona','persona_id','id');
    }
    public function reunion(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('SysCR\Entities\Reunione','reunion_id','id');
    }

} 