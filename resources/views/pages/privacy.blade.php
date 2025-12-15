@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="card mb-5" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary);">
            Privacy Policy
        </h1>
        <p style="font-size: 1.15rem; color: var(--text-secondary); max-width: 700px; margin: 0 auto; line-height: 1.7;">
            Your privacy is our top priority. Learn how we protect your data and respect your privacy.
        </p>
        <p style="font-size: 0.9rem; color: var(--text-light); margin-top: 1rem;">
            Last Updated: {{ date('F d, Y') }}
        </p>
    </div>

    {{-- Introduction --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🔒 Our Commitment to Your Privacy
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                At ToolsFree.org, we take your privacy seriously. This Privacy Policy explains how we collect, 
                use, and protect your information when you use our website and online tools. We are committed 
                to transparency and giving you control over your personal data.
            </p>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                <strong>The short version:</strong> We don't store, log, or transmit any data you process through 
                our tools. All operations happen entirely in your browser. We only collect minimal, anonymous 
                analytics data to improve our service.
            </p>
        </div>
    </section>

    {{-- Data We Don't Collect --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                ✅ Data We DON'T Collect or Store
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                This is the most important part of our privacy policy. Here's what we explicitly do NOT collect:
            </p>
            
            <div style="background: rgba(34, 197, 94, 0.05); border-left: 4px solid #22c55e; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700; color: #22c55e;">
                    ✓ Your Tool Data
                </h3>
                <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem; margin: 0;">
                    <li>JSON data you format, validate, or minify</li>
                    <li>URLs you encode or decode</li>
                    <li>Color codes you convert</li>
                    <li>Unit conversion values</li>
                    <li>Passwords you generate</li>
                    <li>Any other data you process through our tools</li>
                </ul>
                <p style="font-size: 0.95rem; color: var(--text-secondary); margin: 1rem 0 0 0; font-weight: 600;">
                    All tool operations happen 100% client-side in your browser using JavaScript. Your data 
                    never leaves your device and is never transmitted to our servers.
                </p>
            </div>

            <div style="background: rgba(34, 197, 94, 0.05); border-left: 4px solid #22c55e; padding: 1.5rem; border-radius: 8px;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700; color: #22c55e;">
                    ✓ Personal Information
                </h3>
                <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem; margin: 0;">
                    <li>We don't require registration or account creation</li>
                    <li>We don't collect names, email addresses, or phone numbers</li>
                    <li>We don't track individual users across sessions</li>
                    <li>We don't create user profiles or behavioral tracking</li>
                    <li>We don't use fingerprinting or tracking pixels</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Data We Do Collect --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                📊 Data We DO Collect (Anonymous Analytics Only)
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                To improve our service and understand how people use ToolsFree.org, we collect minimal, 
                anonymous analytics data:
            </p>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    📈 Usage Statistics
                </h3>
                <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                    <li>Pages visited (e.g., JSON formatter, URL encoder)</li>
                    <li>Time spent on pages (aggregated, not individual)</li>
                    <li>Browser type and version (e.g., Chrome 120, Firefox 121)</li>
                    <li>Device type (desktop, tablet, mobile)</li>
                    <li>Screen resolution (to optimize responsive design)</li>
                    <li>Referring website (where you came from)</li>
                    <li>Country/region (based on IP address, not stored)</li>
                </ul>
            </div>

            <div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    🍪 Cookies
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 0;">
                    We use minimal, essential cookies for basic functionality and anonymous analytics. These 
                    cookies do not contain personal information and cannot be used to identify you. You can 
                    disable cookies in your browser settings, though this may affect some functionality.
                </p>
            </div>
        </div>
    </section>

    {{-- How We Use Data --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🎯 How We Use Collected Data
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                The minimal anonymous data we collect is used solely to:
            </p>
            <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                <li><strong>Improve our tools:</strong> Understand which tools are most popular and need enhancement</li>
                <li><strong>Optimize performance:</strong> Identify slow pages and technical issues</li>
                <li><strong>Enhance user experience:</strong> Make design decisions based on device usage patterns</li>
                <li><strong>Fix bugs:</strong> Detect and resolve technical problems</li>
                <li><strong>Plan new features:</strong> Decide which new tools to build based on user needs</li>
            </ul>
            <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; margin-top: 1rem; font-weight: 600;">
                We NEVER sell, rent, or share your data with third parties for marketing purposes.
            </p>
        </div>
    </section>

    {{-- Third-Party Services --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🔗 Third-Party Services
            </h2>
            
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Analytics
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8;">
                    We may use privacy-focused analytics services (such as Google Analytics with IP anonymization 
                    or privacy-friendly alternatives like Plausible) to collect anonymous usage statistics. These 
                    services are configured to respect user privacy and comply with GDPR and other privacy regulations.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Advertising
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8;">
                    We may display privacy-friendly advertisements through services like Google AdSense. These 
                    services may use cookies to show relevant ads. You can opt out of personalized advertising 
                    through your Google Ad Settings or by using browser extensions that block ads.
                </p>
            </div>

            <div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Content Delivery
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 0;">
                    We use CDN services (like Cloudflare or similar) to deliver fonts and improve website 
                    performance. These services may collect technical data like IP addresses for security and 
                    performance purposes, but this data is not shared with us.
                </p>
            </div>
        </div>
    </section>

    {{-- Data Security --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🛡️ Data Security
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                We implement industry-standard security measures to protect our website and your privacy:
            </p>
            <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                <li><strong>HTTPS Encryption:</strong> All connections to ToolsFree.org are encrypted using SSL/TLS</li>
                <li><strong>Client-Side Processing:</strong> Your tool data never leaves your browser</li>
                <li><strong>No Data Storage:</strong> We don't store tool data, so there's nothing to breach</li>
                <li><strong>Regular Updates:</strong> We keep our software and dependencies up to date</li>
                <li><strong>Security Headers:</strong> We implement Content Security Policy and other security headers</li>
            </ul>
        </div>
    </section>

    {{-- Your Rights --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                ⚖️ Your Privacy Rights
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                You have the following rights regarding your privacy:
            </p>
            <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                <li><strong>Right to Access:</strong> Request information about any data we may have (though we collect minimal data)</li>
                <li><strong>Right to Deletion:</strong> Request deletion of any data we may have collected</li>
                <li><strong>Right to Opt-Out:</strong> Disable cookies and analytics through browser settings</li>
                <li><strong>Right to Object:</strong> Object to data processing for specific purposes</li>
                <li><strong>Right to Portability:</strong> Request your data in a portable format (if applicable)</li>
            </ul>
            <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; margin-top: 1rem;">
                Since we don't collect personal information or store tool data, most privacy concerns are 
                automatically addressed by our architecture. However, if you have any privacy-related questions 
                or requests, please contact us.
            </p>
        </div>
    </section>

    {{-- Children's Privacy --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                👶 Children's Privacy
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                ToolsFree.org is a general-audience website suitable for all ages. We do not knowingly collect 
                personal information from children under 13. Since we don't require registration and don't 
                collect personal information, our service can be safely used by students and young developers 
                learning to code.
            </p>
        </div>
    </section>

    {{-- International Users --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🌍 International Users & GDPR Compliance
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                ToolsFree.org is accessible worldwide and complies with major privacy regulations including:
            </p>
            <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                <li><strong>GDPR</strong> (European Union General Data Protection Regulation)</li>
                <li><strong>CCPA</strong> (California Consumer Privacy Act)</li>
                <li><strong>PIPEDA</strong> (Canadian Personal Information Protection and Electronic Documents Act)</li>
            </ul>
            <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; margin-top: 1rem;">
                Our client-side processing architecture and minimal data collection make compliance straightforward. 
                Users from all regions can use our tools with confidence that their privacy is protected.
            </p>
        </div>
    </section>

    {{-- Changes to Policy --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                📝 Changes to This Privacy Policy
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                We may update this Privacy Policy from time to time to reflect changes in our practices or for 
                legal reasons. When we make significant changes, we will update the "Last Updated" date at the 
                top of this page. We encourage you to review this policy periodically. Continued use of 
                ToolsFree.org after changes constitutes acceptance of the updated policy.
            </p>
        </div>
    </section>

    {{-- Contact --}}
    <section class="mb-5">
        <div class="card" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
            <h2 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                📧 Questions About Privacy?
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); margin-bottom: 1.5rem; max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.7;">
                If you have any questions about this Privacy Policy or how we handle your data, please don't 
                hesitate to reach out. We're committed to transparency and protecting your privacy.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('about') }}" class="button-primary">
                    Learn More About Us →
                </a>
                <a href="{{ route('home') }}" class="button-secondary" style="color: var(--text-primary); border-color: rgba(102, 126, 234, 0.5);">
                    Start Using Tools →
                </a>
            </div>
        </div>
    </section>
@endsection
