@extends('master')
@section('title', 'Requests')
@section('content')
<h1>Project Requests</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif
<form action="{{route('requests.store')}}" method="POST" id="requests-form">
    @csrf
    <label for="name">Name *</label>
    <input type="text" name="name" id="name" placeholder="Your name">
    <label for="goal">What are you hoping to accomplish? *</label>
    <input type="text" name="goal" placeholder="Goal">
    <label for="email">Email Address *</label>
    <input type="email" name="email" id="email" placeholder="Email Address">
    <label for="service">Service</label>
    <select name="service">
        <option value="website">Website</option>
        <option value="web app">Web Application</option>
        <option value="mobile app">Mobile Application</option>
        <option value="consulting">Software Consulting</option>
        <option value="tool">Software Tool</option>
        <option value="IT">IT Work</option>
        <option value="other" selected>Other</option>
    </select>
    <label for="tool">Software Tool (if applicable)</label>
    <select name="tool">
        <option value="park">Park Reservations</option>
        <option value="plan review">AI Automated City Plan Review</option>
        <option value="other" selected>Other</option>
    </select>
    <label for="company-name">Name of your company or business</label>
    <input type="text" name="company-name" placeholder="Company/Business Name">
    <label for="website">Current Website</label>
    <input type="url" name="website" placeholder="Website">
    <label for="employees">Number of Employees</label>
    <input type="number" min="1" name="employees" id="employees" placeholder="Number of Employees">
    <label for="location">Location</label>
    <input type="text" name="location" placeholder="Location">
    <label for="phone">Phone Number</label>
    <input type="tel" name="phone" placeholder="Phone Number">
    <label for="challenge">Biggest Challenge</label>
    <input type="text" name="challenge" placeholder="Biggest Challenge">
    <label for="comments">Anything else</label>
    <textarea name="comments" id="comments" placeholder="Anything Else?"></textarea>
    <input type="submit" name="submit" class="submit">
</form>
<style>
    #requests-form {
        width: 50%;
        border: 3px solid black;
        background-color: #FFA900;
    }
    input.submit {
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
    }
    input.submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 0 rgba(0,0,0,0.14);
    }
    input.submit:active, input.submit:focus {
        transform: translateY(2px) scale(0.995);
        box-shadow: inset 0 3px 0 rgba(0,0,0,0.12);
        outline: none;
    }
    input.submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    @media screen and (max-width: 599px) {
        #requests-form {
            width: 100%;
        }
    }
</style>
@endsection