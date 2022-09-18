<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bloque;
use Carbon\Carbon;
use App\CatStatus;

class EventosBloquesCambiarEnProceso extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bloques:cambiarEnProceso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'consulta los eventos que ya debieron de haber iniciado y los cambia a en proceso ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('America/Mexico_City');
        $ahora =  Carbon::now('America/Mexico_City');
        $ahora = $ahora->addMinutes(15);
        //echo ("\n");
        /*
        echo($ahora."\n");

        echo($ahora->format('h:i:s A'));
        echo ("\n");

        echo($ahora->toTimeString());
        echo ("\n");

        $horaActual = Carbon::now();
        $fechaActual = Carbon::now();
        */
        $estatus = CatStatus::whereIn('clave_status',['E','X'])->get();
        $bloques = Bloque::where('fecha_inicio','<=',$ahora->format('Y-m-d'))->where('fecha_fin','>=',$ahora->format('Y-m-d'))
        ->where('hora_inicio','<=',$ahora->toTimeString())->where('hora_fin','>=',$ahora->toTimeString())
        ->where('activo',true)
        ->where('publicado',true)
        ->whereNotIn('status_id',$estatus->pluck('id'))
        ->get();

        //cambioamos el estado de los bloques 
        $estatusEnCurso = CatStatus::where('clave_status','E')->get();
        foreach ($bloques as $bloque) {
            $bloque->status_id = $estatusEnCurso->first()->id;
            $bloque->save();
            \Log::info("Proceso automatico cambia a enproceso EL EVENTO Bloque: ".$bloque->id." Titulo:".$bloque->titulo);
        }

        echo("\n".$ahora->format('Y-m-d h:i:s A')." Se Cambiaron - " .$bloques->count()." - bloques");
        //$carbon_inicio = Carbon($bloque->fecha_inicio ." ".$bloque->hora_inicio);
        //$carbon_fin = new Carbon($bloque->fecha_fin ." ".$bloque->hora_fin);

        echo "\nterminado, ten un excelente dia :P";
        echo ("\n");
        return 1;
    }
}
