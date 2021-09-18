<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_log_out()
    {
        $user = User::factory()->create();
        $this->be($user);

        $this->get(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertFalse(Auth::check());
    }

    /** @test */
    public function an_unauthenticated_user_can_not_log_out()
    {
        $this->get(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertFalse(Auth::check());
    }
}
