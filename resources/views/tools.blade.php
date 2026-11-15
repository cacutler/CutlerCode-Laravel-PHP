@extends('master')
@section('title', 'Software Tools/Offerings')
@section('content')
<h1>Software Tools and Offerings</h1>
<div class="grid">
    <div class="software-card">
        <h3>Park Reservations</h3>
        <a href="https://github.com/cacutler/Park-Reservations-CSharp-ASPNet"><img src="{{asset('images/ParkReservationsProject.png')}}" alt="Park Reservations Github Repository Link" class="tool-image"></a>
        <p><b>Pricing:</b> $300/month</p>
        <h4>Features</h4>
        <ul>
            <li>City admins approve or deny reservation requests for city parks they oversee</li>
            <li>All users can make, update, or delete their own reservation requests along with their own current and past reservations</li>
            <li>All users can select parks between different cities and see the availability and schedules of the parks</li>
            <li>City admins can create and update parks and their availability/schedule in their own city</li>
        </ul>
    </div>
    <div class="software-card">
        <h3>AI Automated City Plan Review</h3>
        <a href="https://github.com/cacutler/AI-Subdivision-Plan-Review-FastAPI-React"><img src="{{ asset('images/SubdivisionPlan.png') }}" alt="AI Automated City Plan Review Github Repository Link" class="tool-image"></a>
        <p><b>Pricing:</b> $400/month</p>
        <h4>Features</h4>
        <ul>
            <li>Engineers can upload PDFs for analysis and store those files with the results</li>
            <li>The tool parses and analyzes uploaded PDFs</li>
        </ul>
    </div>
</div>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: auto;
    }
    .software-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 3px solid black;
        border-radius: 6px;
        width: 90%;
        height: auto;
        margin: 1rem auto;
        text-align: center;
        padding: 1rem 1.5rem;
        background-color: #ffa900;
    }
    ul {
        text-align: left;
    }
    .tool-image {
        width: 100%;
        height: auto;
        margin: 0.5rem auto;
        border-radius: 6px;
    }
    h3 {
        border-bottom: 2px solid black;
        width: 80%;
    }
    @media screen and (max-width: 992px) {
        .software-card {
            width: 70%;
        }
        .grid {
            display: flex;
            flex-direction: column;
        }
    }
    @media screen and (max-width: 768px) {
        .software-card {
            width: 100%;
        }
    }
</style>
@endsection
