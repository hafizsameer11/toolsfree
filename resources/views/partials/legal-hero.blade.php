{{-- Shared hero for legal & info pages --}}
<div class="legal-hero mb-4">
    <h1>{{ $title }}</h1>
    @if(!empty($subtitle))
        <p class="legal-hero-sub">{{ $subtitle }}</p>
    @endif
    @if(!empty($updated))
        <p class="legal-hero-date">Last updated: {{ $updated }}</p>
    @endif
</div>
