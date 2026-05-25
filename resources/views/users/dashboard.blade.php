@extends('master')
@section('title', 'Dashboard')
@section('content')
<div class="dashboard">
    <div class="dashboard-header"><h1>Project/Services Dashboard</h1></div>
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="stats-grid">
        <div class="stat-card">
            <h3>{{$totalRequests}}</h3>
            <p>Total Requests</p>
        </div>
        <div class="stat-card pending">
            <h3>{{$pendingRequests}}</h3>
            <p>Pending</p>
        </div>
        <div class="stat-card in-progress">
            <h3>{{$inProgressRequests}}</h3>
            <p>In Progress</p>
        </div>
        <div class="stat-card completed">
            <h3>{{$completedRequests}}</h3>
            <p>Completed</p>
        </div>
    </div>
    <div class="recent-requests">
        <div class="section-header">
            <h2>Recent Requests</h2>
            <a href="{{route('requests.index')}}" class="btn btn-primary">View All</a>
        </div>
        @if($recentRequests->count() > 0)
            <div class="requests-table">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Organization</th>
                            <th>Goal</th>
                            <th>Service</th>
                            <th>Tool</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentRequests as $request)
                            <tr>
                                <td>{{$request->name}}</td>
                                <td>{{$request->company_name ?? 'N/A'}}</td>
                                <td>{{Str::limit($request->goal, 50)}}</td>
                                <td>{{$request->service}}</td>
                                <td>{{$request->tool}}</td>
                                <td><span class="badge {{$request->getStatusBadgeClass()}}">{{ucfirst(str_replace('_', ' ', $request->status))}}</span></td>
                                <td>{{$request->created_at->format('M j, Y')}}</td>
                                <td><a href="{{route('requests.show', $request)}}" class="btn btn-sm btn-outline">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state"><p>No requests yet. <a href="{{route('requests.create')}}">Share the request form</a> to get started!</p></div>
        @endif
    </div>
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="action-buttons">
            <a href="{{route('requests.index')}}" class="btn btn-primary">Manage All Requests</a>
            <a href="{{route('requests.create')}}" class="btn btn-outline">View Request Form</a>
        </div>
    </div>
</div>
<style>
    .dashboard {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-align: center;
    }
    .stat-card h3 {
        font-size: 2em;
        margin: 0 0 10px 0;
        color: #FF6800;
    }
    .stat-card.pending h3 {
        color: #FFA900;
    }
    .stat-card.in-progress h3 {
        color: #00F0FF;
    }
    .stat-card.completed h3 {
        color: #00FF81;
    }
    .recent-requests {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .requests-table table {
        width: 100%;
        border-collapse: collapse;
    }
    .requests-table th, .requests-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    .requests-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.8em;
        font-weight: 500;
    }
    .badge-warning {
        background-color: #fff3cd;
        color: #856404;
    }
    .badge-info {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    .badge-success {
        background-color: #d4edda;
        color: #155724;
    }
    .badge-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    .quick-actions {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .action-buttons {
        display: flex;
        gap: 15px;
    }
    .empty-state {
        text-align: center;
        padding: 40px;
        color: #666;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>
@endsection