<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboralesPersona extends Model
{
    protected $table ='laborales_persona';
    protected $primaryKey = 'id';
    protected $fillable = [
        'area','cargo','id_persona','id_uniadm' ,'created_at','updated_at'
    ];

    //BEGIN::RELATIONSHIPS
    public function unidadAdmin()
    {
        return $this->belongsTo('App\CatUniAdm','id_uniadm');
    }

    public function persona()
    {
        return $this->belongsTo('App\Personas','id_persona');
    }

    public function recepcionProyecto(){
        return $this->hasMany('App\RecepcionProyecto','id_uniadm');
    }
    //END::RELATIONSHIPS

}
