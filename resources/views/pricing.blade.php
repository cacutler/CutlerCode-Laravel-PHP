@extends('master')
@section('title', 'Pricing')
@section('content')
<h1>Pricing</h1>
<p>Hourly rate starts at $25/hour for software work and $15/hour for IT work.  The software work hourly rate is used for projects with unclear or shifting scopes or applying frequent iterations, revisions, or updates to projects.</p>
<div class="grid">
    <div class="pricing-card">
        <h3>Websites</h3>
        <p>High-quality development of websites with the most modern and high-quality design made at a professional level.</p>
        <ul>
            <li>Single person and small groups starting at $200/project</li>
            <li>Small businesses starting at $300/project</li>
            <li>Designing website theme and brand</li>
            <li>Content Creation</li>
            <li>Website/Content Maintance and Hosting - seperate small fee of $20 charged per month for making sure the software and content is up to date and the site remains online</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Web Applications</h3>
        <p>High-quality development of web applications at the professional level.</p>
        <ul>
            <li>Single person and small groups starting at $250/project</li>
            <li>Small businesses starting at $400/project</li>
            <li>Database</li>
            <li>Back-end Server</li>
            <li>Front-end User Interface</li>
            <li>Web Application Maintance and Hosting - seperate small fee of $30 charged per month for making sure the software is up to date and working and the site remains online</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Mobile Applications</h3>
        <p>Professional development of mobile applications for iOS and Android.</p>
        <ul>
            <li>Single person and small groups starting at $400/project</li>
            <li>Small businesses starting at $600/project</li>
            <li>Cross platform apps for both iOS and Android using Flutter or React Native</li>
            <li>Fully native platform apps using Swift/Swift for iOS or Kotlin/Jetpack Compose for Android</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Software Consulting</h3>
        <p>Professional guidance of software planning, designing, and implementation that drives real results.</p>
        <ul>
            <li>Hourly rate starting at $20/hour.</li>
            <li>Software architecture and system design</li>
            <li>Cloud migration and infrastructure planning</li>
            <li>Custom app development strategy</li>
            <li>API integration and automation</li>
            <li>Performance optimization and scalability planning</li>
            <li>Agile process and DevOps consulting</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Software Tools and Offerings</h3>
        <p>Each tool is individually priced based on factors like operating and data storage costs.</p>
        <ul>
            <li>Park Reservations - starts at $100/month for maintenance, data storage, and hosting</li>
            <li>AI Automated City Plan Review - starts at $200/month for AI usage, maintenance, data storage, and hosting</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>IT Services</h3>
        <p>Professional help with basic computer work like printer connections, storage work, etc. and learning basic computer skills like keyboard shortcuts.</p>
        <ul>
            <li>Printer connections for computers (covers driver downloads)</li>
            <li>Basic computer skills like researching/googling, basic setting configuring, etc.</li>
            <li>OS (operating system) updates</li>
            <li>Storage cleanup/backup</li>
        </ul>
    </div>
</div>
<p id="footnote">All of these rates and plans are subject to specific needs and negotiations but will generally be close to, if not no less than, these starting prices and rates.</p>
<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: auto;
        gap: 0.75rem;
    }
    .pricing-card {
        display: flex;
        flex-direction: column;
        border: 3px solid black;
        border-radius: 6px;
        width: 100%;
        margin: 0.5rem auto;
        padding: 2rem;
        background-color: #ffa900;
    }
    h3, h2 {
        text-align: center;
    }
    h3 {
        border-bottom: 2px solid black;
        padding-bottom: 0.25rem;
    }
    ul {
        margin: 0 auto;
        padding: 0 auto;
    }
    p {
        padding: 0 !important;
    }
    .pricing-card p {
        margin-top: 1rem;
    }
    #footnote {
        margin: 1rem auto;
        font-size: small;
    }
    @media screen and (max-width: 992px) {
        .grid {
            display: flex;
            flex-direction: column;
        }
        .pricing-card {
            width: 70%;
        }
    }
    @media screen and (max-width: 768px) {
        .pricing-card {
            width: 100%;
        }
        h3 {
            width: 100%;
        }
    }
</style>
@endsection