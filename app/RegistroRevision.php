<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class RegistroRevision extends Model
{
    //
    protected $table ='registro_revision';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status_persona_id','persona_id','activo',
        'created_at','updated_at','deleted_at','created_by','updated_by','deleted_by'
    ];

    //BEGIN::SCOPES
    public function scopeInactivos($query)
    {
        return $query->where('activo',false);
    }

    public function scopeActivos($query){
        return $query->where('activo',true);
    }

    public function scopePendientes($query){

        return $query->where('status_persona_id','P');
    }


    //END::SCOPES

    //BEGIN::RELATIONSHIPS

    public function status_persona()
    {
        return $this->belongsTo('App\CatStatusPersona','status_persona_id');
    }

    public function persona()
    {
        return $this->belongsTo('App\Personas','persona_id');
    }


    //END::RELATIONSHIPS

}