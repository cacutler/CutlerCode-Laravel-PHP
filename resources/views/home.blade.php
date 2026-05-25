@extends('master')
@section('title', 'Cutler Code')
@section('content')
<h1>Cutler Code</h1>
<p>Welcome to Cutler Code where we help kickstart your software and online presence.  We also offer software solutions like an AI automated development plan review tool for city governments.</p>
<h2>What We Offer</h2>
<div class="grid">
    <div class="offering-card">
        <h4>Website Building and Maintance</h4>
        <p>Includes deploying, hosting, and maintaining the site.</p>
    </div>
    <div class="offering-card">
        <h4>Web Applications</h4>
        <p>Includes deploying/publishing, hosting, and maintaining the web applications</p>
    </div>
    <div class="offering-card">
        <h4>Mobile Applications</h4>
        <p>Similar to web applications, includes publishing and maintaining the mobile applications</p>
    </div>
    <div class="offering-card">
        <h4>Software Consulting</h4>
        <p>Includes guidance on planning, designing, and implementating software</p>
    </div>
    <div class="offering-card">
        <h4>Software Tools and Offerings</h4>
        <p>Tools built by the company such as a city plan AI automated review tool</p>
    </div>
    <div class="offering-card">
        <h4>IT services</h4>
        <p>Basic IT services like computer guidance and skills, connecting printers, storage cleanup and backup, etc.</p>
    </div>
</div>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto;
        gap: 1rem;
        margin-top: 2%;
    }
    .offering-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 3px solid black;
        border-radius: 6px;
        background-color: #ffa900;
    }
    h2 {
        margin-top: 3%;
    }
    .offering-card p, .offering-card h4 {
        padding-top: 0.5rem;
    }
    h4 {
        border-bottom: 2px solid black;
        width: 75%;
        text-align: center;
    }
</style>
@endsection