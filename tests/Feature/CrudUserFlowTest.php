<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudUserFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_login_view_and_update_profile(): void
    {
        $registerResponse = $this->post(route('register.store'), [
            'username' => 'testuser',
            'password' => 'secret12',
            'confirm_password' => 'secret12',
            'email' => 'testuser@example.com',
        ]);

        $registerResponse->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'username' => 'testuser',
            'email' => 'testuser@example.com',
        ]);

        $loginResponse = $this->post(route('login.store'), [
            'username' => 'testuser',
            'password' => 'secret12',
        ]);

        $loginResponse->assertRedirect(route('users.list'));

        $user = User::where('username', 'testuser')->firstOrFail();

        $this->actingAs($user)
            ->get(route('users.list'))
            ->assertOk()
            ->assertSee('testuser');

        $this->actingAs($user)
            ->get(route('users.view', ['id' => $user->id]))
            ->assertOk()
            ->assertSee('testuser@example.com');

        $updateResponse = $this->actingAs($user)->post(route('users.update'), [
            'id' => $user->id,
            'username' => 'updateduser',
            'password' => 'newpass12',
            'confirm_password' => 'newpass12',
            'email' => 'updated@example.com',
        ]);

        $updateResponse->assertRedirect(route('users.list'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'updateduser',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_authenticated_user_can_delete_from_list(): void
    {
        $owner = User::factory()->create();
        $target = User::factory()->create();

        $response = $this->actingAs($owner)->get(route('users.delete', ['id' => $target->id]));

        $response->assertRedirect(route('users.list'));
        $this->assertDatabaseMissing('users', [
            'id' => $target->id,
        ]);
    }
}
