<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function nome_deve_ter_mais_de_5_caracteres()
    {
        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'João',
            'contact' => '123456789',
            'email' => 'joao@email.com'
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function contato_deve_ter_9_digitos()
    {
        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'João Silva',
            'contact' => '12345',
            'email' => 'joao@email.com'
        ]);

        $response->assertSessionHasErrors('contact');
    }

    /** @test */
    public function email_deve_ser_valido()
    {
        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'João Silva',
            'contact' => '123456789',
            'email' => 'email-invalido'
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function contato_deve_ser_unico()
    {
        Contact::factory()->create([
            'contact' => '123456789',
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'João Silva',
            'contact' => '123456789',
            'email' => 'joao@email.com'
        ]);

        $response->assertSessionHasErrors('contact');
    }

    /** @test */
    public function email_deve_ser_unico()
    {
        Contact::factory()->create([
            'email' => 'joao@email.com',
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->post(route('contacts.store'), [
            'name' => 'João Silva',
            'contact' => '987654321',
            'email' => 'joao@email.com'
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function apenas_usuarios_autenticados_podem_criar_contatos()
    {
        $response = $this->post(route('contacts.store'), [
            'name' => 'João Silva',
            'contact' => '123456789',
            'email' => 'joao@email.com'
        ]);

        $response->assertRedirect(route('login'));
    }
}
