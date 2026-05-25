@extends('master')
@section('title', 'All Requests')
@section('content')
<div class="requests-admin">
    <div class="page-header">
        <h1>All Project Requests</h1>
        <div class="header-actions"><a href="{{route('dashboard')}}" class="btn btn-outline">← Back to Dashboard</a></div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="stats-summary">
        <div class="stat-item">
            <span class="stat-number">{{$requests->total()}}</span>
            <span class="stat-label">Total Requests</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{$requests->where('status', 'pending')->count()}}</span>
            <span class="stat-label">Pending</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{$requests->where('status', 'in_progress')->count()}}</span>
            <span class="stat-label">In Progress</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{$requests->where('status', 'completed')->count()}}</span>
            <span class="stat-label">Completed</span>
        </div>
    </div>
    @if($requests->count() > 0)
        <div class="requests-table-container">
            <table class="requests-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Email</th>
                        <th>Goal</th>
                        <th>Service</th>
                        <th>Tool</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>#{{$request->id}}</td>
                            <td>{{$request->name}}</td>
                            <td>{{$request->company_name ?? 'N/A'}}</td>
                            <td>{{$request->email}}</td>
                            <td>{{Str::limit($request->goal, 40)}}</td>
                            <td>{{$request->service}}</td>
                            <td>{{$request->tool}}</td>
                            <td>
                                <form action="{{route('requests.updateStatus', $request)}}" method="POST" class="status-form">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="status-select {{$request->getStatusBadgeClass()}}">
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{$value}}" {{$request->status === $value ? 'selected' : ''}}>{{$label}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>{{$request->created_at->format('M j, Y')}}</td>
                            <td class="actions">
                                <a href="{{route('requests.show', $request)}}" class="btn btn-sm btn-primary">View</a>
                                <form action="{{route('requests.destroy', $request)}}" method="POST" class="delete-form" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{$requests->links()}}</div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📋</div>
            <h3>No Requests Yet</h3>
            <p>When people submit project requests, they'll appear here.</p>
            <a href="{{route('requests.create')}}" class="btn btn-primary">View Request Form</a>
        </div>
    @endif
</div>
<style>
    .requests-admin {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-item {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        text-align: center;
    }
    .stat-number {
        display: block;
        font-size: 2em;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }
    .stat-label {
        font-size: 0.9em;
        color: #666;
    }
    .requests-table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow-x: auto;
        margin-bottom: 20px;
    }
    .requests-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    .requests-table th, .requests-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    .requests-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333;
    }
    .requests-table tr:hover {
        background-color: #f8f9fa;
    }
    .status-form {
        margin: 0;
    }
    .status-select {
        border: none;
        background: transparent;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.85em;
        font-weight: 500;
        cursor: pointer;
    }
    .status-select.badge-warning {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-select.badge-info {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    .status-select.badge-success {
        background-color: #d4edda;
        color: #155724;
    }
    .status-select.badge-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    .actions {
        white-space: nowrap;
    }
    .actions .btn {
        margin-right: 5px;
    }
    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        font-weight: 500;
        display: inline-block;
    }
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.85em;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    .btn-outline {
        background-color: transparent;
        color: #007bff;
        border: 1px solid #007bff;
    }
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .empty-icon {
        font-size: 4em;
        margin-bottom: 20px;
    }
    .empty-state h3 {
        color: #333;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: #666;
        margin-bottom: 20px;
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
    .delete-form {
        display: inline;
    }
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
        .stats-summary {
            grid-template-columns: repeat(2, 1fr);
        }
        .requests-table-container {
            margin: 0 -20px;
            border-radius: 0;
        }
    }
</style>
@endsection