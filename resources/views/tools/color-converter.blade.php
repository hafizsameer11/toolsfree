@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2">HEX ↔ RGB Color Converter</h1>
        <p class="text-muted">
            Quickly convert HEX colors to RGB and back. Use the color picker to explore shades and copy clean codes.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="mb-3">
                    <label class="form-label">HEX</label>
                    <input type="text" id="hex-input" class="tool-input" value="#2563eb">
                </div>
                <div class="mb-3">
                    <label class="form-label">Color picker</label>
                    <input type="color" id="color-picker" class="form-control form-control-color" value="#2563eb">
                </div>
                <button class="btn btn-primary btn-sm" id="hex-to-rgb">Convert to RGB</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="mb-3">
                    <label class="form-label">RGB</label>
                    <input type="text" id="rgb-input" class="tool-input" placeholder="37, 99, 235">
                </div>
                <button class="btn btn-outline-secondary btn-sm mb-2" id="rgb-to-hex">Convert to HEX</button>
                <div id="color-preview" style="margin-top: 0.75rem; height: 60px; border-radius: 0.75rem;"></div>
            </div>
        </div>
    </div>
    <section class="mt-4">
        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem;">Online HEX to RGB converter for web designers</h2>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            This tool is a quick <strong>HEX to RGB converter</strong> and <strong>RGB to HEX converter</strong> for everyday
            UI and front‑end work. Paste a color like <code>#2563eb</code>, use the color picker to adjust the shade, and copy
            the corresponding RGB values into your CSS or design system. If you already have an RGB color from Figma or
            Photoshop, enter the three numbers to instantly get the matching HEX code.
        </p>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            Because the preview box updates in real time, you can keep this <strong>online color picker</strong> open while
            experimenting with brand palettes, buttons, alerts and gradients. It is especially handy when you need to keep
            consistent colors between CSS, design tools and documentation.
        </p>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem;">Where HEX and RGB are used</h3>
                <ul style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9); padding-left: 1.1rem;">
                    <li>Use HEX codes like <code>#111827</code> inside CSS, Tailwind config and design tokens.</li>
                    <li>Use RGB values such as <code>17, 24, 39</code> in design tools that support sliders.</li>
                    <li>Generate semi‑transparent overlays by turning RGB into <code>rgba()</code> values.</li>
                    <li>Share colors with non‑technical teammates using the format they prefer.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem;">Tips for consistent color systems</h3>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
                    Pick a base color with the picker, then copy both the HEX and RGB values into your documentation.
                    Having both formats recorded prevents small mismatches when different people add styles to a project.
                    This converter helps you keep brand colors consistent across web, mobile and marketing material.
                </p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    const hexInput = document.getElementById('hex-input');
    const rgbInput = document.getElementById('rgb-input');
    const picker = document.getElementById('color-picker');
    const preview = document.getElementById('color-preview');

    function setPreview(color) {
        preview.style.background = color;
    }

    function hexToRgb(hex) {
        hex = hex.replace('#', '');
        if (hex.length === 3) {
            hex = hex.split('').map(c => c + c).join('');
        }
        if (hex.length !== 6) return null;
        const bigint = parseInt(hex, 16);
        return [(bigint >> 16) & 255, (bigint >> 8) & 255, bigint & 255];
    }

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(x => {
            const h = Number(x).toString(16);
            return h.length === 1 ? '0' + h : h;
        }).join('');
    }

    document.getElementById('hex-to-rgb').addEventListener('click', () => {
        const rgb = hexToRgb(hexInput.value.trim());
        if (!rgb) return;
        rgbInput.value = rgb.join(', ');
        setPreview('rgb(' + rgb.join(',') + ')');
        picker.value = rgbToHex(rgb[0], rgb[1], rgb[2]);
    });

    document.getElementById('rgb-to-hex').addEventListener('click', () => {
        const parts = rgbInput.value.split(',').map(p => p.trim());
        if (parts.length !== 3) return;
        const hex = rgbToHex(parts[0], parts[1], parts[2]);
        hexInput.value = hex;
        setPreview(hex);
        picker.value = hex;
    });

    picker.addEventListener('input', () => {
        hexInput.value = picker.value;
        const rgb = hexToRgb(picker.value);
        if (rgb) {
            rgbInput.value = rgb.join(', ');
            setPreview(picker.value);
        }
    });

    // initial
    setPreview('#2563eb');
</script>
@endsection


