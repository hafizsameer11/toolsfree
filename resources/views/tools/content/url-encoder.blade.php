<section class="tool-content-section">
    <h2>Complete Guide to URL Encoding and Decoding</h2>
    <p>URLs are the foundation of web navigation, but they have strict rules about which characters they can contain. When you need to pass dynamic data — search queries, user names, redirect targets, tracking parameters — through a URL, those values must be encoded so they do not break the link or get misinterpreted by browsers and servers. This process is called <strong>percent-encoding</strong> or <strong>URL encoding</strong>, and it is an essential skill for every web developer, marketer, and API integrator.</p>
    <p>ToolsFree.org offers a free, client-side URL encoder and decoder that supports multiple encoding modes. Your links and text never leave your browser, making it safe to encode sensitive redirect URLs, OAuth callbacks, and campaign parameters. This guide explains how URL encoding works, when to use each mode, and how to avoid the most common mistakes.</p>

    <h2>Why URL Encoding Exists</h2>
    <p>A URL has structural components: scheme (<code>https://</code>), host (<code>example.com</code>), path (<code>/search</code>), query string (<code>?q=hello</code>), and fragment (<code>#section</code>). Certain characters are reserved because they define this structure. The question mark starts the query string. The ampersand separates parameters. The equals sign connects keys and values. The hash starts the fragment.</p>
    <p>If your data contains any of these reserved characters — or spaces, Unicode letters, or symbols — they must be encoded as a percent sign followed by two hexadecimal digits. A space becomes <code>%20</code>. An ampersand becomes <code>%26</code>. The letter é becomes <code>%C3%A9</code> in UTF-8 encoding. Without this transformation, a search for "fish & chips" could break the URL parser or truncate the query at the ampersand.</p>

    <h2>encodeURIComponent vs encodeURI: Which Mode to Use</h2>
    <p>JavaScript provides two encoding functions, and this tool supports both. <strong>encodeURIComponent</strong> (our "Encode component" mode) encodes every character except unreserved characters: A–Z, a–z, 0–9, hyphen, underscore, period, and tilde. Use this mode for individual query parameter values. For example, encoding the search term in <code>?q=hello world</code> should encode only the value, producing <code>?q=hello%20world</code>.</p>
    <p><strong>encodeURI</strong> (our "Encode full URI" mode) preserves URL structure characters: colon, slash, question mark, hash, and at sign. Use this when you have a complete URL with dynamic segments that need encoding but structural characters must remain intact. For example, encoding a full URL with spaces in the path without breaking the <code>://</code> or directory slashes.</p>
    <p><strong>Decode</strong> mode reverses percent-encoding using decodeURIComponent, turning encoded sequences back into readable text. Use this to inspect URLs from server logs, analytics reports, or encoded email links.</p>

    <h2>Step-by-Step: Building a Campaign URL</h2>
    <p>Marketing teams use UTM parameters to track traffic sources in Google Analytics. A typical campaign URL might look like: <code>https://yoursite.com/landing?utm_source=newsletter&utm_medium=email&utm_campaign=spring_sale</code>. If the campaign name contains spaces or special characters, each value must be encoded individually.</p>
    <p>Start with your base URL. For each parameter value, paste it into this tool in Encode component mode. Copy the encoded value back into your URL. Assemble the final link: base + <code>?utm_source=</code> + encoded source + <code>&utm_medium=</code> + encoded medium, and so on. Test the final URL in an incognito browser window before launching the campaign.</p>

    <h2>URL Encoding in OAuth and SSO Integrations</h2>
    <p>OAuth 2.0 and OpenID Connect require precise redirect URI encoding. When registering a callback URL like <code>https://app.example.com/auth/callback?provider=google</code>, the entire redirect URI must match exactly between your application registration and the authorization request. Query parameters within redirect URIs must be properly encoded.</p>
    <p>Common OAuth errors — "redirect_uri_mismatch" or "invalid_request" — often trace back to encoding issues. A redirect URI registered with unencoded characters but sent with encoded characters (or vice versa) will fail validation. Use this decoder to inspect the exact redirect URI your application sends, character by character.</p>

    <h2>International URLs and Unicode</h2>
    <p>Modern browsers support Internationalized Domain Names (IDN) and Unicode in URL paths and query strings. Non-ASCII characters must be encoded as UTF-8 bytes, then percent-encoded. The Japanese word for "hello" (こんにちは) becomes a sequence of percent-encoded bytes. This tool handles UTF-8 correctly because it operates on Unicode strings in the browser.</p>
    <p>When building multilingual applications, always encode user-generated content in URLs regardless of language. Never assume ASCII-only input — your users will eventually paste emoji, accented characters, or CJK text into search fields.</p>

    <h2>Common URL Encoding Mistakes</h2>
    <p><strong>Double encoding</strong> is the most frequent error. If a value is already encoded (<code>hello%20world</code>) and you encode it again, the percent sign itself gets encoded to <code>%25</code>, producing <code>hello%2520world</code> — which decodes to <code>hello%20world</code> instead of <code>hello world</code>. Always check whether input is already encoded before processing.</p>
    <p><strong>Encoding the entire URL with encodeURIComponent</strong> breaks structural characters. The colons and slashes in <code>https://</code> get encoded, producing an unusable string. Use encodeURI for full URLs and encodeURIComponent for individual values.</p>
    <p><strong>Using + for spaces</strong> works in some contexts (HTML form submission with application/x-www-form-urlencoded) but not in all URL parsers. Percent-encoding spaces as <code>%20</code> is the safe, universal approach.</p>

    <h2>URL Encoding in Different Programming Languages</h2>
    <p>Every major language provides URL encoding utilities. JavaScript uses <code>encodeURIComponent()</code> and <code>decodeURIComponent()</code>. PHP uses <code>urlencode()</code> and <code>urldecode()</code> for form data, or <code>rawurlencode()</code> for RFC 3986 compliance. Python uses <code>urllib.parse.quote()</code> and <code>quote_plus()</code>. Java uses <code>URLEncoder.encode()</code>. Ruby uses <code>URI.encode_www_form_component</code>.</p>
    <p>When debugging cross-language integrations, use this tool as a reference. Encode a test value here, then compare with your server-side output. Discrepancies in space encoding (+ vs %20) or slash handling often explain mysterious 400 Bad Request errors.</p>

    <h2>Security Considerations</h2>
    <p>URL encoding is not encryption. Encoding an API key or password in a URL does not protect it — anyone can decode it instantly. Never pass secrets in URL query parameters when avoidable; use HTTP headers or request bodies instead. When URLs with sensitive data must be logged, redact or hash the values.</p>
    <p>URL encoding also plays a role in preventing injection attacks. Properly encoding user input before inserting it into URLs prevents attackers from injecting additional query parameters or path segments. Always encode on output, not decode on input — validate and sanitize data at the application layer as well.</p>

    <div class="row mt-4 g-4">
        <div class="col-md-6">
            <div class="tool-info-card">
                <h3>Everyday use cases</h3>
                <ul>
                    <li>Building UTM tracking links for marketing campaigns</li>
                    <li>Encoding OAuth redirect URIs and callback URLs</li>
                    <li>Creating shareable search links with special characters</li>
                    <li>Debugging malformed query strings in API requests</li>
                    <li>Decoding URLs from server access logs and analytics</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tool-info-card">
                <h3>Encoding mode quick reference</h3>
                <ul>
                    <li><strong>Component:</strong> Single parameter values, search terms, IDs</li>
                    <li><strong>Full URI:</strong> Complete URLs that need partial encoding</li>
                    <li><strong>Decode:</strong> Reading encoded URLs from logs or emails</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tool-faq mt-4">
        <h3>Frequently asked questions</h3>
        <details class="tool-faq-item">
            <summary>Is URL encoding the same as encryption?</summary>
            <p>No. URL encoding is a reversible character substitution for transport safety. Anyone can decode a percent-encoded string instantly. It provides no confidentiality or security.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Should I encode the entire URL or just the parameters?</summary>
            <p>Encode individual parameter values with component mode. Encode a full URL only when using URI mode and the URL contains characters that need encoding outside the query string, such as spaces in a path segment.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Does this tool send my URLs to a server?</summary>
            <p>No. All encoding and decoding runs locally in your browser. Your links are never transmitted, logged, or stored.</p>
        </details>
        <details class="tool-faq-item">
            <summary>What is the difference between %20 and + for spaces?</summary>
            <p>Both represent spaces in different contexts. %20 is standard percent-encoding used in URLs per RFC 3986. The plus sign is used in application/x-www-form-urlencoded form data. For general URL query strings, %20 is the safer choice.</p>
        </details>
    </div>
</section>
