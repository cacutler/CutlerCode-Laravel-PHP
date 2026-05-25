@extends('master')
@section('title', 'Request Details')
@section('content')
<div class="request-details">
    <div class="page-header">
        <div class="header-left">
            <h1>Request #{{$request->id}}</h1>
            <div class="request-meta">
                <span class="badge {{ $request->getStatusBadgeClass() }}">{{ucfirst(str_replace('_', ' ', $request->status))}}</span>
                <span class="date">Submitted on {{ $request->created_at->format('F j, Y \a\t g:i A') }}</span>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{route('requests.index')}}" class="btn btn-outline">← Back to All Requests</a>
            <form action="{{route('requests.destroy', $request)}}" method="POST" class="delete-form" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request? This action cannot be undone.')">Delete Request</button>
            </form>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="request-content">
        <div class="status-section">
            <h2>Update Status</h2>
            <form action="{{route('requests.updateStatus', $request)}}" method="POST" class="status-update-form">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <select name="status" class="status-select-large">
                        @foreach($statusOptions as $value => $label)
                            <option value="{{$value}}" {{$request->status === $value ? 'selected' : ''}}>{{$label}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
        <div class="info-section">
            <h2>Contact Information</h2>
            <div class="info-grid">
                <div class="info-item">
                    <label>Name</label>
                    <span>{{$request->name}}</span>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <span><a href="mailto:{{$request->email}}">{{$request->email}}</a></span>
                </div>
                @if($request->phone)
                    <div class="info-item">
                        <label>Phone</label>
                        <span><a href="tel:{{$request->phone}}">{{$request->phone}}</a></span>
                    </div>
                @endif
                @if($request->location)
                    <div class="info-item">
                        <label>Location</label>
                        <span>{{$request->location}}</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="info-section">
            <h2>Organization Information</h2>
            <div class="info-grid">
                @if($request->company_name)
                    <div class="info-item">
                        <label>Organization Name</label>
                        <span>{{$request->company_name}}</span>
                    </div>
                @endif
                @if($request->website)
                    <div class="info-item">
                        <label>Website</label>
                        <span><a href="{{$request->website}}" target="_blank" rel="noopener">{{$request->website}}</a></span>
                    </div>
                @endif
                @if($request->employees)
                    <div class="info-item">
                        <label>Number of Employees</label>
                        <span>{{$request->employees}}</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="info-section">
            <h2>Project Information</h2>
            <div class="project-details">
                <div class="detail-item">
                    <label>Goal</label>
                    <div class="detail-content">{{$request->goal}}</div>
                    <label>Service/Tool</label>
                    <div class="detail-content">{{$request->service}}, {{$request->tool}}</div>
                </div>
                @if($request->challenge)
                    <div class="detail-item">
                        <label>Biggest Challenge</label>
                        <div class="detail-content">{{$request->challenge}}</div>
                    </div>
                @endif
                @if($request->comments)
                    <div class="detail-item">
                        <label>Additional Comments</label>
                        <div class="detail-content">{{$request->comments}}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
    .request-details {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    .header-left h1 {
        margin: 0 0 10px 0;
        color: #333;
    }
    .request-meta {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .badge {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.85em;
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
    .date {
        color: #666;
        font-size: 0.9em;
    }
    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .request-content {
        display: grid;
        gap: 30px;
    }
    .status-section, .info-section {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .status-section h2, .info-section h2 {
        margin: 0 0 20px 0;
        color: #333;
        font-size: 1.3em;
    }
    .status-update-form .form-group {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .status-select-large {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1em;
        min-width: 200px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .info-item label {
        font-weight: 600;
        color: #333;
        font-size: 0.9em;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-item span {
        color: #555;
        font-size: 1em;
    }
    .info-item a {
        color: #007bff;
        text-decoration: none;
    }
    .info-item a:hover {
        text-decoration: underline;
    }
    .project-details {
        display: grid;
        gap: 25px;
    }
    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .detail-item label {
        font-weight: 600;
        color: #333;
        font-size: 1em;
    }
    .detail-content {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 4px;
        border-left: 4px solid #007bff;
        line-height: 1.5;
        color: #555;
    }
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        font-weight: 500;
        display: inline-block;
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
    .btn:hover {
        opacity: 0.9;
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
            gap: 20px;
            align-items: stretch;
        }
        .header-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .request-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .status-update-form .form-group {
            flex-direction: column;
            align-items: stretch;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection