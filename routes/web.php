<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\View\View;
Route::get('/', function (): View {
    return view('home');
})->name('home');
Route::get('/about', function (): View {
    return view('about');
})->name('about');
Route::get('/skills', function (): View {
    return view('skills');
})->name('skills');
Route::get('/projects', function (): View {
    return view('projects');
})->name('projects');
Route::get('/pricing', function (): View {
    return view('pricing');
})->name('pricing');
Route::get('/tools', function (): View {
    return view('tools');
})->name('tools');
Route::get('/requests', [RequestsController::class, 'create'])->name('requests.create');// Public request form
Route::post('/requests', [RequestsController::class, 'store'])->name('requests.store');
Route::middleware('guest')->group(function (): void {// Authentication routes (only for guests)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::middleware('auth')->group(function (): void {// Authenticated user routes
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::middleware(['auth', 'admin'])->group(function (): void {// Protected routes (require authentication and admin role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/requests', [RequestsController::class, 'index'])->name('requests.index');// Admin request management
    Route::get('/admin/requests/{projectRequest}', [RequestsController::class, 'show'])->name('requests.show');
    Route::delete('/admin/requests/{projectRequest}', [RequestsController::class, 'destroy'])->name('requests.destroy');
    Route::patch('/admin/requests/{projectRequest}/status', [RequestsController::class, 'updateStatus'])->name('requests.updateStatus');
    Route::get('/notifications', [RequestsController::class, 'notifications'])->name('notifications.index');// Notification routes
    Route::get('/notifications/{notification}/mark-read', [RequestsController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::get('/notifications/mark-all-read', [RequestsController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [RequestsController::class, 'deleteNotification'])->name('notifications.delete');
    Route::delete('/notifications', [RequestsController::class, 'deleteAllNotifications'])->name('notifications.delete-all');
});