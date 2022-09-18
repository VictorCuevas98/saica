<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bloque;
use Carbon\Carbon;
use App\CatStatus;
use Illuminate\Support\Facades\Log;
class EventosBloquesCambiarConcluido extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bloques:cambiarConcluido';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'consulta los eventos que ya debieron de haber concluido y los cambia ';

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
        $ahora = $ahora->addMinutes(1);
        //$now = date('Y-m-d H:i:s');

        $estatus = CatStatus::whereIn('clave_status',['C','X'])->get();
        $bloques = Bloque::where('fecha_fin','<=',$ahora->format('Y-m-d'))->where('hora_fin','<=',$ahora->toTimeString())
        ->where('activo',true)
        ->where('publicado',true)
        ->whereNotIn('status_id',$estatus->pluck('id'))
        ->get();

        $estatusConcluido = CatStatus::where('clave_status','C')->get();
        foreach ($bloques as $bloque) {
            $bloque->status_id = $estatusConcluido->first()->id;
            $bloque->save();
            \Log::info("Proceso automatico CONCLUYE EL EVENTO Bloque: ".$bloque->id." Titulo:".$bloque->titulo);
        }

        echo("\n".$ahora->format('Y-m-d h:i:s A')." Se concluyeron - " .$bloques->count()." - bloques");
        //$carbon_inicio = Carbon($bloque->fecha_inicio ." ".$bloque->hora_inicio);
        //$carbon_fin = new Carbon($bloque->fecha_fin ." ".$bloque->hora_fin);

        echo "\nterminado, ten un excelente dia :P";
        echo ("\n");
        return 1;
    }
}
