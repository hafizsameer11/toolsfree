@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🔗</div>
        <div>
            <h1 class="tool-page-title">URL Encoder / Decoder</h1>
            <p class="tool-page-subtitle">Encode and decode URLs, query strings, and URI components safely.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Input</h2>
                <textarea id="url-input" class="tool-textarea" placeholder="https://example.com/search?q=hello world&lang=en"></textarea>
                <div class="tool-toolbar mt-3">
                    <div class="tool-toolbar-group">
                        <select id="url-mode" class="form-select form-select-sm tool-select">
                            <option value="component">Encode component (encodeURIComponent)</option>
                            <option value="uri">Encode full URI (encodeURI)</option>
                            <option value="decode">Decode (decodeURIComponent)</option>
                        </select>
                    </div>
                </div>
                <div class="tool-toolbar mt-2">
                    <div class="tool-toolbar-group">
                        <button class="btn btn-primary btn-sm tool-btn" id="url-run">▶ Run</button>
                        <button class="btn btn-outline-secondary btn-sm tool-btn" id="url-swap">⇄ Swap</button>
                        <button class="btn btn-outline-secondary btn-sm tool-btn" id="url-clear">🗑 Clear</button>
                    </div>
                    <span class="tool-badge">🔒 Client-side only</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Result</h2>
                <textarea id="url-output" class="tool-textarea" readonly placeholder="Encoded or decoded result appears here…"></textarea>
                <div class="tool-toolbar mt-3">
                    <button class="btn btn-outline-secondary btn-sm tool-btn" id="url-copy">📋 Copy result</button>
                    <span id="url-status" class="tool-inline-status"></span>
                </div>
            </div>
        </div>
    </div>

    @include('tools.content.url-encoder')
@endsection

@section('scripts')
<script>
(function() {
    const input = document.getElementById('url-input');
    const output = document.getElementById('url-output');
    const mode = document.getElementById('url-mode');
    const status = document.getElementById('url-status');

    function run() {
        const text = input.value;
        if (!text) { output.value = ''; return; }
        try {
            switch (mode.value) {
                case 'component':
                    output.value = encodeURIComponent(text);
                    break;
                case 'uri':
                    output.value = encodeURI(text);
                    break;
                case 'decode':
                    output.value = decodeURIComponent(text);
                    break;
            }
            status.textContent = '✓ Done';
            setTimeout(() => status.textContent = '', 2000);
        } catch (e) {
            output.value = '';
            status.textContent = '✗ ' + e.message;
        }
    }

    document.getElementById('url-run').addEventListener('click', run);
    input.addEventListener('keydown', e => { if (e.ctrlKey && e.key === 'Enter') run(); });

    document.getElementById('url-swap').addEventListener('click', () => {
        const tmp = input.value;
        input.value = output.value;
        output.value = tmp;
    });

    document.getElementById('url-clear').addEventListener('click', () => {
        input.value = '';
        output.value = '';
        status.textContent = '';
    });

    document.getElementById('url-copy').addEventListener('click', async () => {
        if (!output.value) return;
        try {
            await navigator.clipboard.writeText(output.value);
            status.textContent = '✓ Copied';
        } catch {
            output.select();
            document.execCommand('copy');
            status.textContent = '✓ Copied';
        }
        setTimeout(() => status.textContent = '', 2000);
    });
})();
</script>
@endsection
