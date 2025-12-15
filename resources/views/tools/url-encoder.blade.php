@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2">URL Encoder / Decoder</h1>
        <p class="text-muted">
            Convert plain text or URLs to percent-encoded form and decode them back. Great for query strings and redirects.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <h2 style="font-size: 1rem; margin-bottom: 0.5rem;">Input</h2>
                <textarea id="url-input" class="tool-textarea" placeholder="https://example.com?q=hello world"></textarea>
                <div class="tool-actions">
                    <button class="btn btn-primary btn-sm" id="url-encode">Encode</button>
                    <button class="btn btn-outline-secondary btn-sm" id="url-decode">Decode</button>
                    <button class="btn btn-outline-secondary btn-sm" id="url-copy">Copy result</button>
                    <span class="chip">Client-side only</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <h2 style="font-size: 1rem; margin-bottom: 0.5rem;">Result</h2>
                <textarea id="url-output" class="tool-textarea" readonly></textarea>
            </div>
        </div>
    </div>
    <section class="mt-4">
        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem;">Why use a URL encoder and decoder?</h2>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            The <strong>URL encoder</strong> converts unsafe characters such as spaces, ampersands and question marks into a
            safe, percent‑encoded format that browsers and servers understand. Use it when you build <strong>UTM tracking
            links</strong>, sign OAuth redirect URIs or include user‑generated text in a query string. The <strong>URL decoder</strong>
            reverses the process so you can quickly read and debug existing encoded URLs.
        </p>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            This simple <strong>online URL encoder / decoder</strong> runs entirely in your browser and does not log the links
            you paste into the text area. You can keep the tool open while working on marketing campaigns, webhook endpoints
            or API clients and copy the encoded result directly into your code, email or analytics platform.
        </p>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem;">Typical use‑cases</h3>
                <ul style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9); padding-left: 1.1rem;">
                    <li>Create campaign URLs with <code>utm_source</code> and <code>utm_medium</code> parameters.</li>
                    <li>Encode callback URLs when integrating OAuth or SSO providers.</li>
                    <li>Debug 400‑errors caused by malformed query strings in APIs.</li>
                    <li>Clean up links before sharing them in email newsletters or chat apps.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem;">Best practices for encoded URLs</h3>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
                    When you generate links for users, always encode dynamic parts such as search terms or IDs.
                    This prevents broken URLs and protects against accidental injection of reserved characters.
                    With this encoder you can visually confirm that the encoded version still represents the
                    original text before shipping it to production.
                </p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    const input = document.getElementById('url-input');
    const output = document.getElementById('url-output');

    document.getElementById('url-encode').addEventListener('click', () => {
        output.value = encodeURIComponent(input.value);
    });

    document.getElementById('url-decode').addEventListener('click', () => {
        try {
            output.value = decodeURIComponent(input.value || output.value);
        } catch (e) {
            output.value = 'Invalid encoded URL string.';
        }
    });

    document.getElementById('url-copy').addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(output.value);
        } catch (e) {
            // ignore
        }
    });
</script>
@endsection


