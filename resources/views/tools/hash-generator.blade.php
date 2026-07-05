@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">#️⃣</div>
        <div>
            <h1 class="tool-page-title">SHA Hash Generator</h1>
            <p class="tool-page-subtitle">Generate SHA-256, SHA-384, and SHA-512 hashes from any text using the Web Crypto API.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <label class="form-label">Input text</label>
        <textarea id="hash-input" class="tool-textarea" placeholder="Enter text to hash…"></textarea>
        <div class="tool-toolbar mt-3">
            <div class="tool-toolbar-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="hash-algo" id="hash-sha256" value="SHA-256" checked>
                    <label class="form-check-label" for="hash-sha256">SHA-256</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="hash-algo" id="hash-sha384" value="SHA-384">
                    <label class="form-check-label" for="hash-sha384">SHA-384</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="hash-algo" id="hash-sha512" value="SHA-512">
                    <label class="form-check-label" for="hash-sha512">SHA-512</label>
                </div>
            </div>
            <span class="tool-badge">🔒 Web Crypto API · Client-side</span>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <div class="hash-result-row">
            <label class="form-label">Hash output (hexadecimal)</label>
            <div class="tool-input-group">
                <input type="text" id="hash-output" class="tool-input hash-output-field" readonly placeholder="Hash will appear as you type…">
                <button class="btn btn-outline-secondary btn-sm tool-copy-btn" id="hash-copy" title="Copy hash">📋</button>
            </div>
            <div class="tool-stats mt-2" id="hash-stats"></div>
        </div>
    </div>

    @include('tools.content.hash-generator')
@endsection

@section('scripts')
<script>
(function() {
    const input = document.getElementById('hash-input');
    const output = document.getElementById('hash-output');
    const stats = document.getElementById('hash-stats');
    const algos = document.querySelectorAll('input[name="hash-algo"]');
    let debounceTimer;

    function bufToHex(buffer) {
        return Array.from(new Uint8Array(buffer))
            .map(b => b.toString(16).padStart(2, '0'))
            .join('');
    }

    async function hash() {
        const text = input.value;
        const algo = document.querySelector('input[name="hash-algo"]:checked').value;
        if (!text) { output.value = ''; stats.textContent = ''; return; }
        try {
            const encoded = new TextEncoder().encode(text);
            const digest = await crypto.subtle.digest(algo, encoded);
            output.value = bufToHex(digest);
            stats.textContent = `${algo} · ${output.value.length} hex chars · input ${text.length.toLocaleString()} chars (${encoded.byteLength.toLocaleString()} bytes)`;
        } catch (e) {
            output.value = '';
            stats.textContent = 'Error: ' + e.message;
        }
    }

    function debouncedHash() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(hash, 150);
    }

    input.addEventListener('input', debouncedHash);
    algos.forEach(r => r.addEventListener('change', hash));

    document.getElementById('hash-copy').addEventListener('click', async () => {
        if (!output.value) return;
        try { await navigator.clipboard.writeText(output.value); }
        catch { output.select(); document.execCommand('copy'); }
    });
})();
</script>
@endsection
