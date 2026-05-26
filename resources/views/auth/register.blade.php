@extends('master')
@section('title', 'Register')
@section('content')
<div class="auth-container">
    <h1>Register</h1>
    <div class="auth-form">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <form action="{{route('register.post')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{old('name')}}" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password" required>
            </div>
            <button type="submit" class="submit" style="color: black">Register</button>
        </form>
        <div class="auth-links">
            <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
        </div>
    </div>
</div>
<style>
    .auth-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
    }
    .auth-container h1 {
        padding-bottom: 1rem;
    }
    .auth-form {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
        background-color: #FFA900;
        border: 3px solid black;
    }
    .auth-form h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
    }
    .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid black;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .btn-full {
        width: 100%;
    }
    .auth-links {
        text-align: center;
        margin-top: 20px;
    }
    .auth-links a {
        color: white;
        text-decoration: none;
    }
    .auth-links a:hover {
        text-decoration: underline;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    button.submit {
        -webkit-appearance: none;
        appearance: none;
        display: inline-block;
        padding: 0.5rem 1rem;
        margin-top: 0.75rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        transition: transform 120ms ease, box-shadow 120ms ease, background-color 120ms ease;
        box-shadow: 0 6px 0 rgba(0,0,0,0.12);
        user-select: none;
        background-color: #00FF81;
    }
    button.submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 0 rgba(0,0,0,0.14);
        background-color: #00FF81;
    }
    button.submit:active, button.submit:focus {
        transform: translateY(2px) scale(0.995);
        box-shadow: inset 0 3px 0 rgba(0,0,0,0.12);
        outline: none;
        background-color: #00FF81;
    }
    button.submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    @media screen and (max-width: 768px) {
        .auth-form {
            padding: 0;
        }
    }
</style>
@endsection