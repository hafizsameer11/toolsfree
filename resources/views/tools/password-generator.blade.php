@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2">Random Password Generator &amp; Strength Tester</h1>
        <p class="text-muted">
            Generate strong passwords with custom length and character sets, then copy them with a single click.
        </p>
    </div>

    <div class="card mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Length</label>
                <input type="number" id="pw-length" class="tool-input" value="16" min="6" max="64">
            </div>
            <div class="col-md-6">
                <label class="form-label">Character set</label>
                <div class="d-flex flex-wrap gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-lower" checked>
                        <label class="form-check-label" for="pw-lower">Lowercase</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-upper" checked>
                        <label class="form-check-label" for="pw-upper">Uppercase</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-digits" checked>
                        <label class="form-check-label" for="pw-digits">Digits</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pw-symbols">
                        <label class="form-check-label" for="pw-symbols">Symbols</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-grid">
                <button class="btn btn-primary" id="pw-generate">Generate password</button>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Password</label>
            <input type="text" id="pw-output" class="tool-input" readonly>
            <div class="d-flex align-items-center gap-2 mt-2">
                <button class="btn btn-outline-secondary btn-sm" id="pw-copy">Copy</button>
                <div id="pw-strength" class="small text-muted"></div>
            </div>
        </div>
    </div>
    <section class="mt-4">
        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem;">Why use an online random password generator?</h2>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            This <strong>random password generator</strong> helps you create long, unique credentials for your email, hosting,
            SaaS accounts and developer tools. By combining lowercase, uppercase, digits and optional symbols, it produces
            passwords that are much harder to guess than simple phrases. You can adjust the length to match the
            requirements of each site while still keeping high entropy.
        </p>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            The built‑in <strong>password strength checker</strong> gives an instant rating from very weak to very strong,
            so you know when it is safe to use a password in production. All generation happens in your browser; nothing
            is stored on the server, which makes this <strong>online password generator</strong> suitable for quick,
            everyday use alongside your password manager.
        </p>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem;">Good practices for strong passwords</h3>
                <ul style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9); padding-left: 1.1rem;">
                    <li>Use a different generated password for every important account.</li>
                    <li>Prefer lengths of <strong>12–20 characters</strong> for public websites, and even longer for admin panels.</li>
                    <li>Avoid reusing human‑readable phrases that can appear in data breaches.</li>
                    <li>Store passwords in a reputable password manager instead of plain text notes.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem;">When to rely on a password manager</h3>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
                    This generator is perfect when you need a strong password right now, for example during a deployment or
                    while creating a new database user. For long‑term security, pair it with a password manager that remembers
                    every generated string for you and keeps them encrypted across your devices.
                </p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function measureStrength(pw) {
        let score = 0;
        if (!pw) return 0;
        if (pw.length >= 8) score++;
        if (pw.length >= 12) score++;
        if (/[a-z]/.test(pw) && /[A-Z]/.test(pw)) score++;
        if (/\d/.test(pw)) score++;
        if (/[^A-Za-z0-9]/.test(pw)) score++;
        return score;
    }

    function strengthLabel(score) {
        if (score <= 1) return 'Very weak';
        if (score === 2) return 'Weak';
        if (score === 3) return 'Medium';
        if (score === 4) return 'Strong';
        return 'Very strong';
    }

    function generatePassword() {
        const length = Math.max(6, Math.min(64, parseInt(document.getElementById('pw-length').value || '16', 10)));
        const sets = [];
        if (document.getElementById('pw-lower').checked) sets.push('abcdefghijklmnopqrstuvwxyz');
        if (document.getElementById('pw-upper').checked) sets.push('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        if (document.getElementById('pw-digits').checked) sets.push('0123456789');
        if (document.getElementById('pw-symbols').checked) sets.push('!@#$%^&*()-_=+[]{};:,.<>?');
        if (!sets.length) sets.push('abcdefghijklmnopqrstuvwxyz');

        const all = sets.join('');
        let pw = '';
        for (let i = 0; i < length; i++) {
            pw += all.charAt(Math.floor(Math.random() * all.length));
        }
        return pw;
    }

    const output = document.getElementById('pw-output');
    const strength = document.getElementById('pw-strength');

    document.getElementById('pw-generate').addEventListener('click', () => {
        const pw = generatePassword();
        output.value = pw;
        const score = measureStrength(pw);
        strength.textContent = 'Strength: ' + strengthLabel(score);
    });

    document.getElementById('pw-copy').addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(output.value);
            strength.textContent = 'Copied to clipboard. ' + strength.textContent;
        } catch (e) {
            // ignore
        }
    });
</script>
@endsection


