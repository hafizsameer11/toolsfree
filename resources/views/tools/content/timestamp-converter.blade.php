<section class="tool-content-section">
    <h2>Complete Guide to Unix Timestamps, Epoch Time, and UTC Conversion</h2>
    <p>Every database row, API response, log entry, and JWT claim that records "when" something happened likely stores time as a number — not as a human-readable date string. That number is almost always a <strong>Unix timestamp</strong>: the count of seconds (or milliseconds) since January 1, 1970, 00:00:00 UTC, a moment known as the Unix epoch. Developers encounter these integers constantly, yet converting between epoch values and calendar dates remains a recurring source of bugs, especially across time zones, daylight saving transitions, and mixed precision (seconds versus milliseconds).</p>
    <p>ToolsFree.org provides a fast, privacy-focused <strong>Unix timestamp converter</strong> that runs entirely in your browser. Convert epoch seconds or milliseconds to readable UTC and local dates, or encode any datetime back to Unix time — without sending data to a server. This page gives you both the tool and the deep technical context to work with timestamps confidently in backend services, front-end applications, and data pipelines.</p>

    <h2>What Is a Unix Timestamp?</h2>
    <p>A Unix timestamp represents elapsed time since the epoch as a single integer. In the most common form, it counts <strong>seconds</strong> since 1970-01-01T00:00:00Z (the "Z" denotes UTC, also called Zulu time). For example, <code>1704067200</code> corresponds to January 1, 2024, 00:00:00 UTC. Many JavaScript APIs and mobile SDKs instead use <strong>milliseconds</strong> — the same moment would be <code>1704067200000</code> — because JS <code>Date.now()</code> returns milliseconds for finer precision in browser environments.</p>
    <p>Unix timestamps are timezone-agnostic at storage time. The integer always refers to an absolute instant on the global timeline. Display layers apply timezone offsets when rendering for users. Storing UTC-based epoch values avoids ambiguity; converting to "local time" is a presentation concern handled by libraries like PHP's <code>DateTime</code>, Python's <code>datetime</code>, JavaScript's <code>Intl.DateTimeFormat</code>, or Java's <code>Instant</code> and <code>ZonedDateTime</code>.</p>

    <h2>Seconds vs. Milliseconds: Avoiding the Most Common Bug</h2>
    <p>The single most frequent timestamp bug is a 1000× error: treating milliseconds as seconds or vice versa. If you pass <code>1704067200000</code> (milliseconds) to a function expecting seconds, the computed date lands tens of thousands of years in the future. If you pass seconds where milliseconds are expected, the date appears near the epoch in 1970.</p>
    <p>Quick heuristics help during debugging. Current Unix seconds in the 2020s are 10-digit numbers (around 1.7 billion). Millisecond timestamps are 13-digit numbers (around 1.7 trillion). If your API returns a 13-digit value, divide by 1000 before feeding systems that expect seconds — or configure your ORM and JSON serializers explicitly. Document which precision your API uses in OpenAPI specs and README files so integrators do not guess.</p>

    <h2>How to Use This Timestamp Converter Step by Step</h2>
    <p>To decode a timestamp, paste the numeric value into the input field and select whether it represents seconds or milliseconds. The tool displays the equivalent UTC datetime and your browser's local timezone interpretation. To encode a date, pick a calendar date and time (or type an ISO 8601 string if supported), and the tool outputs the corresponding Unix value in both precisions.</p>
    <p>Use the current-time button to snapshot "now" as a reference when correlating log lines. Copy results into tickets, SQL queries, or test fixtures. Clear between conversions when working with multiple incidents so you do not mix values from different debugging sessions.</p>

    <h2>UTC, Time Zones, and Daylight Saving Time</h2>
    <p>Coordinated Universal Time (UTC) is the global reference clock. It does not observe daylight saving time. "GMT" is often used interchangeably in casual conversation, though GMT as a legal time standard has nuances historians care about; in software, UTC is the correct term.</p>
    <p>Local time zones apply offsets from UTC: US Eastern Standard Time is UTC−5; Central European Summer Time is UTC+2. Daylight saving shifts those offsets seasonally. A meeting at "2024-03-10 02:30" in US Eastern may not exist on the spring-forward day when clocks jump from 2:00 to 3:00. Timestamp conversion libraries must use timezone databases (IANA tzdata) — not fixed offsets — to handle DST correctly. When debugging user-reported "wrong time" bugs, always ask: what timezone was the user in, and did the stored value include an offset or assume UTC?</p>

    <h2>Unix Timestamps in Databases and ORMs</h2>
    <p>Relational databases offer multiple strategies. MySQL provides <code>DATETIME</code>, <code>TIMESTAMP</code>, and integer columns. PostgreSQL excels with <code>TIMESTAMPTZ</code> (timestamp with time zone), which stores UTC internally. MongoDB's <code>Date</code> type is BSON datetime in milliseconds. Redis often stores TTLs as seconds relative to now.</p>
    <p>Laravel Eloquent casts <code>created_at</code> and <code>updated_at</code> to Carbon instances. Django uses timezone-aware datetimes when <code>USE_TZ = True</code>. Rails ActiveRecord converts to UTC in the database. Regardless of framework, migrations should document whether legacy tables store epoch integers or native datetime types — mixed schemas are common in long-lived products and cause integration pain during analytics exports.</p>

    <h2>Timestamps in APIs and JSON</h2>
    <p>JSON has no native datetime type. APIs typically return either ISO 8601 strings (<code>"2024-01-15T14:30:00Z"</code>) or numeric epochs. ISO strings are human-readable in network traces; epochs are compact and sort lexicographically when formatted as fixed-width integers in logs. Stripe, GitHub, and many webhook providers use Unix seconds in event payloads. JavaScript ecosystems often prefer milliseconds in <code>Date</code> constructors.</p>
    <p>When designing APIs, pick one format and document it. If you accept both, validate carefully — a client sending milliseconds where you expect seconds corrupts data silently. Include examples in OpenAPI schemas. For GraphQL, use custom scalars (<code>DateTime</code>) backed by consistent serialization rules.</p>

    <h2>Timestamps in Logs, Monitoring, and Debugging</h2>
    <p>Server logs frequently interleave ISO timestamps with epoch values from different subsystems. When correlating a user report ("error at 3:15 PM") with log lines stored in UTC epoch seconds, conversion tools bridge the gap. Distributed tracing systems like Jaeger and Zipkin use high-resolution timestamps — sometimes nanoseconds — for span ordering; know your tool's precision before comparing to second-granularity database records.</p>
    <p>Monitoring alerts often threshold on epoch values: certificate expiry, token <code>exp</code> claims, scheduled job <code>run_at</code> columns. Paste suspicious values into a converter to verify whether a job failed because of a timezone misconfiguration or an actual scheduling error.</p>

    <h2>JWT, OAuth, and Token Expiry Claims</h2>
    <p>JSON Web Tokens carry <code>iat</code> (issued at) and <code>exp</code> (expiration) claims as NumericDate values — Unix seconds since epoch, per RFC 7519. When a token appears valid but API calls return 401, decode the payload (Base64URL — use our JWT decoder tool) and convert <code>exp</code> to human time. Clock skew between servers can cause edge-case failures if leeway is not configured; compare token times against NTP-synchronized server clocks.</p>
    <p>OAuth authorization servers return <code>expires_in</code> as a duration in seconds from issuance, not an absolute timestamp. Add it to <code>iat</code> to compute wall-clock expiry. Refresh token rotations depend on accurate time math — document token lifetimes in runbooks and test near-boundary conditions.</p>

    <h2>Historical Limits and the Year 2038 Problem</h2>
    <p>32-bit signed integers max out at 2,147,483,647 — which corresponds to 2038-01-19 03:14:07 UTC when interpreted as Unix seconds. Legacy systems still using 32-bit <code>time_t</code> face the Year 2038 problem. Modern 64-bit platforms extended the range practically indefinitely for application purposes. When maintaining embedded or legacy C code, audit integer widths. Millisecond timestamps in JavaScript numbers are safe until far-future precision limits of IEEE 754 doubles — a separate concern from 32-bit seconds overflow.</p>

    <h2>ISO 8601 and Alternative Formats</h2>
    <p>ISO 8601 (<code>2024-07-06T15:30:00+05:00</code>) embeds timezone offsets explicitly and is preferred for human-facing APIs and configuration files. RFC 3339 is a profile of ISO 8601 common in internet protocols. When converting between ISO strings and epochs, parsers must respect offsets — a datetime with <code>+05:00</code> is five hours earlier in UTC than the same local clock reading in New York. Never assume a string without offset is UTC unless your API contract says so.</p>

    <h2>Privacy and Security</h2>
    <p>Timestamp values alone rarely identify individuals, but combined with user IDs in support tickets they can reconstruct activity timelines. ToolsFree.org converts timestamps locally in your browser without uploading values. For production debugging, redact user identifiers when sharing converted times in public forums.</p>

    <div class="row mt-4 g-4">
        <div class="col-md-6">
            <div class="tool-info-card">
                <h3>When to convert epoch to date</h3>
                <ul>
                    <li>Debugging API responses with numeric <code>created_at</code> fields</li>
                    <li>Reading JWT <code>exp</code> and <code>iat</code> claims during auth troubleshooting</li>
                    <li>Correlating log epoch lines with user-reported incident times</li>
                    <li>Verifying database migration results for datetime columns</li>
                    <li>Inspecting webhook payloads from Stripe, GitHub, or Slack</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tool-info-card">
                <h3>When to convert date to epoch</h3>
                <ul>
                    <li>Writing test fixtures with absolute instants for unit tests</li>
                    <li>Building cache TTL and session expiry configuration values</li>
                    <li>Preparing SQL or NoSQL queries filtering by time range</li>
                    <li>Documenting scheduled job run times in UTC for runbooks</li>
                    <li>Generating sample data for API documentation examples</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tool-faq mt-4">
        <h3>Frequently asked questions</h3>
        <details class="tool-faq-item">
            <summary>Are my timestamp values sent to a server?</summary>
            <p>No. All conversion happens entirely in your browser using JavaScript Date APIs. Your values never leave your device.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Should I use seconds or milliseconds?</summary>
            <p>Unix tradition and most server-side APIs use seconds. JavaScript <code>Date.now()</code> and many mobile SDKs use milliseconds. Check your API documentation. If a 13-digit number looks like milliseconds, divide by 1000 for second-based systems.</p>
        </details>
        <details class="tool-faq-item">
            <summary>What timezone does the converter display?</summary>
            <p>Decoded timestamps show UTC (the absolute instant) and your browser's local timezone for convenience. Storage and APIs should standardize on UTC to avoid ambiguity.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Why does my converted date differ from the database by one hour?</summary>
            <p>Daylight saving time, incorrect timezone configuration on the server, or storing local time without offset information causes one-hour (or more) drift. Audit whether values are UTC end-to-end and whether ORM settings match database session timezones.</p>
        </details>
        <details class="tool-faq-item">
            <summary>What is the maximum Unix timestamp?</summary>
            <p>On 64-bit systems using signed 64-bit seconds, the representable range extends far beyond practical human dates. Legacy 32-bit systems overflow in 2038. Millisecond values in JavaScript are limited by floating-point precision for extremely distant dates.</p>
        </details>
    </div>
</section>
