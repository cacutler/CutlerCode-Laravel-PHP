@extends('master')
@section('title', 'Skills and Tech Stacks')
@section('content')
<h1>Team Skillset and Tech Stack</h1>
<div class="grid-container">
    <div class="skill-card">
        <h4 class="title">Alex Cutler</h4>
        <small><b>CEO/Owner</b></small>
        <div class="card-lists">
            <div class="left-side">
                <b>Stack</b>
                <ul>
                    <li>MEVN - MongoDB, Express, Vue, and Node</li>
                    <li>MEAN - MongoDB, Express, Angular, and Node</li>
                    <li>MERN - MongoDB, Express, React, and Node</li>
                </ul>
                <b>Languages</b>
                <ul>
                    <li>Python</li>
                    <li>C</li>
                    <li>C++</li>
                    <li>C#</li>
                    <li>32-bit RISC-V Assembly</li>
                    <li>JavaScript</li>
                    <li>TypeScript</li>
                    <li>Swift</li>
                    <li>Kotlin</li>
                    <li>SQL</li>
                    <li>PHP</li>
                    <li>Java</li>
                </ul>
            </div>
            <div class="right-side">
                <b>Specialities</b>
                <ul>
                    <li>Web Development</li>
                    <li>Mobile Development</li>
                    <li>Web Design</li>
                </ul>
                <b>Frameworks and Tools</b>
                <ul>
                    <li>Flask (Python)</li>
                    <li>Vue (JavaScript)</li>
                    <li>Express (JavaScript)</li>
                    <li>Node (JavaScript)</li>
                    <li>Angular (TypeScript)</li>
                    <li>React (JavaScript/JSX)</li>
                    <li>MongoDB (Database)</li>
                    <li>SQLite (Database)</li>
                    <li>MySQL (Database)</li>
                    <li>Laravel (PHP)</li>
                    <li>Unity (C#)</li>
                    <li>Wordpress (PHP)</li>
                    <li>ASP.Net (C#)</li>
                    <li>Spring/Spring Boot (Java)</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        grid-template-rows: auto;
    }
    .skill-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 3px solid black;
        border-radius: 6px;
        margin: 2rem auto 0;
        width: 50%;
        padding: 0 2rem;
        background-color: #ffa900;
    }
    .title {
        margin-top: 1rem;
    }
    .title ~ small b {
        padding: 0.5rem 2rem;
        border-bottom: 2px solid black;
    }
    .card-lists {
        display: flex;
        flex-direction: row;
        gap: 3rem;
        margin-top: 1rem;
    }
    @media screen and (max-width: 1200px) {
        .skill-card {
            width: 70%;
        }
    }
    @media screen and (max-width: 768px) {
        .grid-container {
            display: flex;
            flex-direction: column;
        }
        .skill-card {
            width: 60%;
        }
        .card-lists {
            gap: 3rem;
        }
    }
    @media screen and (max-width: 599px) {
        .card-lists {
            display: inline;
        }
        .skill-card {
            width: 100%;
            padding: 0 4rem;
            margin: 0;
        }
    }
</style>
@endsection
