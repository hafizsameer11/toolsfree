@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">📏</div>
        <div>
            <h1 class="tool-page-title">Unit Converter</h1>
            <p class="tool-page-subtitle">Convert length, weight, volume, temperature, area, speed, and data storage units.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select id="unit-category" class="form-select tool-select">
                    <option value="length">Length</option>
                    <option value="weight">Weight / Mass</option>
                    <option value="volume">Volume</option>
                    <option value="temperature">Temperature</option>
                    <option value="area">Area</option>
                    <option value="speed">Speed</option>
                    <option value="data">Data Storage</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Value</label>
                <input type="number" step="any" id="unit-value" class="tool-input" value="1">
            </div>
            <div class="col-md-3">
                <label class="form-label">From</label>
                <select id="unit-from" class="form-select tool-select"></select>
            </div>
            <div class="col-md-3">
                <label class="form-label">To</label>
                <select id="unit-to" class="form-select tool-select"></select>
            </div>
        </div>
        <div class="tool-toolbar mt-3">
            <button class="btn btn-primary tool-btn" id="unit-convert">Convert</button>
            <button class="btn btn-outline-secondary btn-sm tool-btn" id="unit-swap">⇄ Swap units</button>
            <span class="tool-badge">🔒 Client-side only</span>
        </div>
        <div class="unit-result-box mt-3" id="unit-result-box">
            <span class="unit-result-label">Result</span>
            <span class="unit-result-value" id="unit-result">—</span>
        </div>
        <div id="unit-formula" class="unit-formula"></div>
    </div>

    @include('tools.content.unit-converter')
@endsection

@section('scripts')
<script>
(function() {
    const UNITS = {
        length: {
            mm: { label: 'Millimeters (mm)', toBase: v => v / 1000, fromBase: v => v * 1000 },
            cm: { label: 'Centimeters (cm)', toBase: v => v / 100, fromBase: v => v * 100 },
            m: { label: 'Meters (m)', toBase: v => v, fromBase: v => v },
            km: { label: 'Kilometers (km)', toBase: v => v * 1000, fromBase: v => v / 1000 },
            inch: { label: 'Inches (in)', toBase: v => v * 0.0254, fromBase: v => v / 0.0254 },
            foot: { label: 'Feet (ft)', toBase: v => v * 0.3048, fromBase: v => v / 0.3048 },
            yard: { label: 'Yards (yd)', toBase: v => v * 0.9144, fromBase: v => v / 0.9144 },
            mile: { label: 'Miles (mi)', toBase: v => v * 1609.344, fromBase: v => v / 1609.344 },
            'nautical-mile': { label: 'Nautical miles', toBase: v => v * 1852, fromBase: v => v / 1852 },
            px: { label: 'Pixels (96 DPI)', toBase: v => v * 0.0254 / 96, fromBase: v => v * 96 / 0.0254 },
        },
        weight: {
            g: { label: 'Grams (g)', toBase: v => v / 1000, fromBase: v => v * 1000 },
            kg: { label: 'Kilograms (kg)', toBase: v => v, fromBase: v => v },
            oz: { label: 'Ounces (oz)', toBase: v => v * 0.0283495, fromBase: v => v / 0.0283495 },
            lb: { label: 'Pounds (lb)', toBase: v => v * 0.453592, fromBase: v => v / 0.453592 },
            stone: { label: 'Stone (st)', toBase: v => v * 6.35029, fromBase: v => v / 6.35029 },
            ton: { label: 'Metric tons (t)', toBase: v => v * 1000, fromBase: v => v / 1000 },
        },
        volume: {
            ml: { label: 'Milliliters (mL)', toBase: v => v / 1000, fromBase: v => v * 1000 },
            liter: { label: 'Liters (L)', toBase: v => v, fromBase: v => v },
            'gallon-us': { label: 'US gallons', toBase: v => v * 3.78541, fromBase: v => v / 3.78541 },
            'cup-us': { label: 'US cups', toBase: v => v * 0.236588, fromBase: v => v / 0.236588 },
            'pint-us': { label: 'US pints', toBase: v => v * 0.473176, fromBase: v => v / 0.473176 },
            'quart-us': { label: 'US quarts', toBase: v => v * 0.946353, fromBase: v => v / 0.946353 },
        },
        temperature: {
            c: { label: 'Celsius (°C)' },
            f: { label: 'Fahrenheit (°F)' },
            k: { label: 'Kelvin (K)' },
        },
        area: {
            'sq-m': { label: 'Square meters (m²)', toBase: v => v, fromBase: v => v },
            'sq-ft': { label: 'Square feet (ft²)', toBase: v => v * 0.092903, fromBase: v => v / 0.092903 },
            acre: { label: 'Acres', toBase: v => v * 4046.86, fromBase: v => v / 4046.86 },
            hectare: { label: 'Hectares (ha)', toBase: v => v * 10000, fromBase: v => v / 10000 },
        },
        speed: {
            'm-s': { label: 'Meters per second (m/s)', toBase: v => v, fromBase: v => v },
            'km-h': { label: 'Kilometers per hour (km/h)', toBase: v => v / 3.6, fromBase: v => v * 3.6 },
            mph: { label: 'Miles per hour (mph)', toBase: v => v * 0.44704, fromBase: v => v / 0.44704 },
        },
        data: {
            byte: { label: 'Bytes (B)', toBase: v => v, fromBase: v => v },
            kb: { label: 'Kilobytes (KB)', toBase: v => v * 1024, fromBase: v => v / 1024 },
            mb: { label: 'Megabytes (MB)', toBase: v => v * 1048576, fromBase: v => v / 1048576 },
            gb: { label: 'Gigabytes (GB)', toBase: v => v * 1073741824, fromBase: v => v / 1073741824 },
            tb: { label: 'Terabytes (TB)', toBase: v => v * 1099511627776, fromBase: v => v / 1099511627776 },
        },
    };

    const categoryEl = document.getElementById('unit-category');
    const fromEl = document.getElementById('unit-from');
    const toEl = document.getElementById('unit-to');
    const valueEl = document.getElementById('unit-value');
    const resultEl = document.getElementById('unit-result');
    const formulaEl = document.getElementById('unit-formula');

    function fillSelects() {
        const cat = categoryEl.value;
        const units = UNITS[cat];
        fromEl.innerHTML = toEl.innerHTML = '';
        Object.entries(units).forEach(([key, u]) => {
            fromEl.add(new Option(u.label, key));
            toEl.add(new Option(u.label, key));
        });
        if (toEl.options.length > 1) toEl.selectedIndex = 1;
    }

    function convertTemp(value, from, to) {
        let c;
        if (from === 'c') c = value;
        else if (from === 'f') c = (value - 32) * 5 / 9;
        else c = value - 273.15;
        if (to === 'c') return c;
        if (to === 'f') return c * 9 / 5 + 32;
        return c + 273.15;
    }

    function convert() {
        const cat = categoryEl.value;
        const value = parseFloat(valueEl.value);
        const from = fromEl.value;
        const to = toEl.value;
        if (isNaN(value)) { resultEl.textContent = 'Enter a valid number'; return; }

        let result;
        if (cat === 'temperature') {
            result = convertTemp(value, from, to);
        } else {
            const units = UNITS[cat];
            const base = units[from].toBase(value);
            result = units[to].fromBase(base);
        }

        const formatted = Math.abs(result) >= 1000 || (Math.abs(result) < 0.001 && result !== 0)
            ? result.toExponential(6) : result.toFixed(6).replace(/\.?0+$/, '');
        resultEl.textContent = `${value} ${UNITS[cat][from].label.split(' (')[0]} = ${formatted} ${UNITS[cat][to].label.split(' (')[0]}`;
        formulaEl.textContent = cat === 'temperature'
            ? 'Temperature conversions use standard formulas (°C ↔ °F ↔ K).'
            : `Conversion via base unit normalization within the ${cat} category.`;
    }

    categoryEl.addEventListener('change', () => { fillSelects(); convert(); });
    fromEl.addEventListener('change', convert);
    toEl.addEventListener('change', convert);
    valueEl.addEventListener('input', convert);

    document.getElementById('unit-convert').addEventListener('click', convert);
    document.getElementById('unit-swap').addEventListener('click', () => {
        const tmp = fromEl.value;
        fromEl.value = toEl.value;
        toEl.value = tmp;
        convert();
    });

    fillSelects();
    convert();
})();
</script>
@endsection
