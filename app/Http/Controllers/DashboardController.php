<?php
namespace App\Http\Controllers;
use App\Models\Requests;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller {
    /**
     * Display the dashboard with requests overview
     */
    public function index(): View {
        $recentRequests = Requests::latest('created_at')->take(5)->get();
        $totalRequests = Requests::count('id');
        $pendingRequests = Requests::where('status', '=', 'pending', 'and')->count();
        $completedRequests = Requests::where('status', '=', 'completed', 'and')->count();
        $inProgressRequests = Requests::where('status', '=', 'in_progress', 'and')->count();
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            $monthExpr = "DATE_FORMAT(created_at, '%Y-%m')";
        } elseif ($driver === 'pgsql') {
            $monthExpr = "to_char(created_at, 'YYYY-MM')";
        } else {
            $monthExpr = "strftime('%Y-%m', created_at)";
        }
        $requestsByMonth = Requests::selectRaw("COUNT(*) as count, {$monthExpr} as month", [])->groupBy('month')->orderBy('month')->pluck('count', 'month');
        return view('users.dashboard', [
            'recentRequests' => $recentRequests,
            'totalRequests' => $totalRequests,
            'pendingRequests' => $pendingRequests,
            'completedRequests' => $completedRequests,
            'inProgressRequests' => $inProgressRequests,
            'requestsByMonth' => $requestsByMonth
        ]);
    }
}