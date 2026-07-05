@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🔐</div>
        <div>
            <h1 class="tool-page-title">Random Password Generator</h1>
            <p class="tool-page-subtitle">Create cryptographically secure passwords with real-time strength analysis.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Length: <span id="pw-length-val">16</span></label>
                <input type="range" id="pw-length" class="form-range" value="16" min="8" max="64">
            </div>
            <div class="col-md-9">
                <label class="form-label">Character sets</label>
                <div class="d-flex flex-wrap gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-lower" checked>
                        <label class="form-check-label" for="pw-lower">Lowercase (a-z)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-upper" checked>
                        <label class="form-check-label" for="pw-upper">Uppercase (A-Z)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-digits" checked>
                        <label class="form-check-label" for="pw-digits">Digits (0-9)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-symbols">
                        <label class="form-check-label" for="pw-symbols">Symbols (!@#$…)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-pronounceable">
                        <label class="form-check-label" for="pw-pronounceable">Pronounceable</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="tool-toolbar mt-3">
            <button class="btn btn-primary tool-btn" id="pw-generate">🔄 Generate password</button>
            <button class="btn btn-outline-secondary btn-sm tool-btn" id="pw-copy">📋 Copy</button>
            <span class="tool-badge">🔒 Crypto-secure · Client-side only</span>
        </div>

        <div class="pw-output-wrap mt-3">
            <input type="text" id="pw-output" class="tool-input pw-output" readonly placeholder="Click Generate to create a password">
        </div>

        <div class="pw-strength-wrap mt-3">
            <div class="pw-strength-bar" id="pw-strength-bar"></div>
            <span id="pw-strength-label" class="pw-strength-label">Strength: —</span>
        </div>
        <div id="pw-entropy" class="tool-stats mt-1"></div>
    </div>

    @include('tools.content.password-generator')
@endsection

@section('scripts')
<script>
(function() {
    const CONSONANTS = 'bcdfghjklmnpqrstvwxyz';
    const VOWELS = 'aeiou';
    const SYMBOLS = '!@#$%^&*()-_=+';

    function secureRandom(max) {
        const arr = new Uint32Array(1);
        crypto.getRandomValues(arr);
        return arr[0] % max;
    }

    function secureRandomChar(chars) {
        return chars.charAt(secureRandom(chars.length));
    }

    function shuffle(str) {
        const a = str.split('');
        for (let i = a.length - 1; i > 0; i--) {
            const j = secureRandom(i + 1);
            [a[i], a[j]] = [a[j], a[i]];
        }
        return a.join('');
    }

    function generatePronounceable(length) {
        let pw = '';
        while (pw.length < length) {
            pw += secureRandomChar(CONSONANTS) + secureRandomChar(VOWELS);
            if (secureRandom(3) === 0) pw += secureRandomChar(CONSONANTS);
        }
        return pw.slice(0, length);
    }

    function generatePassword() {
        const length = parseInt(document.getElementById('pw-length').value, 10);
        const pronounceable = document.getElementById('pw-pronounceable').checked;

        if (pronounceable) return generatePronounceable(length);

        const sets = [];
        if (document.getElementById('pw-lower').checked) sets.push('abcdefghijklmnopqrstuvwxyz');
        if (document.getElementById('pw-upper').checked) sets.push('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        if (document.getElementById('pw-digits').checked) sets.push('0123456789');
        if (document.getElementById('pw-symbols').checked) sets.push(SYMBOLS);
        if (!sets.length) sets.push('abcdefghijklmnopqrstuvwxyz');

        const all = sets.join('');
        let pw = '';
        sets.forEach(s => { pw += secureRandomChar(s); });
        for (let i = pw.length; i < length; i++) {
            pw += secureRandomChar(all);
        }
        return shuffle(pw);
    }

    function measureStrength(pw) {
        if (!pw) return { score: 0, entropy: 0 };
        let charset = 0;
        if (/[a-z]/.test(pw)) charset += 26;
        if (/[A-Z]/.test(pw)) charset += 26;
        if (/\d/.test(pw)) charset += 10;
        if (/[^A-Za-z0-9]/.test(pw)) charset += 32;
        const entropy = Math.round(pw.length * Math.log2(charset || 26));
        let score = 0;
        if (pw.length >= 8) score++;
        if (pw.length >= 12) score++;
        if (pw.length >= 16) score++;
        if (/[a-z]/.test(pw) && /[A-Z]/.test(pw)) score++;
        if (/\d/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;
        return { score: Math.min(score, 5), entropy };
    }

    const labels = ['Very weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very strong'];
    const colors = ['#ef4444', '#f97316', '#eab308', '#84cc16', '#22c55e', '#10b981'];

    function updateUI(pw) {
        const output = document.getElementById('pw-output');
        const bar = document.getElementById('pw-strength-bar');
        const label = document.getElementById('pw-strength-label');
        const entropy = document.getElementById('pw-entropy');
        output.value = pw;
        const { score, entropy: bits } = measureStrength(pw);
        bar.style.width = ((score + 1) / 6 * 100) + '%';
        bar.style.background = colors[score];
        label.textContent = 'Strength: ' + labels[score];
        entropy.textContent = pw ? `Estimated entropy: ~${bits} bits` : '';
    }

    document.getElementById('pw-length').addEventListener('input', e => {
        document.getElementById('pw-length-val').textContent = e.target.value;
    });

    document.getElementById('pw-generate').addEventListener('click', () => updateUI(generatePassword()));

    document.getElementById('pw-copy').addEventListener('click', async () => {
        const output = document.getElementById('pw-output');
        if (!output.value) return;
        try {
            await navigator.clipboard.writeText(output.value);
        } catch {
            output.select();
            document.execCommand('copy');
        }
    });

    document.getElementById('pw-pronounceable').addEventListener('change', e => {
        ['pw-lower','pw-upper','pw-digits','pw-symbols'].forEach(id => {
            document.getElementById(id).disabled = e.target.checked;
        });
    });

    updateUI(generatePassword());
})();
</script>
@endsection
