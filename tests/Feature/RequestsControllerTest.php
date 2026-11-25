<?php
namespace Tests\Feature;
use App\Models\Requests;
use App\Models\User;
use App\Notifications\NewRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
class RequestsControllerTest extends TestCase {
    use RefreshDatabase;
    public function test_guest_can_view_request_form(): void {
        $response = $this->get('/requests');
        $response->assertStatus(200);
        $response->assertViewIs('requests');
        $response->assertSee(route('login'));
        $response->assertSee(route('register'));
        $response->assertSee('Guest requests cannot be linked later.');
    }
    public function test_signed_in_user_is_told_the_request_will_be_linked(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user)->get('/requests')->assertOk()->assertSee('This request will be linked to your account.')->assertSee(route('requests.mine'));
    }
    public function test_guest_can_submit_valid_request(): void {
        Notification::fake();
        $admin = User::factory()->create(['is_admin' => true]);
        $requestData = [
            'name' => 'John Doe',
            'goal' => 'Build a web application',
            'email' => 'john@example.com',
            'company_name' => 'Test Company',
            'website' => 'https://example.com',
            'employees' => 10,
            'location' => 'New York',
            'phone' => '123-456-7890',
            'challenge' => 'Need help with backend',
            'comments' => 'Looking forward to working together'
        ];
        $response = $this->post('/requests', $requestData);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your project request has been submitted successfully!');
        $this->assertDatabaseHas('requests', ['name' => 'John Doe', 'email' => 'john@example.com', 'status' => 'pending']);
        Notification::assertSentTo($admin, NewRequest::class);
    }
    public function test_authenticated_submission_is_associated_with_the_user(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user)->post('/requests', [
            'name' => 'Jane Doe',
            'goal' => 'Build a web application',
            'email' => 'jane@example.com'
        ])->assertRedirect();
        $this->assertDatabaseHas('requests', [
            'email' => 'jane@example.com',
            'user_id' => $user->id
        ]);
    }
    public function test_request_submission_requires_required_fields(): void {
        $response = $this->post('/requests', []);
        $response->assertSessionHasErrors(['name', 'goal', 'email']);
    }
    public function test_authenticated_user_can_view_requests_index(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => true]);
        Requests::factory()->count(3)->create();
        $response = $this->actingAs($user)->get('/admin/requests');
        $response->assertStatus(200);
        $response->assertViewIs('requests.index');
        $response->assertViewHas(['requests', 'statusOptions']);
        $response->assertViewHas('requests', fn ($requests) => $requests->total() === 3);
    }
    public function test_regular_user_sees_only_their_own_requests(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => false]);
        $ownRequest = $user->requests()->create(Requests::factory()->raw());
        Requests::factory()->create();
        Requests::factory()->create();
        $response = $this->actingAs($user)->get('/my-requests');
        $response->assertOk();
        $response->assertViewIs('requests.index');
        $response->assertViewHas('requests', fn ($requests) => $requests->total() === 1 && $requests->first()->is($ownRequest));
    }
    public function test_regular_user_can_view_only_their_own_request_details(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => false]);
        $ownRequest = $user->requests()->create(Requests::factory()->raw());
        $otherRequest = Requests::factory()->create();
        $this->actingAs($user)->get("/my-requests/{$ownRequest->id}")
            ->assertOk()
            ->assertViewIs('requests.show');
        $this->get("/my-requests/{$otherRequest->id}")->assertNotFound();
    }
    public function test_guest_cannot_access_my_requests(): void {
        $this->get('/my-requests')->assertRedirect('/login');
        $this->get('/my-requests/1')->assertRedirect('/login');
    }
    public function test_regular_user_cannot_access_admin_request_list(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user)->get('/admin/requests')->assertRedirect(route('home'));
    }
    public function test_authenticated_user_can_view_specific_request(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => true]);
        $request = Requests::factory()->create();
        $response = $this->actingAs($user)->get("/admin/requests/{$request->id}");
        $response->assertStatus(200);
        $response->assertViewIs('requests.show');
        $response->assertViewHas(['projectRequest', 'statusOptions']);
    }
    public function test_authenticated_user_can_update_request_status(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => true]);
        $request = Requests::factory()->create(['status' => 'pending']);
        $response = $this->actingAs($user)->patch("/admin/requests/{$request->id}/status", ['status' => 'in_progress']);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Request status updated successfully!');
        $this->assertDatabaseHas('requests', ['id' => $request->id, 'status' => 'in_progress']);
    }
    public function test_authenticated_user_can_delete_request(): void {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['is_admin' => true]);
        $request = Requests::factory()->create();
        $response = $this->actingAs($user)->delete("/admin/requests/{$request->id}");
        $response->assertRedirect(route('requests.index'));
        $response->assertSessionHas('success', 'Request deleted successfully!');
        $this->assertDatabaseMissing('requests', ['id' => $request->id]);
    }
    public function test_guest_cannot_access_admin_routes(): void {
        $request = Requests::factory()->create();
        $this->get('/admin/requests')->assertRedirect('/login');
        $this->get("/admin/requests/{$request->id}")->assertRedirect('/login');
        $this->patch("/admin/requests/{$request->id}/status", ['status' => 'in_progress'])->assertRedirect('/login');
        $this->delete("/admin/requests/{$request->id}")->assertRedirect('/login');
    }
}
