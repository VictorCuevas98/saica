<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * php artisan db:seed --class=DatabaseSeeder
     * @return void
     */
    public function run()
    {
         //$this->call(UserSeeder::class);
        $this->call(AdministradorCreateUserSeeder::class);
        /*usuarios roles y permisos*/
        $this->call(PermissionsForUsersSeeder::class);
        $this->call(PermissionsForRolesSeeder::class);
        $this->call(PermissionsForPermissionsSeeder::class);

        $this->call(PermissionsForAlmacenSeeder::class);
        $this->call(PermissionsForContratosSeeder::class);
        $this->call(PermissionsForUnidadMedicaSeeder::class);
        $this->call(EntradascontratosAbiertos::class);//permisos para entradas de contrato abierto
        $this->call(PermissionsToEntradascontratosCerradosSeeder::class);
        $this->call(PermissionsForCatalogosSeeder::class);
        $this->call(PedidosProveedorSeeder::class);
        
        
       //Seeder creados por CarlosGomez
        $this->call(PuestosFuncionalesTempSeeder::class);
        //$this->call(ProveedoresSeeder::class);//QUITAR 
        $this->call(CatTipoDesempenoSeeder::class);  
        $this->call(CatStatusPersonaSeeder::class);
        //$this->call(PersonasSeeder::class); //QUITAR SEED
        $this->call(CatTipoContratacionSeeder::class); 
        $this->call(PuestosFuncionalesSeeder::class); //QUITAR
        $this->call(CatTipoSeccionSeeder::class);
        $this->call(CatRecursosContratoAbiertoSeeder::class);
        //$this->call(PuestosPersonaSeeder::class); //QUITAR
        $this->call(CatOrigenRecursoSeeder::class);
        $this->call(CatTipoAdquisicionSeeder::class);
        $this->call(CatStatusAdquisicionSeeder::class);
        $this->call(CatTipoRevisionSeeder::class);
        $this->call(CatPreguntasRevisionEntradaSeeder::class);
       // $this->call(AdquisicionesSeeder::class); //Se debe quitar
        $this->call(CatAlmacenesSeeder::class);
        $this->call(CatEjerciciosFiscalesSeeder::class);
        $this->call(CatEtapasContratoSeeder::class);
        $this->call(CatFundamentoLegalSeeder::class);
        $this->call(CatLaboratorioSeeder::class);
        $this->call(CatNivelesCogSeeder::class);
        $this->call(CatOrdenGobiernoSeeder::class);
        $this->call(CatStatusEntradaSeeder::class);
        $this->call(CatTipoContratoSeeder::class);
        $this->call(CatTipoDocContratoSeeder::class);
        $this->call(CatTipoDocPagoSeeder::class);
        $this->call(CatTipoEntradaSeeder::class);
        $this->call(CatTiposSolicitudAbastecimientoSeeder::class);
        $this->call(CatUnidadesConsolidadorasSeeder::class);
        $this->call(CatTipoRangoSeeder::class);
       /* $this->call(ContratosSeeder::class);//Se debe quitar
        $this->call(ContratosAbiertosSeeder::class);//Se debe quitar
        $this->call(ContratosFundamentoSeeder::class);//Se debe quitar*/
        $this->call(EntesPublicosSedeer::class);
        //$this->call(EntradasSeeder::class);//quitar
        //$this->call(AdquisicioneDocPagoSeeder::class);    
       /* $this->call(PedidosContratoAbiertoSeeder::class);  //quitar
        $this->call(EntradasAdquisicionSedeer::class); //quitar
        $this->call(EntradasAdquisicionDetalleSeeder::class); //quitar
        $this->call(EntradasAdquisicionRevisionSeeder::class); //quitar
        $this->call(EntradasAdquisicionStatusSeeder::class); //quitar*/
        $this->call(UnidadesAdminSedeer::class);
        $this->call(PuestosEstructuraSeeder::class); 
      /*  $this->call(PuestosNoEstructuraSeeder::class); //QUITAR
        $this->call(PuestosNoEstructuraAdscripcionSeeder::class);//QUITAR*/
        $this->call(CatEtapasPedidoSeeder::class);
        $this->call(CatTipoParticipanteContratoSeeder::class);

        
        
    }
}
