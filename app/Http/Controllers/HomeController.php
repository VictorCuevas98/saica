<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('pages/dashboard');
        return view('home');
        //return view('admin.inicio');
    }

    public function ejes(){
     //lo que haremos sera imprimir un archivo string que sriva como seeder
     $ejes = DB::table('cat_ejes')->get();
     $strinPrintSeeder = '';
     foreach ($ejes as $eje)
     {
         //por cada ente y cada concpto crearemos un registro en la BD
             $strinPrintSeeder .= 'DB::table("cat_ejes")->updateOrInsert([
             "punto" => "'.$eje->punto.'",
             "eje" => "'.$eje->eje.'",
             "padre" => "'.$eje->padre.'",
             "color" => "'.$eje->color.'"
             ]);';

     }

   return $strinPrintSeeder;
    }
}
