@extends('layouts.app')

@section('content')
    <div class="tool-page-header mb-4">
        <div class="tool-page-icon">📝</div>
        <div>
            <h1 class="tool-page-title">Word &amp; Character Counter</h1>
            <p class="tool-page-subtitle">Count words, characters, sentences, and reading time — updated live as you type.</p>
        </div>
    </div>

    <div class="card tool-panel mb-4">
        <textarea id="wc-input" class="tool-textarea tool-textarea-lg" placeholder="Paste or type your text here to count words and characters…"></textarea>
        <div class="tool-toolbar mt-3">
            <button class="btn btn-outline-secondary btn-sm tool-btn" id="wc-clear">🗑 Clear</button>
            <span class="tool-badge">🔒 Client-side only</span>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card"><span class="stat-value" id="wc-words">0</span><span class="stat-label">Words</span></div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card"><span class="stat-value" id="wc-chars">0</span><span class="stat-label">Characters</span></div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card"><span class="stat-value" id="wc-chars-ns">0</span><span class="stat-label">Chars (no spaces)</span></div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card"><span class="stat-value" id="wc-sentences">0</span><span class="stat-label">Sentences</span></div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card"><span class="stat-value" id="wc-paragraphs">0</span><span class="stat-label">Paragraphs</span></div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="stat-card"><span class="stat-value" id="wc-reading">0 min</span><span class="stat-label">Reading time</span></div>
        </div>
    </div>

    @include('tools.content.word-counter')
@endsection

@section('scripts')
<script>
(function() {
    const input = document.getElementById('wc-input');
    function count() {
        const text = input.value;
        const words = text.trim() ? text.trim().split(/\s+/).length : 0;
        const chars = text.length;
        const charsNs = text.replace(/\s/g, '').length;
        const sentences = text.trim() ? (text.match(/[^.!?]+[.!?]+/g) || [text.trim()]).length : 0;
        const paragraphs = text.trim() ? text.split(/\n\s*\n/).filter(p => p.trim()).length : 0;
        const readingMin = Math.max(1, Math.ceil(words / 200));
        document.getElementById('wc-words').textContent = words.toLocaleString();
        document.getElementById('wc-chars').textContent = chars.toLocaleString();
        document.getElementById('wc-chars-ns').textContent = charsNs.toLocaleString();
        document.getElementById('wc-sentences').textContent = sentences.toLocaleString();
        document.getElementById('wc-paragraphs').textContent = paragraphs.toLocaleString();
        document.getElementById('wc-reading').textContent = words === 0 ? '0 min' : (words < 200 ? '< 1 min' : readingMin + ' min');
    }
    input.addEventListener('input', count);
    document.getElementById('wc-clear').addEventListener('click', () => { input.value = ''; count(); });
    count();
})();
</script>
@endsection
