<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Funko;
use App\Models\User;
use Tests\TestCase;

class FunkosControllerTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    public function test_index(){
        $response = $this->get('/funkos');
        $response->assertViewIs('funkos.index');
        $response->assertViewHas('funkos');
        $response->assertStatus(200);
    }


    public function test_show_view(){
        $funko = Funko::first();
        $response = $this->get('/funkos/1', $funko->toArray());
        $response->assertViewIs('funkos.show');
        $response->assertViewHas('funko', $funko);
    }

    public function test_create_view_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($usuario)->get('/funkos/create');
        $response->assertViewIs('funkos.create');
        $response->assertStatus(200);
    }

    public function test_create_view_user(){
        $usuario = User::factory()->create(['role' => 'user']);
        $response = $this->actingAs($usuario)->get('/funkos/create');
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_create_view_guest(){
        $response = $this->get('/funkos/create');
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function test_create_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::factory()->make();
        $response = $this->actingAs($usuario)->get('/funkos', $funko->toArray());
        $response->assertViewIs('funkos.index');
    }

    public function test_update_view_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::first();
        $response = $this->actingAs($usuario)->get('/funkos/1/edit', $funko->toArray());
        $response->assertViewIs('funkos.edit');
        $response->assertViewHas('funko', $funko);
    }

    public function test_update_view_user(){
        $usuario = User::factory()->create(['role' => 'user']);
        $funko = Funko::first();
        $response = $this->actingAs($usuario)->get('/funkos/1/edit', $funko->toArray());
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_update_view_guest(){
        $funko = Funko::first();
        $response = $this->get('/funkos/1/edit', $funko->toArray());
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }

    public function test_update_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::first();
        $response = $this->actingAs($usuario)->put('/funkos/1', $funko->toArray());
        $response->assertRedirect('/');
    }


    public function test_delete_admin(){
        $usuario = User::factory()->create(['role' => 'admin']);
        $funko = Funko::first();
        $response = $this->actingAs($usuario)->delete('/funkos/' . $funko->id, $funko->toArray());
        $response->assertRedirect('/funkos');
    }

    public function test_delete_user(){
        $usuario = User::factory()->create(['role' => 'user']);
        $funko = Funko::first();
        $response = $this->actingAs($usuario)->delete('/funkos/' . $funko->id, $funko->toArray());
        $response->assertRedirectToRoute('home');
        $response->assertStatus(302);
    }

    public function test_delete_guest(){
        $funko = Funko::first();
        $response = $this->delete('/funkos/' . $funko->id, $funko->toArray());
        $response->assertRedirectToRoute('login');
        $response->assertStatus(302);
    }
}
