<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Tests\TestCase;

class CategoriasControllerTest extends TestCase
{

    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }


    public function test_index_with_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($usuario)->get('/categorias');
        $response->assertViewIs('categorias.index');
        $response->assertStatus(200);
    }

    public function test_index_with_user(){
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)->get('/categorias');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_index_with_guest(){
        $response = $this->get('/categorias');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function test_create_view_with_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($usuario)->get('/categorias/create');
        $response->assertViewIs('categorias.create');
        $response->assertStatus(200);
    }

    public function test_create_view_with_user(){
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)->get('/categorias/create');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_create_view_with_guest(){
        $response = $this->get('/categorias/create');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function test_create_with_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::factory()->make();
        $response = $this->actingAs($usuario)->post('/categorias', $categoria->toArray());
        $response->assertRedirect('/categorias');
    }

    public function test_create_name_exists(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::first();
        $response = $this->actingAs($usuario)->post('/categorias', $categoria->toArray());
        $response->assertSessionHasErrors('nombre');
    }

    public function test_create_name_empty(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::factory()->make(['nombre' => '']);
        $response = $this->actingAs($usuario)->post('/categorias', $categoria->toArray());
        $response->assertSessionHasErrors('nombre');
    }

    public function test_update_view_with_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::first();
        $response = $this->actingAs($usuario)->get('/categorias/1/edit');
        $response->assertViewIs('categorias.edit');
        $response->assertViewHas('categoria', $categoria);
        $response->assertStatus(200);
    }

    public function test_update_view_with_user(){
        $usuario = User::factory()->create();
        $response = $this->actingAs($usuario)->get('/categorias/1/edit');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_update_view_with_guest(){
        $response = $this->get('/categorias/1/edit');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function test_update_with_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::first();
        $categoria->nombre = "Nombre nuevo";
        $response = $this->actingAs($usuario)->put('/categorias/1', $categoria->toArray());
        $response->assertRedirect('/categorias');
    }

    public function test_update_name_exist(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::first();
        $categoria->nombre = "PSG";
        $response = $this->actingAs($usuario)->put('/categorias/1', $categoria->toArray());
        $response->assertSessionHasErrors('nombre');
    }

    public function test_delete_with_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $categoria = Categoria::first();
        $response = $this->actingAs($usuario)->delete('/categorias/1', $categoria->toArray());
        $response->assertRedirect('/categorias');
    }


    public function test_delete_with_user(){
        $usuario = User::factory()->create(['role' => 'user']);
        $categoria = Categoria::first();
        $response = $this->actingAs($usuario)->delete('/categorias/1', $categoria->toArray());
        $response->assertRedirect('/home');
        $response->assertStatus(302);
    }
}


