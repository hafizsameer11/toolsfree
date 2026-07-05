@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">Aa</div>
        <div>
            <h1 class="tool-page-title">Text Case Converter</h1>
            <p class="tool-page-subtitle">Transform text between camelCase, snake_case, kebab-case, and more — instantly.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <label class="form-label">Input text</label>
        <textarea id="case-input" class="tool-textarea" placeholder="Enter text or variable names, e.g. hello world, user_profile_id, getUserData"></textarea>
        <div class="tool-toolbar mt-3">
            <button class="btn btn-outline-secondary btn-sm tool-btn" id="case-clear">🗑 Clear</button>
            <span class="tool-stats" id="case-stats"></span>
            <span class="tool-badge">🔒 Client-side only</span>
        </div>
    </div>

    <div class="row g-3 mb-4" id="case-results">
        @foreach([
            ['id' => 'upper', 'label' => 'UPPERCASE', 'desc' => 'ALL CAPS'],
            ['id' => 'lower', 'label' => 'lowercase', 'desc' => 'all lowercase'],
            ['id' => 'title', 'label' => 'Title Case', 'desc' => 'Each Word Capitalized'],
            ['id' => 'sentence', 'label' => 'Sentence case', 'desc' => 'First letter capitalized'],
            ['id' => 'camel', 'label' => 'camelCase', 'desc' => 'firstWordLowerRestUpper'],
            ['id' => 'pascal', 'label' => 'PascalCase', 'desc' => 'EachWordUpperCase'],
            ['id' => 'snake', 'label' => 'snake_case', 'desc' => 'words_with_underscores'],
            ['id' => 'kebab', 'label' => 'kebab-case', 'desc' => 'words-with-hyphens'],
            ['id' => 'constant', 'label' => 'CONSTANT_CASE', 'desc' => 'UPPER_WITH_UNDERSCORES'],
            ['id' => 'dot', 'label' => 'dot.case', 'desc' => 'words.with.dots'],
        ] as $case)
        <div class="col-md-6 col-lg-4">
            <div class="case-result-card">
                <div class="case-result-header">
                    <span class="case-result-label">{{ $case['label'] }}</span>
                    <button class="btn btn-outline-secondary btn-sm case-copy-btn" data-target="case-{{ $case['id'] }}" title="Copy">📋</button>
                </div>
                <p class="case-result-desc">{{ $case['desc'] }}</p>
                <output id="case-{{ $case['id'] }}" class="case-result-value">—</output>
            </div>
        </div>
        @endforeach
    </div>

    @include('tools.content.text-case-converter')
@endsection

@section('scripts')
<script>
(function() {
    const input = document.getElementById('case-input');
    const stats = document.getElementById('case-stats');

    function tokenize(text) {
        if (!text.trim()) return [];
        return text
            .replace(/([a-z])([A-Z])/g, '$1 $2')
            .replace(/([A-Z]+)([A-Z][a-z])/g, '$1 $2')
            .split(/[\s_\-.]+/)
            .filter(Boolean)
            .map(w => w.toLowerCase());
    }

    function convert(text) {
        const words = tokenize(text);
        if (!words.length) {
            document.querySelectorAll('.case-result-value').forEach(el => el.textContent = '—');
            stats.textContent = '';
            return;
        }

        const caps = words.map(w => w.charAt(0).toUpperCase() + w.slice(1));
        const joined = {
            upper: words.join(' ').toUpperCase(),
            lower: words.join(' ').toLowerCase(),
            title: caps.join(' '),
            sentence: caps[0] + (words.length > 1 ? ' ' + words.slice(1).join(' ') : ''),
            camel: words[0] + caps.slice(1).join(''),
            pascal: caps.join(''),
            snake: words.join('_'),
            kebab: words.join('-'),
            constant: words.join('_').toUpperCase(),
            dot: words.join('.'),
        };

        Object.entries(joined).forEach(([key, val]) => {
            const el = document.getElementById('case-' + key);
            if (el) el.textContent = val;
        });

        stats.textContent = `${words.length} word${words.length !== 1 ? 's' : ''} detected · ${text.length.toLocaleString()} chars`;
    }

    input.addEventListener('input', () => convert(input.value));

    document.getElementById('case-clear').addEventListener('click', () => {
        input.value = '';
        convert('');
    });

    document.querySelectorAll('.case-copy-btn').forEach(btn => {
        btn.addEventListener('click', async () => {
            const el = document.getElementById(btn.dataset.target);
            if (!el || el.textContent === '—') return;
            try { await navigator.clipboard.writeText(el.textContent); }
            catch { /* ignore */ }
        });
    });

    convert('');
})();
</script>
@endsection
