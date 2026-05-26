<?php
namespace Tests\Feature;
use App\Models\Requests;
use App\Models\User;
use App\Notifications\NewRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class NewRequestNotificationTest extends TestCase {
    use RefreshDatabase;
    public function test_notification_has_correct_channels(): void {
        $request = Requests::factory()->create();
        $user = User::factory()->create();
        $notification = new NewRequest($request);
        $channels = $notification->via($user);
        $this->assertEquals(['mail', 'database'], $channels);
    }
    public function test_notification_creates_correct_mail_message(): void {
        $request = Requests::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com', 'company_name' => 'Test Company', 'goal' => 'Build a website']);
        $user = User::factory()->create(['name' => 'Admin User']);
        $notification = new NewRequest($request);
        $mailMessage = $notification->toMail($user);
        $this->assertEquals('New Project Request Submitted - CutlerTech', $mailMessage->subject);
        $this->assertStringContainsString('Hello Admin User!', $mailMessage->greeting);
    }
    public function test_notification_creates_correct_database_entry(): void {
        $request = Requests::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com', 'company_name' => 'Test Company']);
        $user = User::factory()->create();
        $notification = new NewRequest($request);
        $databaseData = $notification->toDatabase($user);
        $this->assertEquals('new_project_request', $databaseData['type']);
        $this->assertEquals($request->id, $databaseData['request_id']);
        $this->assertEquals('John Doe', $databaseData['client_name']);
        $this->assertEquals('john@example.com', $databaseData['client_email']);
        $this->assertEquals('Test Company', $databaseData['company_name']);
    }
}