<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Requests;
class AuthControllerTest extends TestCase {
    use RefreshDatabase;
    public function test_user_can_view_login_form(): void {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }
    public function test_user_can_login_with_valid_credentials(): void {
        $user = User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);
        $response = $this->post('/login', ['email' => 'test@example.com', 'password' => 'password123']);
        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'Welcome back!');
        $this->assertAuthenticatedAs($user);
    }
    public function test_user_cannot_login_with_invalid_credentials(): void {
        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);
        $response = $this->post('/login', ['email' => 'test@example.com', 'password' => 'wrongpassword']);
        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    public function test_user_can_view_register_form(): void {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }
    public function test_user_can_register_with_valid_data(): void {
        $response = $this->post('/register', ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => 'password123', 'password_confirmation' => 'password123']);
        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'Registration successful! Welcome to your dashboard.');
        $this->assertDatabaseHas('users', ['name' => 'John Doe', 'email' => 'john@example.com']);
        $user = User::where('email', '=', 'john@example.com', 'and')->first();
        $this->assertAuthenticatedAs($user);
    }
    public function test_user_cannot_register_with_duplicate_email(): void {
        User::factory()->create(['email' => 'test@example.com']);
        $response = $this->post('/register', ['name' => 'John Doe', 'email' => 'test@example.com', 'password' => 'password123', 'password_confirmation' => 'password123']);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    public function test_guest_cannot_access_admin_routes(): void {
        $request = Requests::factory()->create();
        $this->get('/admin/requests')->assertRedirect('/login');
        $this->get("/admin/requests/{$request->id}")->assertRedirect('/login');
        $this->patch("/admin/requests/{$request->id}/status", ['status' => 'in_progress'])->assertRedirect('/login');
        $this->delete("/admin/requests/{$request->id}")->assertRedirect('/login');
    }
    public function test_authenticated_user_can_logout(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'You have been logged out successfully.');
        $this->assertGuest();
    }
}