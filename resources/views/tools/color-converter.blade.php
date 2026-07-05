@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">🎨</div>
        <div>
            <h1 class="tool-page-title">HEX ↔ RGB ↔ HSL Color Converter</h1>
            <p class="tool-page-subtitle">Convert between color formats, pick shades, preview live, and copy codes instantly.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card tool-panel">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label">HEX</label>
                        <div class="tool-input-group">
                            <input type="text" id="hex-input" class="tool-input" value="#2563eb" maxlength="7">
                            <button class="btn btn-outline-secondary btn-sm tool-copy-btn" data-copy="hex" title="Copy HEX">📋</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Color picker</label>
                        <input type="color" id="color-picker" class="form-control form-control-color tool-color-picker" value="#2563eb">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RGB</label>
                        <div class="tool-input-group">
                            <input type="text" id="rgb-input" class="tool-input" placeholder="37, 99, 235">
                            <button class="btn btn-outline-secondary btn-sm tool-copy-btn" data-copy="rgb" title="Copy RGB">📋</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">HSL</label>
                        <div class="tool-input-group">
                            <input type="text" id="hsl-input" class="tool-input" placeholder="221, 83%, 53%" readonly>
                            <button class="btn btn-outline-secondary btn-sm tool-copy-btn" data-copy="hsl" title="Copy HSL">📋</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CSS rgba()</label>
                        <div class="tool-input-group">
                            <input type="text" id="rgba-input" class="tool-input" readonly>
                            <button class="btn btn-outline-secondary btn-sm tool-copy-btn" data-copy="rgba" title="Copy rgba">📋</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span id="color-status" class="tool-inline-status"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card tool-panel h-100">
                <label class="form-label">Live preview</label>
                <div id="color-preview" class="color-preview-box"></div>
                <p class="color-preview-label" id="color-preview-label">#2563eb</p>
                <div class="color-swatches mt-3" id="color-swatches"></div>
            </div>
        </div>
    </div>

    @include('tools.content.color-converter')
@endsection

@section('scripts')
<script>
(function() {
    const hexInput = document.getElementById('hex-input');
    const rgbInput = document.getElementById('rgb-input');
    const hslInput = document.getElementById('hsl-input');
    const rgbaInput = document.getElementById('rgba-input');
    const picker = document.getElementById('color-picker');
    const preview = document.getElementById('color-preview');
    const previewLabel = document.getElementById('color-preview-label');
    const swatches = document.getElementById('color-swatches');
    const status = document.getElementById('color-status');

    function hexToRgb(hex) {
        hex = hex.replace('#', '').trim();
        if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
        if (!/^[0-9a-fA-F]{6}$/.test(hex)) return null;
        const n = parseInt(hex, 16);
        return [(n >> 16) & 255, (n >> 8) & 255, n & 255];
    }

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(x => {
            const h = Math.max(0, Math.min(255, Number(x))).toString(16);
            return h.length === 1 ? '0' + h : h;
        }).join('');
    }

    function rgbToHsl(r, g, b) {
        r /= 255; g /= 255; b /= 255;
        const max = Math.max(r, g, b), min = Math.min(r, g, b);
        let h, s, l = (max + min) / 2;
        if (max === min) { h = s = 0; }
        else {
            const d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch (max) {
                case r: h = ((g - b) / d + (g < b ? 6 : 0)) / 6; break;
                case g: h = ((b - r) / d + 2) / 6; break;
                default: h = ((r - g) / d + 4) / 6;
            }
        }
        return [Math.round(h * 360), Math.round(s * 100), Math.round(l * 100)];
    }

    function updateFromRgb(r, g, b) {
        const hex = rgbToHex(r, g, b);
        const hsl = rgbToHsl(r, g, b);
        hexInput.value = hex;
        rgbInput.value = `${r}, ${g}, ${b}`;
        hslInput.value = `${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%`;
        rgbaInput.value = `rgba(${r}, ${g}, ${b}, 1)`;
        picker.value = hex;
        preview.style.background = hex;
        previewLabel.textContent = hex.toUpperCase();
        renderSwatches(r, g, b);
    }

    function renderSwatches(r, g, b) {
        const hsl = rgbToHsl(r, g, b);
        swatches.innerHTML = '';
        [-20, -10, 0, 10, 20].forEach(delta => {
            const l = Math.max(0, Math.min(100, hsl[2] + delta));
            const el = document.createElement('div');
            el.className = 'color-swatch';
            el.style.background = `hsl(${hsl[0]}, ${hsl[1]}%, ${l}%)`;
            el.title = `Lightness ${l}%`;
            swatches.appendChild(el);
        });
    }

    function applyHex(hex) {
        const rgb = hexToRgb(hex);
        if (!rgb) {
            status.textContent = '✗ Invalid HEX color';
            return;
        }
        status.textContent = '';
        updateFromRgb(rgb[0], rgb[1], rgb[2]);
    }

    hexInput.addEventListener('input', () => {
        let v = hexInput.value.trim();
        if (!v.startsWith('#')) v = '#' + v;
        applyHex(v);
    });

    rgbInput.addEventListener('input', () => {
        const parts = rgbInput.value.split(',').map(p => parseInt(p.trim(), 10));
        if (parts.length !== 3 || parts.some(isNaN)) return;
        status.textContent = '';
        updateFromRgb(parts[0], parts[1], parts[2]);
    });

    picker.addEventListener('input', () => applyHex(picker.value));

    document.querySelectorAll('.tool-copy-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            const map = { hex: hexInput, rgb: rgbInput, hsl: hslInput, rgba: rgbaInput };
            const el = map[btn.dataset.copy];
            if (!el || !el.value) return;
            const text = btn.dataset.copy === 'rgb' ? `rgb(${el.value})` :
                         btn.dataset.copy === 'hsl' ? `hsl(${el.value})` : el.value;
            try {
                await navigator.clipboard.writeText(text);
                status.textContent = '✓ Copied ' + btn.dataset.copy.toUpperCase();
            } catch {
                status.textContent = 'Copy failed';
            }
            setTimeout(() => status.textContent = '', 2000);
        });
    });

    applyHex('#2563eb');
})();
</script>
@endsection
