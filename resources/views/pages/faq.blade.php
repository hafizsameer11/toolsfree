@extends('layouts.app')

@section('content')
    @include('partials.legal-hero', [
        'title' => 'Frequently Asked Questions',
        'subtitle' => 'Common questions about ToolsFree.org, our tools, privacy, and policies.',
    ])

    <section class="legal-section">
        <div class="card legal-card">
            <div class="tool-faq">
                <h2>About ToolsFree.org</h2>
                <details class="tool-faq-item" open>
                    <summary>What is ToolsFree.org?</summary>
                    <p>ToolsFree.org is a free collection of online developer and productivity tools — JSON formatter, URL encoder, word counter, QR code generator, and more. All tools run in your browser with no signup required.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Is ToolsFree.org really free?</summary>
                    <p>Yes. All tools are free with no premium tier, no usage limits, and no account required. The site is supported by non-intrusive advertising.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Do I need to create an account?</summary>
                    <p>No. Every tool works immediately without registration, email verification, or payment information.</p>
                </details>
            </div>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <div class="tool-faq">
                <h2>Privacy &amp; Security</h2>
                <details class="tool-faq-item">
                    <summary>Is my data stored when I use the tools?</summary>
                    <p>No. All tool processing happens in your browser using JavaScript. The text, JSON, URLs, and passwords you enter never leave your device and are never sent to our servers.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Can I use these tools with sensitive data?</summary>
                    <p>Because processing is client-side, our tools are safer than server-based alternatives for confidential data. However, always follow your organization's security policies. Never paste production secrets into untrusted websites if your policy prohibits it.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Do you use cookies?</summary>
                    <p>We use analytics and advertising cookies (Google Analytics, AdSense). We do not use cookies to track tool input. Read our <a href="{{ route('cookies') }}" class="tool-link">Cookie Policy</a> for details.</p>
                </details>
            </div>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <div class="tool-faq">
                <h2>Using the Tools</h2>
                <details class="tool-faq-item">
                    <summary>Do the tools work on mobile phones?</summary>
                    <p>Yes. ToolsFree.org is fully responsive and optimized for smartphones and tablets. Visit our <a href="{{ route('tools.index') }}" class="tool-link">All Tools</a> page to browse every tool on mobile.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Do the tools work offline?</summary>
                    <p>After the initial page load, most tools work offline since processing is client-side. You need internet only to load the page the first time.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Which browsers are supported?</summary>
                    <p>All modern browsers: Chrome, Firefox, Safari, Edge, and Opera. Tools require JavaScript enabled.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>Can I suggest a new tool?</summary>
                    <p>Absolutely. Visit our <a href="{{ route('contact') }}" class="tool-link">Contact</a> page and tell us what you need. Popular requests include regex testers, Markdown preview, and HTML encoders.</p>
                </details>
            </div>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <div class="tool-faq">
                <h2>Legal &amp; Policies</h2>
                <details class="tool-faq-item">
                    <summary>Where can I read your policies?</summary>
                    <p>We publish <a href="{{ route('privacy') }}" class="tool-link">Privacy Policy</a>, <a href="{{ route('terms') }}" class="tool-link">Terms of Service</a>, <a href="{{ route('cookies') }}" class="tool-link">Cookie Policy</a>, and <a href="{{ route('disclaimer') }}" class="tool-link">Disclaimer</a> pages for full legal details.</p>
                </details>
                <details class="tool-faq-item">
                    <summary>How do I contact you?</summary>
                    <p>Email us at <a href="mailto:contact@toolsfree.org" class="tool-link">contact@toolsfree.org</a> or use the form on our <a href="{{ route('contact') }}" class="tool-link">Contact</a> page.</p>
                </details>
            </div>
        </div>
    </section>
@endsection
