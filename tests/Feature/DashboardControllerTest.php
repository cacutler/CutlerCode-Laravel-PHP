<?php
namespace Tests\Feature;
use App\Models\Requests;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class DashboardControllerTest extends TestCase {
    use RefreshDatabase;
    public function test_authenticated_user_can_view_dashboard(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        Requests::factory()->count(3)->create(['status' => 'pending']);
        Requests::factory()->count(2)->create(['status' => 'completed']);
        Requests::factory()->count(1)->create(['status' => 'in_progress']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertViewIs('users.dashboard');
        $response->assertViewHas(['recentRequests', 'totalRequests', 'pendingRequests', 'completedRequests', 'inProgressRequests', 'requestsByMonth']);
    }
    public function test_dashboard_displays_correct_statistics(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        Requests::factory()->count(5)->create(['status' => 'pending']);
        Requests::factory()->count(3)->create(['status' => 'completed']);
        Requests::factory()->count(2)->create(['status' => 'in_progress']);
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertViewHas('totalRequests', 10);
        $response->assertViewHas('pendingRequests', 5);
        $response->assertViewHas('completedRequests', 3);
        $response->assertViewHas('inProgressRequests', 2);
    }
    public function test_guest_cannot_access_dashboard(): void {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}