<?php
/**
 * Expands every article to at least 1500 words with additional SEO sections.
 * Run: php database/seeders/expand_articles.php
 */

$dir = __DIR__.'/data/articles';
$minWords = 1500;

$extras = [
    'common-json-errors-how-to-fix' => extraBlock(
        'Production Checklist Before You Ship JSON',
        'Before merging API changes, run payloads through validation in CI. Store golden JSON fixtures in version control and diff on every pull request. When vendors change response shapes without notice, your tests catch regressions before customers do.',
        'Log parser errors with payload checksums, not full bodies, when data is sensitive. Pair error metrics with integration names so on-call engineers know which partner broke. Keep a runbook linking to RFC 8259 escape rules and your internal schema docs.',
        'ToolsFree.org processes JSON entirely in the browser—paste production-like samples into the {json_tool} during design reviews without sending secrets to third-party formatters. That privacy model matters when payloads contain PII or auth tokens.'
    ),
];

// Default expansion for any article below threshold
function defaultExtra(string $slug, string $toolName): string
{
    $title = 'Putting This Guide Into Daily Practice';
    $p1 = "Knowledge only helps when it becomes habit. Bookmark this page and return when you hit the specific problem it describes—search engines surface long-tail queries like the ones covered here because people need answers at the moment of failure, not during leisurely reading. Save worked examples in your team wiki with before-and-after snippets so junior developers inherit fixes instead of rediscovering them.";
    $p2 = "Pair reading with immediate experimentation. Open the relevant ToolsFree.org tool in an adjacent browser tab, paste real data from a sanitized log, and confirm the output matches expectations. Client-side tools mean you can iterate ten times in a minute without rate limits or account walls. Screenshot successful workflows for internal training decks.";
    $p3 = "Search rankings reward depth, clarity, and pages that satisfy intent completely. This article targets practical completion: you should leave with a checklist, not vague awareness. When standards evolve—NIST password guidance, WCAG revisions, new CSS color spaces—revisit authoritative sources and update your internal playbooks. {site} publishes guides aligned with its free utilities so theory and practice stay connected.";

    return extraBlock($title, $p1, $p2, str_replace('{site}', 'ToolsFree.org', $p3));
}

function extraBlock(string $h2, string ...$paragraphs): string
{
    $html = "<h2>".htmlspecialchars($h2)."</h2>\n";
    foreach ($paragraphs as $p) {
        $html .= '<p>'.$p."</p>\n";
    }

    return $html;
}

function wordCount(string $html): int
{
    return str_word_count(strip_tags($html));
}

function replacePlaceholders(string $html): string
{
    return str_replace(
        ['{json_tool}', '{url_tool}', '{color_tool}', '{unit_tool}', '{password_tool}', '{base64_tool}', '{hash_tool}', '{case_tool}', '{word_tool}', '{timestamp_tool}', '{uuid_tool}', '{jwt_tool}', '{qr_tool}', '{tools_index}', '{site}'],
        [
            '<a href="/json-formatter" class="tool-link">JSON Formatter</a>',
            '<a href="/url-encoder-decoder" class="tool-link">URL Encoder</a>',
            '<a href="/color-picker-hex-rgb" class="tool-link">Color Converter</a>',
            '<a href="/unit-converter" class="tool-link">Unit Converter</a>',
            '<a href="/password-generator" class="tool-link">Password Generator</a>',
            '<a href="/base64-encoder-decoder" class="tool-link">Base64 Encoder</a>',
            '<a href="/hash-generator" class="tool-link">Hash Generator</a>',
            '<a href="/text-case-converter" class="tool-link">Case Converter</a>',
            '<a href="/word-counter" class="tool-link">Word Counter</a>',
            '<a href="/unix-timestamp-converter" class="tool-link">Timestamp Converter</a>',
            '<a href="/uuid-generator" class="tool-link">UUID Generator</a>',
            '<a href="/jwt-decoder" class="tool-link">JWT Decoder</a>',
            '<a href="/qr-code-generator" class="tool-link">QR Code Generator</a>',
            '<a href="/tools" class="tool-link">All Tools</a>',
            'ToolsFree.org',
        ],
        $html
    );
}

$topicExtras = [
    'json-escape-characters-explained' => extraBlock('Escape Sequences in Log Aggregation Pipelines', 'Log forwarders often stringify JSON twice, turning a single backslash into \\\\ by the time it reaches Elasticsearch. When searching logs, know whether you are looking at stored JSON or a stringified representation. Test escapes in the {json_tool} using samples copied directly from Kibana or CloudWatch.', 'Security scanners flag unescaped user input in JSON APIs because it enables injection into downstream parsers. Sanitize at the boundary where untrusted text enters your system, then validate the serialized output. Never rely on the client alone—browser tools help developers understand the correct shape.', 'Document escape rules in your API style guide with copy-paste examples for quotes, newlines, and Unicode. Onboarding accelerates when examples are one click away from a live validator.'),
    'encodeuri-vs-encodeuricomponent-explained' => extraBlock('Encoding in Server-Side Frameworks', 'Node, PHP, Python, and Go each expose slightly different helpers. Compare their output to browser encodeURIComponent when building isomorphic apps. Integration tests should assert identical query strings from frontend and backend builders.', 'Marketing teams share links in Slack and email clients that re-encode URLs. Store canonical encoded forms in your CMS and avoid double-encoding when UTM parameters are appended later. The {url_tool} helps QA final links before campaigns launch.', 'Reserved character tables belong in developer docs—not tribal knowledge. Link internally from API references to this comparison so new hires decode failures faster.'),
    'nist-password-best-practices' => extraBlock('Implementing NIST Guidance in Code Reviews', 'Reject pull requests that shorten maximum password length below sixty-four characters or block paste in login forms. Add automated lint rules for auth UI components. Product managers often request complexity rules for perceived security—push back with NIST citations.', 'Breached-password blocklists integrate via Have I Been Pwned k-anonymity API or self-hosted bloom filters. Rate limiting and MFA still matter when passwords are allowed to be long and simple. Document your threat model: credential stuffing vs insider risk.', 'Use the {password_tool} to generate sample policies for staging environments. Never reuse demo passwords in production databases—even fake data leaks teach bad habits.'),
];

foreach (glob("$dir/*.html") as $path) {
    $slug = basename($path, '.html');
    $html = file_get_contents($path);
    $words = wordCount($html);

    if ($words >= $minWords) {
        echo "$slug: $words words (OK)\n";
        continue;
    }

    $insert = $topicExtras[$slug] ?? defaultExtra($slug, '');
    $insert = replacePlaceholders($insert);

    // Insert before figure or cta
    if (str_contains($html, '<figure class="blog-inline-figure">')) {
        $html = str_replace('<figure class="blog-inline-figure">', $insert.'<figure class="blog-inline-figure">', $html);
    } else {
        $html = str_replace('<div class="blog-cta">', $insert.'<div class="blog-cta">', $html);
    }

    // Add second expansion block if still short
    if (wordCount($html) < $minWords) {
        $insert2 = extraBlock(
            'Questions Teams Ask During Code Review',
            'Reviewers should ask whether this change affects external integrations, published APIs, or user-visible output. If yes, link to the relevant test fixture and manual QA steps. Documentation updates belong in the same pull request as behavior changes—not a follow-up ticket that never ships.',
            'Performance matters for client-side utilities: large payloads may slow browser formatters on low-end phones. Chunk huge JSON files in editors or use streaming parsers on the server. ToolsFree.org tools target everyday payload sizes developers paste during debugging, not multi-gigabyte dumps.',
            'Share this guide with support staff who field customer tickets about malformed data. First-line triage improves when non-engineers can validate JSON or URLs before escalating to on-call.'
        );
        $html = str_replace('<figure class="blog-inline-figure">', $insert2.'<figure class="blog-inline-figure">', $html);
    }

    file_put_contents($path, $html);
    echo "$slug: $words -> ".wordCount($html)." words\n";
}

// Second pass: ensure ALL articles meet 1500 by adding FAQ-style section
foreach (glob("$dir/*.html") as $path) {
    $slug = basename($path, '.html');
    $html = file_get_contents($path);
    $words = wordCount($html);

    if ($words >= $minWords) {
        continue;
    }

    $faq = extraBlock(
        'Frequently Asked Questions',
        'Teams often ask whether browser-based tools are safe for confidential data. ToolsFree.org runs utilities client-side without uploading input to servers—a model described in the privacy policy and relevant when handling credentials, tokens, or customer records during debugging.',
        'Another common question is how this topic relates to automated testing. Unit tests catch regressions; manual validation catches one-off vendor payloads and copy-paste errors from spreadsheets. Use both layers rather than treating passing CI as proof that production traffic will always parse.',
        'Finally, people ask which official standard to cite in compliance documents. Link primary sources—IETF RFCs, W3C recommendations, NIST special publications—rather than blog summaries alone. This article summarizes practical steps; your security questionnaire may require direct citations to those authorities.'
    );

    if (str_contains($html, '<figure class="blog-inline-figure">')) {
        $html = str_replace('<figure class="blog-inline-figure">', $faq.'<figure class="blog-inline-figure">', $html);
    } else {
        $html = str_replace('<div class="blog-cta">', $faq.'<div class="blog-cta">', $html);
    }

    file_put_contents($path, $html);
    echo "$slug (pass 2): -> ".wordCount($html)." words\n";
}

echo "Expansion complete.\n";
