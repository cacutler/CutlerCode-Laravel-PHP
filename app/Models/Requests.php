<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Requests extends Model {
    use HasFactory;
    protected $fillable = [
        'name',
        'goal',
        'email',
        'company_name',
        'website',
        'employees',
        'location',
        'phone',
        'challenge',
        'comments',
        'status',
        'service',
        'tool'
    ];
    protected $casts = ['employees' => 'integer'];
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    protected $attributes = ['status' => self::STATUS_PENDING];
    /**
     * Get available status options
     */
    public static function getStatusOptions(): array {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled'
        ];
    }
    /**
     * Get status badge class for UI
     */
    public function getStatusBadgeClass(): string {
        return match($this->status) {
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_IN_PROGRESS => 'badge-info',
            self::STATUS_COMPLETED => 'badge-success',
            self::STATUS_CANCELLED => 'badge-danger',
            default => 'badge-secondary'
        };
    }
}