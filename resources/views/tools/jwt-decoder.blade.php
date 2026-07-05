@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🎫</div>
        <div>
            <h1 class="tool-page-title">JWT Decoder</h1>
            <p class="tool-page-subtitle">Decode JSON Web Token headers and payloads — inspect claims and expiration locally.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <label class="form-label">Paste JWT token</label>
        <textarea id="jwt-input" class="tool-textarea" rows="4" placeholder="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIn0.signature"></textarea>
        <div class="tool-toolbar mt-2">
            <button class="btn btn-primary btn-sm tool-btn" id="jwt-decode">▶ Decode</button>
            <button class="btn btn-outline-secondary btn-sm tool-btn" id="jwt-clear">🗑 Clear</button>
            <span class="tool-badge">🔒 Client-side only · No signature verification</span>
        </div>
        <div id="jwt-error" class="tool-status tool-status-error d-none mt-3"></div>
    </div>

    <div class="row g-4 mb-4" id="jwt-results" style="display:none;">
        <div class="col-md-6">
            <div class="card tool-panel">
                <h2 class="tool-panel-title">Header</h2>
                <pre id="jwt-header" class="jwt-pre"></pre>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card tool-panel">
                <h2 class="tool-panel-title">Payload</h2>
                <pre id="jwt-payload" class="jwt-pre"></pre>
            </div>
        </div>
        <div class="col-12">
            <div class="card tool-panel" id="jwt-meta-box">
                <h2 class="tool-panel-title">Token info</h2>
                <div id="jwt-meta" class="jwt-meta"></div>
            </div>
        </div>
    </div>

    @include('tools.content.jwt-decoder')
@endsection

@section('scripts')
<script>
(function() {
    function b64urlDecode(str) {
        str = str.replace(/-/g, '+').replace(/_/g, '/');
        while (str.length % 4) str += '=';
        const binary = atob(str);
        const bytes = Uint8Array.from(binary, c => c.charCodeAt(0));
        return new TextDecoder().decode(bytes);
    }

    function decode() {
        const token = document.getElementById('jwt-input').value.trim();
        const err = document.getElementById('jwt-error');
        const results = document.getElementById('jwt-results');
        err.classList.add('d-none');
        if (!token) { results.style.display = 'none'; return; }
        const parts = token.split('.');
        if (parts.length !== 3) {
            err.textContent = 'Invalid JWT: expected 3 parts separated by dots (header.payload.signature).';
            err.classList.remove('d-none');
            results.style.display = 'none';
            return;
        }
        try {
            const header = JSON.parse(b64urlDecode(parts[0]));
            const payload = JSON.parse(b64urlDecode(parts[1]));
            document.getElementById('jwt-header').textContent = JSON.stringify(header, null, 2);
            document.getElementById('jwt-payload').textContent = JSON.stringify(payload, null, 2);
            let meta = '';
            if (payload.exp) {
                const exp = new Date(payload.exp * 1000);
                const expired = Date.now() > payload.exp * 1000;
                meta += `<p><strong>Expires (exp):</strong> ${exp.toLocaleString()} ${expired ? '<span class="text-danger">— EXPIRED</span>' : '<span class="text-success">— valid</span>'}</p>`;
            }
            if (payload.iat) meta += `<p><strong>Issued at (iat):</strong> ${new Date(payload.iat * 1000).toLocaleString()}</p>`;
            if (payload.nbf) meta += `<p><strong>Not before (nbf):</strong> ${new Date(payload.nbf * 1000).toLocaleString()}</p>`;
            if (payload.sub) meta += `<p><strong>Subject (sub):</strong> ${payload.sub}</p>`;
            if (payload.iss) meta += `<p><strong>Issuer (iss):</strong> ${payload.iss}</p>`;
            if (payload.aud) meta += `<p><strong>Audience (aud):</strong> ${Array.isArray(payload.aud) ? payload.aud.join(', ') : payload.aud}</p>`;
            document.getElementById('jwt-meta').innerHTML = meta || '<p>No standard time claims found.</p>';
            results.style.display = '';
        } catch (e) {
            err.textContent = 'Decode error: ' + e.message;
            err.classList.remove('d-none');
            results.style.display = 'none';
        }
    }

    document.getElementById('jwt-decode').addEventListener('click', decode);
    document.getElementById('jwt-input').addEventListener('input', decode);
    document.getElementById('jwt-clear').addEventListener('click', () => {
        document.getElementById('jwt-input').value = '';
        document.getElementById('jwt-results').style.display = 'none';
        document.getElementById('jwt-error').classList.add('d-none');
    });
})();
</script>
@endsection
