@extends('layouts.app')

@section('content')
    @include('partials.legal-hero', [
        'title' => 'Terms of Service',
        'subtitle' => 'Please read these terms carefully before using ToolsFree.org.',
        'updated' => date('F d, Y'),
    ])

    <section class="legal-section">
        <div class="card legal-card">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing or using ToolsFree.org ("the Site"), you agree to be bound by these Terms of Service. If you do not agree with any part of these terms, you must not use our website or services.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>2. Description of Service</h2>
            <p>ToolsFree.org provides free online utilities that run entirely in your browser, including:</p>
            <ul>
                <li>JSON Formatter &amp; Validator</li>
                <li>URL Encoder &amp; Decoder</li>
                <li>HEX / RGB / HSL Color Converter</li>
                <li>Universal Unit Converter</li>
                <li>Secure Password Generator</li>
                <li>Base64 Encoder &amp; Decoder</li>
                <li>Hash Generator (SHA-256, SHA-384, SHA-512)</li>
                <li>Text Case Converter</li>
                <li>Word Counter</li>
                <li>Unix Timestamp Converter</li>
                <li>UUID Generator</li>
                <li>JWT Decoder</li>
                <li>QR Code Generator</li>
            </ul>
            <p>We also publish informational blog content. These services are provided "as is" for general informational and productivity purposes. We reserve the right to modify, suspend, or discontinue any tool or feature at any time without notice.</p>
            <p>See our full <a href="{{ route('tools.index') }}" class="tool-link">All Tools</a> page for descriptions and links.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>3. Use of Tools</h2>
            <ul>
                <li>You may use our tools for lawful personal and commercial purposes.</li>
                <li>You must not use the Site to process illegal content or violate any applicable laws.</li>
                <li>You are responsible for any data you paste into our tools and how you use the output.</li>
                <li>Passwords and UUIDs are generated in your browser; we do not store them.</li>
                <li>We do not guarantee that tool output is error-free for production systems — always verify critical data.</li>
            </ul>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>4. Intellectual Property</h2>
            <p>All content on ToolsFree.org — including text, design, logos, and software — unless otherwise stated, is owned by ToolsFree.org or its licensors. You may not copy, redistribute, or create derivative works from our content without written permission, except for personal, non-commercial use with proper attribution.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>5. Disclaimer of Warranties</h2>
            <p>The Site and tools are provided without warranties of any kind, express or implied, including but not limited to merchantability, fitness for a particular purpose, or non-infringement. We do not warrant that the Site will be uninterrupted, secure, or free of errors. See our <a href="{{ route('disclaimer') }}" class="tool-link">Disclaimer</a> for additional limitations.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>6. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law, ToolsFree.org and its operators shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the Site, including loss of data, profits, or business opportunities, even if we have been advised of such damages.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>7. Third-Party Links and Advertising</h2>
            <p>The Site may contain links to third-party websites or display advertisements (e.g., Google AdSense). We are not responsible for the content or practices of third parties. Your interactions with advertisers are solely between you and the advertiser.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>8. Privacy and Cookies</h2>
            <p>Your use of the Site is also governed by our <a href="{{ route('privacy') }}" class="tool-link">Privacy Policy</a> and <a href="{{ route('cookies') }}" class="tool-link">Cookie Policy</a>, which explain how we handle data and cookies. Please review them alongside these terms.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>9. Changes to Terms</h2>
            <p>We may update these Terms of Service at any time. Continued use of the Site after changes are posted constitutes acceptance of the revised terms. We encourage you to review this page periodically.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card text-center">
            <h2>10. Contact</h2>
            <p>Questions about these terms? Visit our <a href="{{ route('contact') }}" class="tool-link">Contact</a> page or email <a href="mailto:contact@toolsfree.org" class="tool-link">contact@toolsfree.org</a>.</p>
            <a href="{{ route('home') }}" class="button-primary mt-3">Back to Home →</a>
        </div>
    </section>
@endsection
