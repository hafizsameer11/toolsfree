@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🕐</div>
        <div>
            <h1 class="tool-page-title">Unix Timestamp Converter</h1>
            <p class="tool-page-subtitle">Convert between Unix epoch timestamps and human-readable dates instantly.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Unix Timestamp → Date</h2>
                <label class="form-label">Timestamp</label>
                <input type="text" id="ts-input" class="tool-input mb-2" placeholder="e.g. 1700000000 or 1700000000000">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="ts-ms" checked>
                    <label class="form-check-label" for="ts-ms">Milliseconds (13 digits)</label>
                </div>
                <button class="btn btn-primary btn-sm tool-btn" id="ts-now">Use current time</button>
                <div class="mt-3">
                    <label class="form-label">Local time</label>
                    <input type="text" id="ts-local" class="tool-input" readonly>
                </div>
                <div class="mt-2">
                    <label class="form-label">UTC</label>
                    <input type="text" id="ts-utc" class="tool-input" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Date → Unix Timestamp</h2>
                <label class="form-label">Date &amp; time</label>
                <input type="datetime-local" id="dt-input" class="tool-input mb-3">
                <button class="btn btn-primary btn-sm tool-btn mb-3" id="dt-convert">Convert to timestamp</button>
                <label class="form-label">Seconds</label>
                <div class="tool-input-group mb-2">
                    <input type="text" id="dt-seconds" class="tool-input" readonly>
                    <button class="btn btn-outline-secondary btn-sm tool-copy-btn" data-copy="dt-seconds">📋</button>
                </div>
                <label class="form-label">Milliseconds</label>
                <div class="tool-input-group">
                    <input type="text" id="dt-millis" class="tool-input" readonly>
                    <button class="btn btn-outline-secondary btn-sm tool-copy-btn" data-copy="dt-millis">📋</button>
                </div>
            </div>
        </div>
    </div>

    @include('tools.content.timestamp-converter')
@endsection

@section('scripts')
<script>
(function() {
    function tsToDate() {
        let v = document.getElementById('ts-input').value.trim();
        if (!v) return;
        let n = parseInt(v, 10);
        if (document.getElementById('ts-ms').checked && v.length <= 10) n *= 1000;
        if (!document.getElementById('ts-ms').checked && v.length > 10) n = Math.floor(n / 1000);
        const d = new Date(n);
        if (isNaN(d)) return;
        document.getElementById('ts-local').value = d.toLocaleString();
        document.getElementById('ts-utc').value = d.toUTCString();
    }

    function dateToTs() {
        const v = document.getElementById('dt-input').value;
        if (!v) return;
        const d = new Date(v);
        const ms = d.getTime();
        document.getElementById('dt-seconds').value = Math.floor(ms / 1000);
        document.getElementById('dt-millis').value = ms;
    }

    document.getElementById('ts-input').addEventListener('input', tsToDate);
    document.getElementById('ts-ms').addEventListener('change', tsToDate);
    document.getElementById('ts-now').addEventListener('click', () => {
        const ms = Date.now();
        document.getElementById('ts-ms').checked = true;
        document.getElementById('ts-input').value = ms;
        tsToDate();
    });
    document.getElementById('dt-convert').addEventListener('click', dateToTs);
    document.getElementById('dt-input').addEventListener('change', dateToTs);

    document.querySelectorAll('.tool-copy-btn[data-copy]').forEach(btn => {
        btn.addEventListener('click', async () => {
            const el = document.getElementById(btn.dataset.copy);
            if (!el || !el.value) return;
            try { await navigator.clipboard.writeText(el.value); } catch { el.select(); document.execCommand('copy'); }
        });
    });

    document.getElementById('ts-now').click();
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('dt-input').value = now.toISOString().slice(0, 16);
    dateToTs();
})();
</script>
@endsection
