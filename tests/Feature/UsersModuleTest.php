<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UsersModuleTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_shows_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Joel',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }

    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        // DB::table('users')->truncate();

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }


    /** @test */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'Omar Crispin'
        ]);

        $this->get('/usuarios/' . $user->id)
            ->assertStatus(200);
        // ->assertSee('Omar Crispin');
        // ->assertSee('Mostrando detalles del usuario --> 4');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear Nuevo Usuario');
    }

    

    /** @test */
    function it_display_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_creates_a_new_user()
    {
        $this->withExceptionHandling();

        $this->post('/usuarios/crear', [
            'name' => 'CarlosCrispin',
            'email' => 'carlos.crispin@gmail.com',
            'password' => '123456789'
        ])->assertRedirect('usuarios');

        /* $this->assertDatabaseHas('users',[
            'name' => 'CarlosCrispin',
            'email' => 'carlos.crispin@gmail.com',
            'password' => '123456789'
        ]); */
        $this->assertCredentials([
            'name' => 'CarlosCrispin',
            'email' => 'carlos.crispin@gmail.com',
            'password' => '123456789'
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->from('usuarios/nuevo')
            ->post('usuarios/crear', [
                'name' => '',
                'email' => 'carlos.crispin@gmail.com',
                'password' => '123456789'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo name es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'carlos.crispin@gmail.com'
        ]);
    }

    /** @test */
    function the_email_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->from('usuarios/nuevo')
            ->post('usuarios/crear', [
                'name' => 'Carlos Crispin',
                'email' => '',
                'password' => '123456789'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
    }
    /** @test */
    function the_email_must_be_valid()
    {
        // $this->withoutExceptionHandling();


        factory(User::class)->create([
            'email' => 'carlos.crispin@gmail.com',
        ]);

        $this->from('usuarios/nuevo')
            ->post('usuarios/crear', [
                'name' => 'Carlos Crispin',
                'email' => 'carlos.crispin@gmail.com',
                'password' => '123456789'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->from('usuarios/nuevo')
            ->post('usuarios/crear', [
                'name' => 'Carlos Crispin',
                'email' => 'carlos.crispin@gmail.com',
                'password' => ''
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_users_page()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar Usuario')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id == $user->id;
            });
    }

    /** @test */
    function it_updates_a_user()
    {
        $user = factory(User::class)->create();

        // $this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Carlos Crispin',
            'email' => 'carlos.crispin@gmail.com',
            'password' => '123456789'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Carlos Crispin',
            'email' => 'carlos.crispin@gmail.com',
            'password' => '123456789'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user()
    {
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/edit")
        ->put("usuarios/{$user->id}", [
            'name' => '',
            'email' => 'carlos.crispin@gmail.com',
            'password' => '123456789'
        ])
            ->assertRedirect("usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['name']);

        // $this->assertEquals(0, User::count());
        $this->assertDatabaseMissing('users', [
            'email' => 'carlos.crispin@gmail.com'
        ]);
    }

    /** @test */
    function the_email_is_required_when_updating_a_user()
    {
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/edit")
        ->put("usuarios/{$user->id}", [
            'name' => 'Carlos Crispin',
            'email' => 'no-valido',
            'password' => '123456789'
        ])
            ->assertRedirect("usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        // $this->assertEquals(0, User::count());
        $this->assertDatabaseMissing('users', [
            'name' => 'Carlos Crispin'
        ]);
    }
    /** @test */
    function the_email_must_be_valid_when_updating_a_user()
    {
        // $this->withoutExceptionHandling();
        factory(User::class)->create([
            'email' => 'existing-email@example.com',
        ]);

        $user = factory(User::class)->create([
            'email' => 'carlos.crispin@gmail.com'
        ]);

        $this->from("usuarios/{$user->id}/edit")
            ->put("usuarios/{$user->id}", [
                'name' => 'Carlos Crispin',
                'email' => 'existing-email@example.com',
                'password' => '123456789'
            ])
            ->assertRedirect("usuarios/{$user->id}/edit")
            ->assertSessionHasErrors(['email']);

        
    }

    /** @test */
    function the_users_email_can_stay_when_updating_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'email' => 'carlos.crispin@gmail.com',
        ]);

        $this->from("usuarios/{$user->id}/edit")
            ->put("usuarios/{$user->id}", [
                'name' => 'Carlos Crispin',
                'email' => 'carlos.crispin@gmail.com',
                'password' => 'abcde'
            ])
            ->assertRedirect("usuarios/{$user->id}");

        // $this->assertEquals(0, User::count());
        $this->assertDatabaseHas('users', [
            'name' => 'Carlos Crispin',
            'email' => 'carlos.crispin@gmail.com',
        ]);
    }

    /** @test */
    function the_password_is_optional_when_updating_a_user()
    {
        // $this->withoutExceptionHandling();
        
        $oldPassword = 'CLAVE_ANTERIOR';
 

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from("usuarios/{$user->id}/edit")
            ->put("usuarios/{$user->id}", [
                'name' => 'Carlos Crispin',
                'email' => 'carlos.crispin@gmail.com',
                'password' => ''
            ])
            ->assertRedirect("usuarios/{$user->id}");

        // $this->assertEquals(0, User::count());
        $this->assertCredentials([
            'name' => 'Carlos Crispin',
            'email' => 'carlos.crispin@gmail.com',
            'password' => $oldPassword
        ]);
    }

    /** @test */
    public function it_deletes_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->delete("usuarios/{$user->id}")
            ->assertRedirect('usuarios');
        
        /* $this->assertDatabaseMissing('users', [
            "id" -> $user->id
        ]); */

        $this->assertSame(0, User::count());
    }

}
