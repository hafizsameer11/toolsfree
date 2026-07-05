@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🆔</div>
        <div>
            <h1 class="tool-page-title">UUID Generator (v4)</h1>
            <p class="tool-page-subtitle">Generate cryptographically random UUIDs / GUIDs — single or bulk, instantly.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Quantity (1–100)</label>
                <input type="number" id="uuid-qty" class="tool-input" value="1" min="1" max="100">
            </div>
            <div class="col-md-3">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="uuid-upper">
                    <label class="form-check-label" for="uuid-upper">Uppercase</label>
                </div>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary tool-btn" id="uuid-generate">🔄 Generate UUIDs</button>
                <button class="btn btn-outline-secondary btn-sm tool-btn" id="uuid-copy">📋 Copy all</button>
            </div>
        </div>
        <textarea id="uuid-output" class="tool-textarea mt-3" readonly rows="6" placeholder="Generated UUIDs appear here…"></textarea>
        <span class="tool-badge mt-2 d-inline-block">🔒 crypto.randomUUID() · Client-side</span>
    </div>

    @include('tools.content.uuid-generator')
@endsection

@section('scripts')
<script>
(function() {
    const output = document.getElementById('uuid-output');
    function generate() {
        const qty = Math.min(100, Math.max(1, parseInt(document.getElementById('uuid-qty').value, 10) || 1));
        const upper = document.getElementById('uuid-upper').checked;
        const ids = [];
        for (let i = 0; i < qty; i++) {
            let id = crypto.randomUUID();
            if (upper) id = id.toUpperCase();
            ids.push(id);
        }
        output.value = ids.join('\n');
    }
    document.getElementById('uuid-generate').addEventListener('click', generate);
    document.getElementById('uuid-copy').addEventListener('click', async () => {
        if (!output.value) return;
        try { await navigator.clipboard.writeText(output.value); } catch { output.select(); document.execCommand('copy'); }
    });
    generate();
})();
</script>
@endsection
