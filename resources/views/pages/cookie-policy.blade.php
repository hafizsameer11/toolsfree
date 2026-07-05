@extends('layouts.app')

@section('content')
    @include('partials.legal-hero', [
        'title' => 'Cookie Policy',
        'subtitle' => 'How ToolsFree.org uses cookies and similar technologies.',
        'updated' => date('F d, Y'),
    ])

    <section class="legal-section">
        <div class="card legal-card">
            <h2>1. What Are Cookies?</h2>
            <p>Cookies are small text files stored on your device when you visit a website. They help sites remember preferences, understand how visitors use the site, and deliver relevant advertising. Similar technologies include local storage, session storage, and pixel tags.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>2. Cookies We Use</h2>
            <p>ToolsFree.org uses a minimal set of cookies and similar technologies:</p>
            <ul>
                <li><strong>Analytics cookies (Google Analytics):</strong> Help us understand page views, traffic sources, and general usage patterns. Data is aggregated and anonymous. We use this to improve content and fix issues.</li>
                <li><strong>Advertising cookies (Google AdSense):</strong> If you see ads on our site, Google may set cookies to show relevant ads and measure ad performance. See <a href="https://policies.google.com/technologies/ads" class="tool-link" target="_blank" rel="noopener">Google's advertising policy</a>.</li>
                <li><strong>Functional cookies:</strong> Laravel session cookies for admin areas only (not used by public tool pages).</li>
            </ul>
            <p><strong>Important:</strong> Our tools do not use cookies to store or track the data you paste into text fields. Tool processing is client-side only.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>3. Cookies We Do Not Use</h2>
            <ul>
                <li>No cookies to store JSON, passwords, URLs, or other tool input</li>
                <li>No cross-site tracking for behavioral profiling of tool usage</li>
                <li>No registration or login cookies on public pages</li>
                <li>No social media tracking pixels on tool pages</li>
            </ul>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>4. Managing Cookies</h2>
            <p>You can control cookies through your browser settings. Most browsers allow you to block or delete cookies. Note that blocking analytics cookies does not affect tool functionality. Blocking advertising cookies may result in less relevant ads.</p>
            <p>You can also opt out of personalized Google ads at <a href="https://adssettings.google.com" class="tool-link" target="_blank" rel="noopener">Google Ad Settings</a>.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>5. Third-Party Cookies</h2>
            <p>Third-party services (Google Analytics, Google AdSense) may set their own cookies when you visit our site. We do not control these cookies. Please review Google's privacy policy for details on how they use data.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>6. Updates and Contact</h2>
            <p>We may update this Cookie Policy periodically. Continued use of the site after changes constitutes acceptance. For questions, visit our <a href="{{ route('contact') }}" class="tool-link">Contact</a> page or read our <a href="{{ route('privacy') }}" class="tool-link">Privacy Policy</a>.</p>
        </div>
    </section>
@endsection
