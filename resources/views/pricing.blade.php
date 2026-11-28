@extends('master')
@section('title', 'Pricing')
@section('content')
<h1>Pricing</h1>
<p>Software development & consulting starts at $45/hour (currently offering a $35/hour introductory rate for select new clients), and IT support starts at $25/hour. Hourly billing applies to ongoing updates, custom consulting, and projects with evolving scopes.</p>
<div class="grid">
    <div class="pricing-card">
        <h3>Websites</h3>
        <p>Modern, responsive websites designed to help individuals and small businesses stand out online.</p>
        <ul>
            <li>Landing Page / Starter Site: Starting at $500 (1–2 pages, mobile-friendly design, contact form)</li>
            <li>Small Business Website: Starting at $850 (up to 5 pages, custom theme & branding, basic SEO setup)</li>
            <li>Scope & Revisions: Includes initial copy/content integration and up to 2 rounds of revisions</li>
            <li>Hosting & Maintenance: Optional $35/month plan covering hosting, uptime monitoring, security updates, and minor text/image edits (up to 1 hour/month)</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Web Applications</h3>
        <p>Custom full-stack web applications built for reliability, speed, and clean user workflows.</p>
        <ul>
            <li>Single-Purpose / Starter MVP: Starting at $1,000</li>
            <li>Small Business Custom App: Starting at $1,500+ (scoped by milestone)</li>
            <li>Full-Stack Architecture: Custom front-end interface, back-end API/server logic, and database setup</li>
            <li>Hosting & Maintenance: Optional $45/month base plan covering server hosting, database backups, and routine bug/dependency updates (cloud/API usage billed at cost if exceeded)</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Mobile Applications</h3>
        <p>Cross-platform and native mobile apps built for iOS and Android.</p>
        <ul>
            <li>Starter / Companion App: Starting at $1,200/li>
            <li>Custom Business App: Starting at $2,000+ (scoped by milestone)</li>
            <li>Cross-Platform Development: Single codebase for iOS and Android using Flutter or React Native</li>
            <li>Native Development: Platform-specific performance using Swift / SwiftUI (iOS) and Kotlin / Jetpack Compose (Android)</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Software Consulting</h3>
        <p>Technical guidance to help you plan, integrate, and improve your software systems.</p>
        <ul>
            <li>Rate: Starting at $45/hour ($35/hour introductory rate)</li>
            <li>Architecture & Planning: System design, tech stack selection, and MVP roadmapping</li>
            <li>Integrations & Automation: Connecting third-party APIs, automating workflows, and reducing manual data entry</li>
            <li>Cloud & Optimization: Cloud setup/migration, performance tuning, and DevOps workflow improvements</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>Software Tools and Offerings</h3>
        <p>Specialized software solutions tailored to operational and municipal workflows. (Pricing scales based on user volume, data storage, and AI/compute usage.)</p>
        <ul>
            <li>Park Reservations System: Starting at $400/month (includes hosting, data storage, and ongoing maintenance)</li>
            <li>AI Automated City Plan Review: Starting at $500/month (base license, hosting, and maintenance; high-volume AI processing billed by usage) — Currently in active development</li>
        </ul>
    </div>
    <div class="pricing-card">
        <h3>IT Services</h3>
        <p>Patient, reliable hands-on tech help for everyday computer, network, and device tasks.</p>
        <ul>
            <li>Rate: Starting at $25/hour (1-hour minimum for on-site visits)</li>
            <li>Device & Printer Setup: Computer setup, printer connections, and driver installations</li>
            <li>System Upkeep: Operating system updates, storage cleanup, and cloud/external backups</li>
            <li>1-on-1 Tech Coaching: Guided help with everyday computer skills, settings, software tools, and productivity shortcuts</li>
        </ul>
    </div>
</div>
<p id="footnote">All of these rates and plans are subject to specific needs and negotiations, but will generally be close to the starting prices and rates specified above.</p>
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
