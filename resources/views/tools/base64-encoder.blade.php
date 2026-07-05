@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🔤</div>
        <div>
            <h1 class="tool-page-title">Base64 Encoder &amp; Decoder</h1>
            <p class="tool-page-subtitle">Encode and decode Base64 text, UTF-8 strings, and small files — entirely in your browser.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Input</h2>
                <textarea id="b64-input" class="tool-textarea" placeholder="Enter plain text or paste a Base64 string…"></textarea>
                <div class="tool-toolbar mt-3">
                    <div class="tool-toolbar-group">
                        <select id="b64-mode" class="form-select form-select-sm tool-select">
                            <option value="encode">Encode to Base64</option>
                            <option value="decode">Decode from Base64</option>
                        </select>
                        <div class="form-check ms-2">
                            <input class="form-check-input" type="checkbox" id="b64-urlsafe">
                            <label class="form-check-label" for="b64-urlsafe">URL-safe</label>
                        </div>
                    </div>
                </div>
                <div class="tool-toolbar mt-2">
                    <div class="tool-toolbar-group">
                        <button class="btn btn-primary btn-sm tool-btn" id="b64-run">▶ Convert</button>
                        <button class="btn btn-outline-secondary btn-sm tool-btn" id="b64-swap">⇄ Swap</button>
                        <button class="btn btn-outline-secondary btn-sm tool-btn" id="b64-clear">🗑 Clear</button>
                        <label class="btn btn-outline-secondary btn-sm tool-btn mb-0" for="b64-file">📁 Encode file</label>
                        <input type="file" id="b64-file" class="d-none">
                    </div>
                    <span class="tool-badge">🔒 Client-side only</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Result</h2>
                <textarea id="b64-output" class="tool-textarea" readonly placeholder="Result appears here…"></textarea>
                <div class="tool-toolbar mt-3">
                    <button class="btn btn-outline-secondary btn-sm tool-btn" id="b64-copy">📋 Copy result</button>
                    <span id="b64-status" class="tool-inline-status"></span>
                </div>
                <div class="tool-stats" id="b64-stats"></div>
            </div>
        </div>
    </div>

    @include('tools.content.base64-encoder')
@endsection

@section('scripts')
<script>
(function() {
    const input = document.getElementById('b64-input');
    const output = document.getElementById('b64-output');
    const mode = document.getElementById('b64-mode');
    const urlSafe = document.getElementById('b64-urlsafe');
    const status = document.getElementById('b64-status');
    const stats = document.getElementById('b64-stats');

    function toUrlSafe(b64) {
        return b64.replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
    }

    function fromUrlSafe(b64) {
        b64 = b64.replace(/-/g, '+').replace(/_/g, '/');
        while (b64.length % 4) b64 += '=';
        return b64;
    }

    function encodeText(text) {
        const bytes = new TextEncoder().encode(text);
        let binary = '';
        bytes.forEach(b => binary += String.fromCharCode(b));
        let b64 = btoa(binary);
        return urlSafe.checked ? toUrlSafe(b64) : b64;
    }

    function decodeText(text) {
        let b64 = urlSafe.checked ? fromUrlSafe(text.trim()) : text.trim();
        const binary = atob(b64);
        const bytes = Uint8Array.from(binary, c => c.charCodeAt(0));
        return new TextDecoder().decode(bytes);
    }

    function run() {
        const text = input.value;
        if (!text && mode.value !== 'decode') { output.value = ''; stats.textContent = ''; return; }
        try {
            if (mode.value === 'encode') {
                output.value = encodeText(text);
                status.textContent = '✓ Encoded';
            } else {
                output.value = decodeText(text);
                status.textContent = '✓ Decoded';
            }
            stats.textContent = `Input: ${text.length.toLocaleString()} chars → Output: ${output.value.length.toLocaleString()} chars`;
            setTimeout(() => status.textContent = '', 2000);
        } catch (e) {
            output.value = '';
            status.textContent = '✗ ' + (e.message || 'Invalid Base64 input');
            stats.textContent = '';
        }
    }

    document.getElementById('b64-run').addEventListener('click', run);
    input.addEventListener('keydown', e => { if (e.ctrlKey && e.key === 'Enter') run(); });

    document.getElementById('b64-swap').addEventListener('click', () => {
        const tmp = input.value;
        input.value = output.value;
        output.value = tmp;
        mode.value = mode.value === 'encode' ? 'decode' : 'encode';
    });

    document.getElementById('b64-clear').addEventListener('click', () => {
        input.value = output.value = '';
        status.textContent = stats.textContent = '';
    });

    document.getElementById('b64-copy').addEventListener('click', async () => {
        if (!output.value) return;
        try { await navigator.clipboard.writeText(output.value); status.textContent = '✓ Copied'; }
        catch { output.select(); document.execCommand('copy'); status.textContent = '✓ Copied'; }
        setTimeout(() => status.textContent = '', 2000);
    });

    document.getElementById('b64-file').addEventListener('change', e => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = () => {
            const dataUrl = reader.result;
            const b64 = dataUrl.split(',')[1] || '';
            input.value = `[File: ${file.name}, ${(file.size / 1024).toFixed(1)} KB]`;
            output.value = urlSafe.checked ? toUrlSafe(b64) : b64;
            mode.value = 'encode';
            stats.textContent = `Encoded ${file.name} (${file.size.toLocaleString()} bytes)`;
            status.textContent = '✓ File encoded';
        };
        reader.readAsDataURL(file);
        e.target.value = '';
    });
})();
</script>
@endsection
