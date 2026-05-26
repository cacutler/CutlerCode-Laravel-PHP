@extends('master')
@section('title', 'About Us')
@section('content')
<h1>Meet the Team</h1>
<div class="grid">
    <div class="about-card">
        <img src="{{asset('images/Alex_Headshot.jpg')}}" alt="Alex Cutler Headshot" class="headshot">
        <h4>Alex Cutler</h4>
        <b>CEO/Owner</b>
        <p>Alex is the software brains behind Cutler Code.  He graduated from Utah Tech University with a BS in Software Engineering.</p>
    </div>
</div>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        grid-template-rows: auto;
    }
    .about-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 3px solid black;
        border-radius: 6px;
        width: 30%;
        margin: 2rem auto 0;
        text-align: center;
        padding: 1rem;
        background-color: #ffa900;
    }
    .about-card img {
        border: 1px solid black;
    }
    .about-card * {
        margin: 0.5rem;
    }
    .about-card h4 {
        border-top: 2px solid black;
        width: 50%;
        margin: 1rem auto 0.25rem;
    }
    .about-card p {
        margin: 0;
        padding: 1rem 0;
    }
    .headshot {
        width: auto;
        height: 300px;
        border-radius: 6px;
    }
    @media screen and (max-width: 1200px) {
        .about-card {
            width: 70%;
        }
        .headshot {
            width: 60%;
            height: auto;
        }
    }
    @media screen and (max-width: 768px) {
        .grid {
            display: flex;
            flex-direction: column;
        }
        .about-card {
            width: 100%;
        }
        .headshot {
            width: 75%;
            height: auto;
        }
    }
</style>
@endsection