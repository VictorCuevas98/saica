<?php
namespace App\GenerarClave;

use App\Http\Controllers\PedidosController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\SolicitudAbastecimiento;


	class NumeroSolicitudAbastecimiento{

		public function obtenerNumero($tipo, $tabla, $campo){
			$exist = 1;
			
			while ($exist == 1){
				$clave = $this->generaNumeroSolicitud($tipo, $tabla, $campo);
				$exist = $this->verificarNumero($tabla, $campo, $clave);
			}

			return $clave;
		}

		public function generaNumeroSolicitud($tipo, $tabla, $campo) {

			//Ultimo Numero de Solicitud
			$numeroSolicitud = SolicitudAbastecimiento::where('activo', true)->where('id_tipo_solicitud_abastecimiento',$tipo)->orderBy('id','desc')->first();
			//dd($claveGenera_bd);
			if(!$numeroSolicitud){
				$numero = 1;
			}else{
				$numero_bd = intval(substr($numeroSolicitud->num_solicitud_abastecimiento,7,3)); //$claveGenera_bd->num_pedido
				//dd($numero_bd);
				$numero = $numero_bd + 1;
				//dd($numero);
			}

			$tipoSolicitud = $tipo;
			//$partida = $partidaPresupuestal;
		    //$sitio = Auth::user()->sitio_id; //se obtiene el sitio de la sesión    
		    $anioActual = chop(substr(date("Y"),2,2)); //se obtiene el año en que se registra
		    $consecutivo = str_pad($numero , 3, "0", STR_PAD_LEFT); //se genera un número consecutivo
		    //dd($consecutivo);

			$numeroSolicitudAbastecimiento = $tipo.'-'.$consecutivo.'/'.$anioActual;

			return $numeroSolicitudAbastecimiento;
		}

		public function verificarNumero($tabla, $campo, $clave){
			try{
				$exist = DB::table($tabla)->where($campo, '=', $clave)->count();

				return (int)$exist;

			}catch(\Exception $th){
				\Log::warning(__METHOD__."--->Line:".$th->getLine()."----->".$th->getMessage());
				//Retornamos error
				return 1;
			}
		}

	}