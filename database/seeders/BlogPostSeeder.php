<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = $this->articles();

        foreach ($posts as $data) {
            Post::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'is_published' => true,
                    'published_at' => $data['published_at'] ?? now()->subDays($data['days_ago'] ?? 1),
                ])
            );
        }
    }

    private function articles(): array
    {
        return [
            $this->article(
                'How to Format JSON for REST APIs: Complete Guide',
                'how-to-format-json-for-rest-apis',
                'json-formatter-guide.svg',
                'Learn how to beautify, minify, and validate JSON for API development with practical examples.',
                'json formatter,rest api,json beautify,json validate,api development',
                1,
                $this->bodyJsonFormatter()
            ),
            $this->article(
                'URL Encoding Explained: A Developer\'s Guide',
                'url-encoding-explained-developers-guide',
                'url-encoding-guide.svg',
                'Master percent-encoding for query strings, OAuth callbacks, and safe redirects.',
                'url encoder,url decoder,percent encoding,query string',
                3,
                $this->bodyUrlEncoding()
            ),
            $this->article(
                'HEX to RGB Color Conversion for Web Designers',
                'hex-to-rgb-color-conversion-web-designers',
                'color-conversion-guide.svg',
                'Convert HEX and RGB values quickly and keep brand colors consistent across CSS and design tools.',
                'hex to rgb,rgb to hex,color converter,css colors',
                5,
                $this->bodyColorConversion()
            ),
            $this->article(
                'Unit Converter Cheat Sheet: Length, Weight, Volume & Temperature',
                'unit-converter-cheat-sheet',
                'unit-converter-guide.svg',
                'Quick reference for cm to inches, kg to lbs, liters to gallons, and Celsius to Fahrenheit.',
                'unit converter,cm to inches,kg to lbs,celsius fahrenheit',
                7,
                $this->bodyUnitConverter()
            ),
            $this->article(
                'Strong Password Best Practices for 2025',
                'strong-password-best-practices-2025',
                'password-security-guide.svg',
                'Create secure passwords with length, entropy, and smart habits that protect your accounts.',
                'password generator,strong password,password security',
                9,
                $this->bodyPasswordSecurity()
            ),
            $this->article(
                'Common JSON Validation Errors and How to Fix Them',
                'common-json-validation-errors-how-to-fix',
                'json-errors-guide.svg',
                'Troubleshoot trailing commas, unquoted keys, and escape character issues in JSON payloads.',
                'json validator,json syntax error,json debugging',
                11,
                $this->bodyJsonErrors()
            ),
            $this->article(
                'UTM Parameters and URL Encoding for Marketing Campaigns',
                'utm-parameters-url-encoding-marketing',
                'utm-url-marketing.svg',
                'Build trackable campaign links without breaking URLs in email, ads, and social posts.',
                'utm parameters,url encoding,marketing links,campaign tracking',
                13,
                $this->bodyUtmMarketing()
            ),
            $this->article(
                'CSS Color Formats: HEX, RGB, HSL and When to Use Each',
                'css-color-formats-hex-rgb-hsl',
                'css-colors-guide.svg',
                'Understand modern CSS color syntax and pick the right format for your design system.',
                'css colors,hex rgb,hsl colors,web design',
                15,
                $this->bodyCssColors()
            ),
            $this->article(
                'Metric vs Imperial: A Practical Conversion Guide',
                'metric-vs-imperial-conversion-guide',
                'metric-imperial-guide.svg',
                'Navigate global measurement standards for travel, recipes, fitness, and software localization.',
                'metric imperial,unit conversion,measurement guide',
                17,
                $this->bodyMetricImperial()
            ),
            $this->article(
                'Password Managers vs Online Password Generators',
                'password-managers-vs-online-password-generators',
                'password-manager-guide.svg',
                'Compare when to use a password manager and when a quick generator is the right tool.',
                'password manager,random password,online security',
                19,
                $this->bodyPasswordManager()
            ),
            $this->article(
                'API Testing Workflows with JSON Formatter Tools',
                'api-testing-workflows-json-formatter',
                'api-testing-json.svg',
                'Streamline Postman, cURL, and CI debugging with clean, validated JSON responses.',
                'api testing,json formatter,rest api testing',
                21,
                $this->bodyApiTesting()
            ),
            $this->article(
                'Free Web Developer Productivity Tools You Should Bookmark',
                'free-web-developer-productivity-tools',
                'developer-productivity.svg',
                'Discover essential browser-based utilities that save time without installing heavy software.',
                'developer tools,productivity,free online tools',
                23,
                $this->bodyProductivity()
            ),
            $this->article(
                'Web Security Basics: Encoding, HTTPS, and Password Hygiene',
                'web-security-basics-encoding-https-passwords',
                'web-security-basics.svg',
                'Essential security practices for developers and site owners using free online tools safely.',
                'web security,https,password hygiene,url encoding',
                25,
                $this->bodyWebSecurity()
            ),
        ];
    }

    private function article(
        string $title,
        string $slug,
        string $image,
        string $excerpt,
        string $keywords,
        int $daysAgo,
        string $body
    ): array {
        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $excerpt,
            'featured_image' => 'images/blog/' . $image,
            'meta_title' => $title . ' - ToolsFree.org',
            'meta_description' => $excerpt,
            'meta_keywords' => $keywords,
            'days_ago' => $daysAgo,
            'body' => $body,
        ];
    }

    private function img(string $file, string $alt): string
    {
        return '<figure class="blog-inline-figure"><img src="/images/blog/' . $file . '" alt="' . htmlspecialchars($alt) . '" class="blog-inline-image" loading="lazy"></figure>';
    }

    private function bodyJsonFormatter(): string
    {
        return '<p>Working with REST APIs means handling JSON all day. Whether you receive a compressed one-line response or hand-edit a config file, a reliable <strong>online JSON formatter</strong> saves time and prevents costly mistakes.</p>'
            . $this->img('json-formatter-guide.svg', 'JSON formatter for API development')
            . '<h2>Why pretty-print JSON?</h2><p>Readable indentation helps you spot nested objects, missing fields, and type mismatches. When debugging authentication errors or pagination bugs, formatted JSON makes diffs obvious.</p>'
            . '<h2>Beautify vs minify</h2><p>Use <strong>beautify</strong> during development and <strong>minify</strong> before embedding JSON in HTML or sending over slow networks. Our <a href="/json-formatter">JSON Formatter tool</a> does both in one click.</p>'
            . '<h2>Validate before deploy</h2><p>Always run a syntax check before committing API fixtures or CI test data. A single trailing comma can break production parsers.</p>'
            . $this->img('json-errors-guide.svg', 'JSON validation errors')
            . '<h2>Client-side privacy</h2><p>ToolsFree processes JSON in your browser—ideal for tokens and staging data you should never send to third-party servers.</p>';
    }

    private function bodyUrlEncoding(): string
    {
        return '<p>URLs only allow a limited character set. Spaces, ampersands, and Unicode text must be converted using <strong>percent-encoding</strong> before they appear in query strings or path segments.</p>'
            . $this->img('url-encoding-guide.svg', 'URL encoding diagram')
            . '<h2>When to encode</h2><p>Encode user search terms, email addresses in mailto links, and dynamic redirect URIs for OAuth. Never encode the entire URL—only the parameter values that need it.</p>'
            . '<h2>Decode for debugging</h2><p>Marketing teams often share long encoded links. Paste them into our <a href="/url-encoder-decoder">URL Encoder / Decoder</a> to read parameters clearly.</p>'
            . '<h2>Common mistakes</h2><ul><li>Double-encoding the same string</li><li>Encoding reserved characters in the scheme or host</li><li>Mixing + and %20 for spaces across platforms</li></ul>';
    }

    private function bodyColorConversion(): string
    {
        return '<p>Designers work in HEX; some APIs and older tools expect RGB tuples. Converting between formats should take seconds, not spreadsheet formulas.</p>'
            . $this->img('color-conversion-guide.svg', 'HEX to RGB color conversion')
            . '<h2>HEX in CSS</h2><p>Six-digit HEX like <code>#2563eb</code> is compact and familiar. Shorthand <code>#fff</code> works for simple colors.</p>'
            . '<h2>RGB for transparency</h2><p>Once you have RGB components, build <code>rgba()</code> for overlays and glassmorphism effects.</p>'
            . '<h2>Try the tool</h2><p>Use the <a href="/color-picker-hex-rgb">HEX ↔ RGB Converter</a> with live preview while tuning brand palettes.</p>';
    }

    private function bodyUnitConverter(): string
    {
        return '<p>Global teams constantly switch between metric and imperial units. A dependable <strong>unit converter</strong> prevents shipping errors and misread specs.</p>'
            . $this->img('unit-converter-guide.svg', 'Unit converter categories')
            . '<h2>Length</h2><p>Convert centimeters to inches, kilometers to miles, and nautical miles for marine navigation apps.</p>'
            . '<h2>Weight & volume</h2><p>Recipes and logistics need kg↔lb and liters↔gallons. US dry cups differ from metric cups—label units clearly in UI copy.</p>'
            . '<h2>Temperature</h2><p>Celsius↔Fahrenheit is essential for weather widgets and IoT sensor dashboards. Test edge cases like negative Fahrenheit.</p>';
    }

    private function bodyPasswordSecurity(): string
    {
        return '<p>Weak passwords remain a top breach vector. Length and randomness beat clever memorable phrases every time for internet-facing accounts.</p>'
            . $this->img('password-security-guide.svg', 'Strong password security')
            . '<h2>Recommended length</h2><p>Aim for 14–20 characters on important accounts. Admin panels and database users deserve even longer secrets.</p>'
            . '<h2>Character diversity</h2><p>Mix upper, lower, digits, and symbols. Our <a href="/password-generator">Password Generator</a> includes a strength meter for instant feedback.</p>'
            . '<h2>Never reuse</h2><p>One breach should not compromise every service. Pair generators with a reputable password manager.</p>';
    }

    private function bodyJsonErrors(): string
    {
        return '<p>Invalid JSON stops pipelines cold. Learn the most frequent syntax issues and fix them in seconds.</p>'
            . $this->img('json-errors-guide.svg', 'JSON syntax errors')
            . '<h2>Trailing commas</h2><p>JSON does not allow commas after the last array or object item—unlike JavaScript.</p>'
            . '<h2>Unquoted keys</h2><p>Keys must use double quotes. Single quotes are invalid in strict JSON.</p>'
            . '<h2>Escape sequences</h2><p>Backslashes in paths and regex need proper escaping. Validate with our formatter before saving fixtures.</p>';
    }

    private function bodyUtmMarketing(): string
    {
        return '<p>UTM tags power analytics, but special characters break links if encoding is wrong.</p>'
            . $this->img('utm-url-marketing.svg', 'UTM campaign URL parameters')
            . '<h2>Standard parameters</h2><p><code>utm_source</code>, <code>utm_medium</code>, and <code>utm_campaign</code> identify traffic origin. Keep values lowercase for consistency.</p>'
            . '<h2>Encode spaces</h2><p>Campaign names with spaces become <code>%20</code> or <code>+</code> depending on context—test in our URL tool before launch.</p>';
    }

    private function bodyCssColors(): string
    {
        return '<p>Modern CSS supports multiple color spaces. Knowing when to use each improves maintainability.</p>'
            . $this->img('css-colors-guide.svg', 'CSS color format comparison')
            . '<h2>HEX</h2><p>Best for design tokens and static brand colors in stylesheets.</p>'
            . '<h2>RGB / RGBA</h2><p>Ideal when adjusting alpha or integrating with JavaScript canvas APIs.</p>'
            . '<h2>HSL</h2><p>Hue-first thinking helps when generating harmonious palettes programmatically.</p>';
    }

    private function bodyMetricImperial(): string
    {
        return '<p>Software localization often requires showing both measurement systems. Document conversion factors in your codebase comments.</p>'
            . $this->img('metric-imperial-guide.svg', 'Metric and imperial comparison')
            . '<h2>Localization tips</h2><p>Detect user locale, default to regional units, and offer toggles for international audiences.</p>'
            . '<h2>Precision</h2><p>Round for display but store full precision internally to avoid cumulative error in fitness or finance apps.</p>';
    }

    private function bodyPasswordManager(): string
    {
        return '<p>Generators create passwords; managers remember them. Use both together for a complete workflow.</p>'
            . $this->img('password-manager-guide.svg', 'Password manager workflow')
            . '<h2>When to generate online</h2><p>Quick one-off secrets during server setup or demo account creation.</p>'
            . '<h2>When to use a manager</h2><p>Long-term storage, autofill, breach alerts, and family sharing features.</p>';
    }

    private function bodyApiTesting(): string
    {
        return '<p>Clean JSON responses speed up API testing in Postman, Insomnia, and automated suites.</p>'
            . $this->img('api-testing-json.svg', 'API testing with JSON')
            . '<h2>Workflow</h2><p>Copy response → format → assert fields → save fixture. Repeat for regression tests.</p>'
            . '<h2>CI integration</h2><p>Store minified JSON in repos; format locally when failures occur.</p>';
    }

    private function bodyProductivity(): string
    {
        return '<p>The best tools load instantly and respect privacy. Bookmark a small set instead of installing dozens of apps.</p>'
            . $this->img('developer-productivity.svg', 'Developer productivity tools')
            . '<h2>Our toolkit</h2><p>JSON, URL, color, unit, and password utilities cover daily dev tasks at <a href="/">ToolsFree.org</a>.</p>'
            . '<h2>No login required</h2><p>Open a tab, paste data, get results—perfect for shared machines and client demos.</p>';
    }

    private function bodyWebSecurity(): string
    {
        return '<p>Security is layered: transport encryption, safe encoding, and credential hygiene.</p>'
            . $this->img('web-security-basics.svg', 'Web security fundamentals')
            . '<h2>HTTPS everywhere</h2><p>Serve tools and blogs over TLS to prevent mixed content and interception.</p>'
            . '<h2>Encode untrusted input</h2><p>Treat all user-provided strings as data, not code, when building URLs.</p>'
            . '<h2>Read our policies</h2><p>Review our <a href="/privacy-policy">Privacy Policy</a> and <a href="/terms-and-conditions">Terms and Conditions</a> for how ToolsFree operates.</p>';
    }
}
