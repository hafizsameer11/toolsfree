@extends('layouts.app')

@push('styles')
<style>
    #qr-canvas-wrap { display:flex; justify-content:center; align-items:center; min-height:280px; background:rgba(255,255,255,0.95); border-radius:12px; padding:1.5rem; }
    #qr-canvas-wrap canvas, #qr-canvas-wrap img { max-width:100%; }
</style>
@endpush

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">📱</div>
        <div>
            <h1 class="tool-page-title">QR Code Generator</h1>
            <p class="tool-page-subtitle">Create QR codes for URLs, text, WiFi, email, and phone — download as PNG instantly.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card tool-panel">
                <label class="form-label">Content type</label>
                <select id="qr-type" class="form-select tool-select mb-3">
                    <option value="url">URL / Website link</option>
                    <option value="text">Plain text</option>
                    <option value="wifi">WiFi network</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone number</option>
                </select>
                <div id="qr-fields-url">
                    <label class="form-label">URL</label>
                    <input type="url" id="qr-url" class="tool-input" placeholder="https://toolsfree.org" value="https://toolsfree.org">
                </div>
                <div id="qr-fields-text" class="d-none">
                    <label class="form-label">Text</label>
                    <textarea id="qr-text" class="tool-textarea" rows="3" placeholder="Enter any text…"></textarea>
                </div>
                <div id="qr-fields-wifi" class="d-none">
                    <label class="form-label">Network name (SSID)</label>
                    <input type="text" id="qr-wifi-ssid" class="tool-input mb-2">
                    <label class="form-label">Password</label>
                    <input type="text" id="qr-wifi-pass" class="tool-input mb-2">
                    <label class="form-label">Encryption</label>
                    <select id="qr-wifi-enc" class="form-select tool-select">
                        <option value="WPA">WPA/WPA2</option>
                        <option value="WEP">WEP</option>
                        <option value="nopass">None</option>
                    </select>
                </div>
                <div id="qr-fields-email" class="d-none">
                    <label class="form-label">Email</label>
                    <input type="email" id="qr-email" class="tool-input mb-2" placeholder="hello@example.com">
                    <label class="form-label">Subject (optional)</label>
                    <input type="text" id="qr-email-sub" class="tool-input">
                </div>
                <div id="qr-fields-phone" class="d-none">
                    <label class="form-label">Phone number</label>
                    <input type="tel" id="qr-phone" class="tool-input" placeholder="+1234567890">
                </div>
                <div class="row g-2 mt-3">
                    <div class="col-6">
                        <label class="form-label">Size (px)</label>
                        <input type="number" id="qr-size" class="tool-input" value="256" min="128" max="512" step="32">
                    </div>
                    <div class="col-6 d-flex align-items-end">
                        <button class="btn btn-primary tool-btn w-100" id="qr-generate">Generate QR Code</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card tool-panel h-100">
                <h2 class="tool-panel-title">Preview</h2>
                <div id="qr-canvas-wrap">
                    <p class="text-muted" id="qr-placeholder">QR code will appear here</p>
                </div>
                <div class="tool-toolbar mt-3">
                    <button class="btn btn-outline-secondary btn-sm tool-btn" id="qr-download" disabled>⬇ Download PNG</button>
                    <span class="tool-badge">🔒 Generated in browser</span>
                </div>
            </div>
        </div>
    </div>

    @include('tools.content.qr-code-generator')
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.4/build/qrcode.min.js"></script>
<script>
(function() {
    const typeEl = document.getElementById('qr-type');
    const wrap = document.getElementById('qr-canvas-wrap');
    const downloadBtn = document.getElementById('qr-download');
    let dataUrl = '';

    const fieldGroups = ['url','text','wifi','email','phone'];
    typeEl.addEventListener('change', () => {
        fieldGroups.forEach(g => {
            document.getElementById('qr-fields-' + g).classList.toggle('d-none', typeEl.value !== g);
        });
    });

    function getContent() {
        switch (typeEl.value) {
            case 'url': return document.getElementById('qr-url').value.trim() || 'https://toolsfree.org';
            case 'text': return document.getElementById('qr-text').value.trim() || 'Hello';
            case 'wifi': {
                const ssid = document.getElementById('qr-wifi-ssid').value;
                const pass = document.getElementById('qr-wifi-pass').value;
                const enc = document.getElementById('qr-wifi-enc').value;
                return `WIFI:T:${enc};S:${ssid};P:${pass};;`;
            }
            case 'email': {
                const e = document.getElementById('qr-email').value;
                const s = document.getElementById('qr-email-sub').value;
                return s ? `mailto:${e}?subject=${encodeURIComponent(s)}` : `mailto:${e}`;
            }
            case 'phone': return `tel:${document.getElementById('qr-phone').value}`;
        }
    }

    document.getElementById('qr-generate').addEventListener('click', () => {
        const size = parseInt(document.getElementById('qr-size').value, 10) || 256;
        const content = getContent();
        wrap.innerHTML = '';
        QRCode.toCanvas(content, { width: size, margin: 2, color: { dark: '#000000', light: '#ffffff' } }, (err, canvas) => {
            if (err) { wrap.innerHTML = '<p class="text-danger">Error generating QR code</p>'; return; }
            wrap.appendChild(canvas);
            dataUrl = canvas.toDataURL('image/png');
            downloadBtn.disabled = false;
        });
    });

    downloadBtn.addEventListener('click', () => {
        if (!dataUrl) return;
        const a = document.createElement('a');
        a.href = dataUrl;
        a.download = 'qrcode.png';
        a.click();
    });

    document.getElementById('qr-generate').click();
})();
</script>
@endsection
