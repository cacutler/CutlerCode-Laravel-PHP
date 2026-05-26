<?php
namespace Tests\Unit;
use App\Models\Requests;
use App\ToolType;
use App\ServiceType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class RequestsModelTest extends TestCase {
    use RefreshDatabase;
    public function test_it_has_correct_fillable_attributes(): void {
        $request = new Requests();
        $expected = ['name', 'goal', 'email', 'company_name', 'website', 'employees', 'location', 'phone', 'challenge', 'comments', 'status', 'service', 'tool'];
        $this->assertEquals($expected, $request->getFillable());
    }
    public function test_it_has_default_pending_status(): void {
        $request = new Requests();
        $this->assertEquals('pending', $request->status);
    }
    public function test_it_has_default_service(): void {
        $request = new Requests();
        $this->assertEquals(ServiceType::OTHER, $request->service);
    }
    public function test_it_has_default_tool(): void {
        $request = new Requests();
        $this->assertEquals(ToolType::OTHER, $request->tool);
    }
    public function test_it_returns_correct_status_options(): void {
        $expected = [
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ];
        $this->assertEquals($expected, Requests::getStatusOptions());
    }
    public function test_it_returns_correct_status_badge_classes(): void {
        $request = new Requests();
        $request->status = 'pending';
        $this->assertEquals('badge-warning', $request->getStatusBadgeClass());
        $request->status = 'in_progress';
        $this->assertEquals('badge-info', $request->getStatusBadgeClass());
        $request->status = 'completed';
        $this->assertEquals('badge-success', $request->getStatusBadgeClass());
        $request->status = 'cancelled';
        $this->assertEquals('badge-danger', $request->getStatusBadgeClass());
        $request->status = 'unknown';
        $this->assertEquals('badge-secondary', $request->getStatusBadgeClass());
    }
    public function test_employees_attribute_is_cast_to_integer(): void {
        $request = Requests::factory()->create(['employees' => '10']);
        $this->assertIsInt($request->employees);
        $this->assertEquals(10, $request->employees);
    }
}