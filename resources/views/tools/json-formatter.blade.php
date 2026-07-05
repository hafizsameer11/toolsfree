@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">📋</div>
        <div>
            <h1 class="tool-page-title">JSON Formatter &amp; Validator</h1>
            <p class="tool-page-subtitle">Beautify, minify, validate and copy JSON — everything runs in your browser.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <div class="tool-toolbar">
            <div class="tool-toolbar-group">
                <button class="btn btn-primary btn-sm tool-btn" id="json-beautify" title="Pretty-print with indentation">
                    ✨ Beautify
                </button>
                <button class="btn btn-outline-secondary btn-sm tool-btn" id="json-minify">📦 Minify</button>
                <button class="btn btn-outline-success btn-sm tool-btn" id="json-validate">✓ Validate</button>
                <button class="btn btn-outline-secondary btn-sm tool-btn" id="json-copy">📋 Copy</button>
                <button class="btn btn-outline-secondary btn-sm tool-btn" id="json-clear">🗑 Clear</button>
                <button class="btn btn-outline-secondary btn-sm tool-btn" id="json-sample">📄 Sample</button>
            </div>
            <span class="tool-badge">🔒 Client-side only</span>
        </div>
        <div class="tool-editor-wrap">
            <textarea id="json-input" class="tool-textarea tool-textarea-lg" spellcheck="false" placeholder='Paste JSON here, e.g. {"name": "ToolsFree", "version": 1}'></textarea>
        </div>
        <div id="json-status" class="tool-status tool-status-success d-none"></div>
        <div id="json-error" class="tool-status tool-status-error d-none"></div>
        <div class="tool-stats" id="json-stats"></div>
    </div>

    @include('tools.content.json-formatter')
@endsection

@section('scripts')
<script>
(function() {
    const input = document.getElementById('json-input');
    const status = document.getElementById('json-status');
    const error = document.getElementById('json-error');
    const stats = document.getElementById('json-stats');

    function setStatus(message, isError = false) {
        status.classList.add('d-none');
        error.classList.add('d-none');
        if (isError) {
            error.textContent = message;
            error.classList.remove('d-none');
        } else if (message) {
            status.textContent = message;
            status.classList.remove('d-none');
        }
        updateStats();
    }

    function updateStats() {
        const text = input.value.trim();
        if (!text) { stats.textContent = ''; return; }
        try {
            const parsed = JSON.parse(text);
            const keys = typeof parsed === 'object' && parsed ? Object.keys(parsed).length : 0;
            stats.textContent = `${text.length.toLocaleString()} chars · ${text.split('\n').length} lines · ${keys} top-level keys`;
        } catch {
            stats.textContent = `${text.length.toLocaleString()} chars · ${text.split('\n').length} lines · invalid JSON`;
        }
    }

    document.getElementById('json-beautify').addEventListener('click', () => {
        try {
            const parsed = JSON.parse(input.value);
            input.value = JSON.stringify(parsed, null, 2);
            setStatus('✓ JSON formatted successfully with 2-space indentation.');
        } catch (e) {
            setStatus('Error: ' + e.message, true);
        }
    });

    document.getElementById('json-minify').addEventListener('click', () => {
        try {
            const parsed = JSON.parse(input.value);
            input.value = JSON.stringify(parsed);
            setStatus('✓ JSON minified to a single line.');
        } catch (e) {
            setStatus('Error: ' + e.message, true);
        }
    });

    document.getElementById('json-validate').addEventListener('click', () => {
        try {
            JSON.parse(input.value);
            setStatus('✓ Valid JSON — no syntax errors found.');
        } catch (e) {
            setStatus('Invalid JSON: ' + e.message, true);
        }
    });

    document.getElementById('json-copy').addEventListener('click', async () => {
        if (!input.value) return;
        try {
            await navigator.clipboard.writeText(input.value);
            setStatus('✓ Copied to clipboard.');
        } catch {
            input.select();
            document.execCommand('copy');
            setStatus('✓ Copied to clipboard.');
        }
    });

    document.getElementById('json-clear').addEventListener('click', () => {
        input.value = '';
        setStatus('');
    });

    document.getElementById('json-sample').addEventListener('click', () => {
        input.value = JSON.stringify({
            site: "ToolsFree.org",
            tools: ["json", "url", "color", "unit", "password"],
            features: { clientSide: true, free: true, noSignup: true },
            stats: { users: 10000, uptime: "99.9%" }
        }, null, 2);
        setStatus('Sample JSON loaded.');
    });

    input.addEventListener('input', updateStats);
})();
</script>
@endsection
