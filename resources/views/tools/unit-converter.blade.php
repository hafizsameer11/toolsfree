@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2" style="color: #ffffff !important;">Unit Converter</h1>
        <p class="text-muted">
            Convert length, weight, volume and temperature units in a single, simple interface.
        </p>
    </div>

    <div class="card mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Value</label>
                <input type="number" step="any" id="unit-value" class="tool-input" value="1">
            </div>
            <div class="col-md-3">
                <label class="form-label">From</label>
                <select id="unit-from" class="form-select">
                    <optgroup label="Length">
                        <option value="cm">Centimeters</option>
                        <option value="inch">Inches</option>
                        <option value="m">Meters</option>
                        <option value="km">Kilometers</option>
                        <option value="mile">Miles</option>
                        <option value="nautical-mile">Nautical miles</option>
                    </optgroup>
                    <optgroup label="Weight">
                        <option value="kg">Kilograms</option>
                        <option value="lb">Pounds (lb)</option>
                        <option value="stone">Stone</option>
                    </optgroup>
                    <optgroup label="Volume">
                        <option value="liter">Liters</option>
                        <option value="gallon-us">US gallons</option>
                        <option value="cup-us-dry">US dry cups</option>
                    </optgroup>
                    <optgroup label="Temperature">
                        <option value="c">Celsius</option>
                        <option value="f">Fahrenheit</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">To</label>
                <select id="unit-to" class="form-select">
                    <option value="inch">Inches</option>
                    <option value="cm">Centimeters</option>
                    <option value="m">Meters</option>
                    <option value="kg">Kilograms</option>
                    <option value="lb">Pounds (lb)</option>
                    <option value="f">Fahrenheit</option>
                    <option value="c">Celsius</option>
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button class="btn btn-primary" id="unit-convert">Convert</button>
            </div>
        </div>
        <div class="mt-3">
            <label class="form-label">Result</label>
            <input type="text" id="unit-result" class="tool-input" readonly>
        </div>
    </div>
    <section class="mt-4">
        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: #ffffff !important;">Online unit converter for length, weight, volume and temperature</h2>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            The <strong>online unit converter</strong> is ideal when you need to quickly switch between metric and imperial
            systems. Convert <strong>cm to inches</strong>, <strong>meters to feet</strong>, <strong>kilometers to miles</strong>
            or even <strong>nautical miles</strong> for mapping and travel. For weight you can go from <strong>kg to lbs</strong>
            or <strong>stone to kg</strong>, and for volume you can convert <strong>liters to US gallons</strong> and
            <strong> US dry cups to milliliters</strong>.
        </p>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            The temperature section supports <strong>Celsius to Fahrenheit</strong> and back, which is useful when reading
            documentation, recipes or scientific articles written in a different standard. Keep this page pinned and use it
            as a simple calculator whenever you are working with measurements in code, design specs or real‑world projects.
        </p>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem; color: #ffffff !important;">Popular conversions</h3>
                <ul style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9); padding-left: 1.1rem;">
                    <li>Front‑end layouts: convert <strong>pixels to centimeters</strong> when printing designs.</li>
                    <li>Fitness apps: show <strong>miles and kilometers</strong> or <strong>kg and lbs</strong> side‑by‑side.</li>
                    <li>Cooking: switch between <strong>cups, liters and milliliters</strong> for international recipes.</li>
                    <li>Weather widgets: let users choose between <strong>°C and °F</strong> with accurate conversion.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem; color: #ffffff !important;">How to get accurate results</h3>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
                    Enter a value, choose the source and target units, and click <strong>Convert</strong>. The
                    calculator normalizes everything internally (meters for length, kilograms for weight, liters for volume),
                    then converts to your chosen target unit. This approach reduces rounding issues so that repeated
                    conversions remain consistent.
                </p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function convertUnit(value, from, to) {
        value = parseFloat(value);
        if (isNaN(value)) return null;

        // Temperature
        if ((from === 'c' && to === 'f')) return (value * 9/5) + 32;
        if ((from === 'f' && to === 'c')) return (value - 32) * 5/9;
        if (from === 'c' && to === 'c') return value;
        if (from === 'f' && to === 'f') return value;

        // Normalize length to meters
        const lengthToMeters = {
            cm: v => v / 100,
            inch: v => v * 0.0254,
            m: v => v,
            km: v => v * 1000,
            mile: v => v * 1609.34,
            'nautical-mile': v => v * 1852,
        };
        const metersToLength = {
            cm: v => v * 100,
            inch: v => v / 0.0254,
            m: v => v,
            km: v => v / 1000,
            mile: v => v / 1609.34,
            'nautical-mile': v => v / 1852,
        };

        if (lengthToMeters[from] && metersToLength[to]) {
            const meters = lengthToMeters[from](value);
            return metersToLength[to](meters);
        }

        // Weight (kg)
        const toKg = {
            kg: v => v,
            lb: v => v * 0.453592,
            stone: v => v * 6.35029,
        };
        const fromKg = {
            kg: v => v,
            lb: v => v / 0.453592,
            stone: v => v / 6.35029,
        };

        if (toKg[from] && fromKg[to]) {
            const kg = toKg[from](value);
            return fromKg[to](kg);
        }

        // Volume (liters)
        const toLiter = {
            liter: v => v,
            'gallon-us': v => v * 3.78541,
            'cup-us-dry': v => v * 0.236588,
        };
        const fromLiter = {
            liter: v => v,
            'gallon-us': v => v / 3.78541,
            'cup-us-dry': v => v / 0.236588,
        };

        if (toLiter[from] && fromLiter[to]) {
            const l = toLiter[from](value);
            return fromLiter[to](l);
        }

        return null;
    }

    document.getElementById('unit-convert').addEventListener('click', () => {
        const value = document.getElementById('unit-value').value;
        const from = document.getElementById('unit-from').value;
        const to = document.getElementById('unit-to').value;
        const result = convertUnit(value, from, to);
        document.getElementById('unit-result').value =
            result === null ? 'Conversion not supported' : result.toFixed(4);
    });
</script>
@endsection


