<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_session_survives_repeated_dashboard_requests(): void
    {
        $user = User::factory()->create([
            'username' => 'session-user',
            'password' => 'secret-password',
        ]);

        $this->post(route('login.attempt'), [
            'username' => $user->username,
            'password' => 'secret-password',
        ])->assertRedirect(route('dashboard'));

        $this->get(route('dashboard'))->assertOk();
        $this->get(route('dashboard'))->assertOk();
    }

    public function test_registration_session_survives_dashboard_refresh(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Session User',
            'username' => 'new-session-user',
            'email' => 'session-user@example.test',
            'password' => 'secret-password',
        ])->assertRedirect(route('dashboard'));

        $this->get(route('dashboard'))->assertOk();
        $this->get(route('dashboard'))->assertOk();
    }
}
