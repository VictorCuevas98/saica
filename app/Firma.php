<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use App\LaboralesPersona;

class Firma extends Model
{
  public static function guardar_firma($id_proyecto,$id_persona,$folio,$qr,$sello){

    try {
          DB::beginTransaction();

          // obtiene la firma de la persona
          $id_firma = DB::table('personal_proyecto')->where('id_proyecto',$id_proyecto)->where('id_persona',$id_persona)->first();
          $idhash=Hashids::encode($id_firma->id);
          $ruta=$qr."/".$idhash;

          $update_firma = DB::update("update personal_proyecto set created_at ='".date('d-m-Y')."',folio ='".addslashes($folio)."',fecha_firma ='".date('d-m-Y')."',sello ='".addslashes($sello)."',qr ='".$ruta."' where id_persona = ?", [$id_persona]);

          DB::commit();
          return $id_firma;
    } catch (\Exception $e) {
          DB::rollback();
    }

  }
    public static function guardar_firma_entidad($id_proyecto,$id_persona,$rol,$qr,$sello,$folio_consulta){
        $labpersona = LaboralesPersona::where("id_persona",$id_persona)->first();
        try {
            DB::beginTransaction();
            $uniadm = DB::table('cat_uniadm')->where('id', $labpersona->id_uniadm)->first();
            $id = DB::table('recepcion_proyecto')->insertGetId([
                'created_at' => date('Y-m-d H:m:s'),
                'id_proyecto' => intval($id_proyecto),
                'id_persona' => intval($id_persona),
                'sello' => addslashes($sello),
                'fecha_firma' => date('Y-m-d H:m:s'),
                'id_uniadm' =>$uniadm->id,
                'folio' => $folio_consulta
            ]);
                
            $idhash=Hashids::encode($id);
            $ruta=$qr."/".$idhash;

            $update_firma = DB::update("update recepcion_proyecto set qr ='".$ruta."' where id = ?", [$id]);
            
            DB::commit();
            return $id;
        } catch (\Exception $e) {
            DB::rollback();
        }

    }

}
