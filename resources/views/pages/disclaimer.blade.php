@extends('layouts.app')

@section('content')
    @include('partials.legal-hero', [
        'title' => 'Disclaimer',
        'subtitle' => 'Important limitations regarding ToolsFree.org content and tools.',
        'updated' => date('F d, Y'),
    ])

    <section class="legal-section">
        <div class="card legal-card">
            <h2>General Information Only</h2>
            <p>The information and tools on ToolsFree.org are provided for general informational and productivity purposes only. While we strive for accuracy, we make no representations or warranties about the completeness, reliability, or suitability of any tool output or blog content.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>No Professional Advice</h2>
            <p>Content on this site does not constitute legal, financial, medical, security, or professional advice. Password generators, hash tools, and JWT decoders are utilities — not substitutes for professional security audits or compliance reviews. Always consult qualified professionals for critical decisions.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>Tool Output Accuracy</h2>
            <p>Our tools process data using standard algorithms and browser APIs. Results may contain rounding errors, edge-case failures, or differences from server-side implementations. Before using output in production systems — financial calculations, security configurations, legal documents, or medical data — independently verify all results.</p>
            <ul>
                <li>Unit conversions use standard constants but may not match every industry-specific standard</li>
                <li>JSON validation uses browser parsers; some edge cases may differ from strict RFC validators</li>
                <li>JWT decoding inspects tokens but does not verify cryptographic signatures</li>
                <li>Generated passwords are random but you are responsible for storing them securely</li>
            </ul>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>External Links</h2>
            <p>ToolsFree.org may link to third-party websites, including advertisers and documentation. We do not endorse and are not responsible for the content, privacy practices, or availability of external sites. Access third-party links at your own risk.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>Advertising Disclaimer</h2>
            <p>This site may display third-party advertisements (e.g., Google AdSense). We do not control ad content. The appearance of an ad does not constitute endorsement. Your dealings with advertisers are solely between you and the advertiser.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="card legal-card">
            <h2>Limitation of Liability</h2>
            <p>ToolsFree.org and its operators shall not be liable for any loss or damage arising from use of this site, including but not limited to data loss, security incidents, business interruption, or reliance on tool output. See our <a href="{{ route('terms') }}" class="tool-link">Terms of Service</a> for full details.</p>
        </div>
    </section>
@endsection
