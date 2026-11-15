@extends('master')
@section('title', 'Projects')
@section('content')
<h1>Highlighted Projects</h1>
<div class="grid">
    <div class="project-card">
        <h2>Cutler Code Website</h2>
        <a href="https://github.com/CutlerCode/CutlerCode-Laravel-PHP"><img src="{{asset('images/CutlerCodeProject.png')}}" alt="Cutler Code GitHub Repository Link" class="project-image"></a>
        <b>Web Development</b>
        <p>Stack: Laravel, PHP, and MySQL</p>
        <p>Developer: Alex Cutler</p>
    </div>
    <div class="project-card">
        <h2>Park Reservations</h2>
        <a href="https://github.com/cacutler/Park-Reservations-CSharp-ASPNet"><img src="{{asset('images/ParkReservationsProject.png')}}" alt="Park Reservations GitHub Repository Link" class="project-image"></a>
        <b>Web Development</b>
        <p>Stack: C#, .NET/ASP.NET, Razor, and SQLite</p>
        <p>Developer: Alex Cutler</p>
    </div>
    <div class="project-card">
        <h2>AI Subdivision Plan Review</h2>
        <a href="https://github.com/cacutler/AI-Subdivision-Plan-Review-FastAPI-React"><img src="{{asset('images/SubdivisionPlan.png')}}" alt="AI Subdivision Plan Review GitHub Repository Link" class="project-image"></a>
        <b>Web Development</b>
        <p>Stack: Python, FastAPI, React, TypeScript, Tailwind CSS, and PostgreSQL</p>
        <p>Developer: Alex Cutler</p>
    </div>
</div>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto;
    }
    .project-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 3px solid black;
        border-radius: 6px;
        width: 80%;
        height: auto;
        margin: 1rem auto;
        text-align: center;
        padding: 1rem 2rem;
        background-color: #ffa900;
    }
    .project-image {
        width: 100%;
        height: auto;
        margin: 0.5rem auto;
        border-radius: 6px;
    }
    p {
        padding: 0 !important;
    }
    h2 {
        border-bottom: 2px solid black;
        width: 75%;
        text-align: center;
    }
    @media screen and (max-width: 992px) {
        .project-card {
            width: 70%;
        }
        .grid {
            display: flex;
            flex-direction: column;
        }
    }
    @media screen and (max-width: 768px) {
        .project-card {
            width: 100%;
        }
    }
</style>
@endsection
