<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contacto extends Model
{
    protected $table ='contacto_persona';
    protected $primaryKey = 'id';
    protected $fillable = [
        'calle','num_ext','num_int','created_at','id_persona','id_colonia'
    ];

    public static function guardaContacto($request,$idpersona){
        $created = date('Y-m-d H:i:s');
        $inter='';
        if(isset($request->txtninterior)){$inter=$request->txtninterior;}
        $idContacto = DB::table('contacto_persona')->insert(
            ['calle' => $request->txtcalle,
            'num_ext'=>  $request->txtnexterior,
            'num_int' => $inter, 
            'created_at' => $created, 
            'id_persona' => $idpersona, 
            'id_colonia' =>  $request->id_colonia
            ]);
        return $idContacto;  
    }

    public static function editarContacto($request,$idpersona){
        $updated = date('Y-m-d H:i:s');
        $inter='';
        
        if(isset($request->ninterior_notificaciones)){$inter=$request->ninterior_notificaciones;}
        
        $idContacto = DB::table('contacto')
        ->where('id_persona','=',$idpersona)
        ->update(
            ['calle' => $request->calle_notificaciones,
            'num_ext'=> $request->nexterior_notificaciones,
            'num_int' => $inter, 
            'calle' => $request->calle_notificaciones, 
            'updated_at' => $updated, 
            'id_colonia' => $request->id_colonia_notificaciones
            ]);
    
        return $idContacto;  
    }

    
}
