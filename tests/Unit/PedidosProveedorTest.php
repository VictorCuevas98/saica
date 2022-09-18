<?php

namespace Tests\Unit;

//Models
use App\User;
use App\Personas;
use App\CatTipoContrato;



//Testing imports
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

//Utilities
use Illuminate\Support\Str;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Permission\Models\Role;


class PedidosProveedorTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_pedidos_can_return_index_view()
    {
        $this->withoutExceptionHandling();
        $user = $this::setupUser();
        $response = $this->actingAs($user)
             ->withSession(['foo' => 'bar'])->get('/pedidos-proveedor');
        $response->assertOk()
        ->assertViewIs('pedidos-proveedor.index')
        ->assertViewHasAll(['almacenes']);
    }

    public function test_pedidos_can_return_create_view(){
        $this->withoutExceptionHandling();
        $user = $this::setupUser();
        $response = $this->actingAs($user)
             ->withSession(['foo' => 'bar'])->get('/pedidos-proveedor/create');
             $response->assertOk()
        ->assertViewIs('pedidos-proveedor.create')
        ->assertViewHasAll(['almacenes']);
    }


    public function test_pedidos_can_create_pedido_proveedor(){
        $user = $this::setupApi();
        
        $response = $this
            ->actingAs($user)
            ->withSession(['foo' => 'bar'])->post('/pedidos-proveedor/create',[
                'articulos' => [['artmed' => '123','cantidad' => 5]],
                'proveedor' => 1,
                'contrato' => Str::random(10),
                'fecha_entrega_max' => '10/10/2021',
                ]);
        $response->assertStatus(201);
    }

    public function test_can_find_or_create_contrato(){
        $user = $this::setupApi();
        $queryParams = "?contrato=CONTRATO-02&numero_requisicion=REQUISICION-02&oficio_adjudicacion=OFICIO-ADJUDICACION-02&folio=FOLIO123";
        $catTipoContrato = factory(CatTipoContrato::class)->create([
            'clave_tipo_contrato' => 'A',
        ]);
        $response = $this
        ->actingAs($user)
        ->withSession(['foo' => 'bar'])->get('/pedidos-proveedor/valida-contrato'.$queryParams)
        ->assertJsonStructure([
            'proveedor',
            'message',
            'contrato'
        ])
        ->assertStatus(200);
    }

    private function setupApi(){
        //Para no validar token de sesion.
        $this->withoutMiddleware(VerifyCsrfToken::class);
        //Para imprimir en consola mas detalle del error en caso de fallar.
        $this->withoutExceptionHandling();
        //crea tablas persona y usuario en memoria e inicializa uno con rol ADMIN
        return $this::setupUser();
    }


    //crea usuario y  roles y permisios necesarios
    private function setupUser(){
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfc')->unique();
            $table->string('nombre');
            $table->string('primer_ap');
            $table->string('segundo_ap');
            $table->string('curp');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->boolean('activo'); 
            $table->string('num_empleado');
            $table->string('genero');
            $table->string('id_status_persona');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfc')->unique();
            $table->string('password');
            $table->boolean('activo'); 
            $table->boolean('remember_password');

            $table->bigInteger('id_persona')->unsigned();
            $table->foreign('id_persona')->references('id')->on('personas');
            //id_persona
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        Role::create(['name' => 'ADMIN','description'=>'']);
        $persona = factory(Personas::class)->create();
        $user = factory(User::class)->create([
            'rfc' => $persona->rfc,
            'id_persona' => $persona->id
        ]);
        $user->assignRole('ADMIN');
        return $user;
    }
}
