<?php
namespace App\Http\Controllers;
use App\ServiceType;
use App\ToolType;
use App\Models\Requests;
use App\Models\User;
use App\Notifications\NewRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Log;
use Exception;
use Illuminate\Support\Facades\Auth;
class RequestsController extends Controller {
    /**
     * Display the requests form
     */
    public function create(): View {
        return view('requests');
    }
    /**
     * Store a new project request
     */
    public function store(Request $request): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'goal' => 'required|string',
            'email' => 'required|email|max:255',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'employees' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'challenge' => 'nullable|string',
            'comments' => 'nullable|string',
            'service' => ['nullable', 'string', Rule::enum(ServiceType::class)],
            'tool' => ['nullable', 'string', Rule::enum(ToolType::class)]
        ]);// Validate the incoming request
        $newRequest = Requests::create($validatedData);// Create the new request record
        $this->sendNewRequestNotification($newRequest);// Send notification to admin users
        return redirect()->back()->with('success', 'Your project request has been submitted successfully!');// Redirect back with success message
    }
    /**
     * Display all project requests (admin view)
     */
    public function index(): View {
        $requests = Requests::latest('created_at')->paginate(15);
        $statusOptions = Requests::getStatusOptions();
        return view('requests.index', compact('requests', 'statusOptions'));
    }
    /**
     * Display a specific project request
     */
    public function show(Requests $projectRequest): View {
        $statusOptions = Requests::getStatusOptions();
        return view('requests.show', ['projectRequest' => $projectRequest, 'statusOptions' => $statusOptions, 'request' => $projectRequest]);
    }
    /**
     * Update request status
     */
    public function updateStatus(Request $httpRequest, Requests $projectRequest): RedirectResponse {
        $validatedData = $httpRequest->validate(['status' => 'required|in:pending,in_progress,completed,cancelled']);
        $projectRequest->status = $validatedData['status'];
        $projectRequest->save();
        return redirect()->back()->with('success', 'Request status updated successfully!');
    }
    /**
     * Delete a project request
     */
    public function destroy(Requests $projectRequest): RedirectResponse {
        $projectRequest->deleteOrFail();
        return redirect()->route('requests.index')->with('success', 'Request deleted successfully!');
    }
    /**
     * Display notifications for authenticated user
     */
    public function notifications(): View {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }
    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId): RedirectResponse {
        $user = Auth::user();
        $notification = $user->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(): RedirectResponse {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
    /**
     * Send new request notification to admin users
     */
    private function sendNewRequestNotification(Requests $request): void {
        try {
            $adminUsers = User::where('is_admin', '=', true, 'and')->get();
            foreach ($adminUsers as $user) {// Send notification to each admin user
                $user->notify(new NewRequest($request));
            }
        } catch (Exception $e) {// Log the error but don't break the request submission
            Log::error('Failed to send new request notification: ' . $e->getMessage());
        }
    }
    /**
     * Delete a specific notification
     */
    public function deleteNotification($notificationId): RedirectResponse {
        $user = Auth::user();
        $notification = $user->notifications()->find($notificationId);
        if ($notification) {
            $notification->delete();
            return redirect()->back()->with('success', 'Notification deleted successfully.');
        }
        return redirect()->back()->with('error', 'Notification not found.');
    }
    /**
     * Delete all notifications for the authenticated user
     */
    public function deleteAllNotifications(): RedirectResponse {
        Auth::user()->notifications()->delete();
        return redirect()->back()->with('success', 'All notifications deleted successfully.');
    }
}