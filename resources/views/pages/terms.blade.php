@extends('layouts.app')

@section('content')
    <div class="card mb-5" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: #ffffff !important;">
            Terms and Conditions
        </h1>
        <p style="font-size: 1.15rem; color: var(--text-secondary); max-width: 700px; margin: 0 auto; line-height: 1.7;">
            Please read these terms carefully before using ToolsFree.org.
        </p>
        <p style="font-size: 0.9rem; color: var(--text-light); margin-top: 1rem;">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">1. Acceptance of Terms</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                By accessing or using ToolsFree.org ("the Site"), you agree to be bound by these Terms and Conditions.
                If you do not agree with any part of these terms, you must not use our website or services.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">2. Description of Service</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                ToolsFree.org provides free online utilities including JSON formatting, URL encoding/decoding,
                color conversion, unit conversion, password generation, and informational blog content.
                These tools are provided "as is" for general informational and productivity purposes.
            </p>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                We reserve the right to modify, suspend, or discontinue any tool or feature at any time without notice.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">3. Use of Tools</h2>
            <ul style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                <li>You may use our tools for lawful personal and commercial purposes.</li>
                <li>You must not use the Site to process illegal content or violate any applicable laws.</li>
                <li>You are responsible for any data you paste into our tools and how you use the output.</li>
                <li>Passwords generated on the Site are created in your browser; we do not store them.</li>
                <li>We do not guarantee that tool output is error-free for production systems—always verify critical data.</li>
            </ul>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">4. Intellectual Property</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                All content on ToolsFree.org—including text, design, logos, and software—unless otherwise stated,
                is owned by ToolsFree.org or its licensors. You may not copy, redistribute, or create derivative
                works from our content without written permission, except for personal, non-commercial use with
                proper attribution.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">5. Disclaimer of Warranties</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                The Site and tools are provided without warranties of any kind, express or implied, including but not
                limited to merchantability, fitness for a particular purpose, or non-infringement. We do not warrant
                that the Site will be uninterrupted, secure, or free of errors.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">6. Limitation of Liability</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                To the fullest extent permitted by law, ToolsFree.org and its operators shall not be liable for any
                indirect, incidental, special, consequential, or punitive damages arising from your use of the Site,
                including loss of data, profits, or business opportunities, even if we have been advised of such damages.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">7. Third-Party Links and Advertising</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                The Site may contain links to third-party websites or display advertisements (e.g., Google AdSense).
                We are not responsible for the content or practices of third parties. Your interactions with advertisers
                are solely between you and the advertiser.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">8. Privacy</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                Your use of the Site is also governed by our
                <a href="{{ route('privacy') }}" class="tool-link">Privacy Policy</a>, which explains how we handle
                data and cookies. Please review it alongside these terms.
            </p>
        </div>
    </section>

    <section class="mb-4">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">9. Changes to Terms</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                We may update these Terms and Conditions at any time. Continued use of the Site after changes are posted
                constitutes acceptance of the revised terms. We encourage you to review this page periodically.
            </p>
        </div>
    </section>

    <section class="mb-5">
        <div class="card" style="text-align: center;">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff !important;">10. Contact</h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1.5rem;">
                Questions about these terms? Visit our <a href="{{ route('about') }}" class="tool-link">About</a> page
                or continue using our free tools on the homepage.
            </p>
            <a href="{{ route('home') }}" class="button-primary">Back to Home →</a>
        </div>
    </section>
@endsection
