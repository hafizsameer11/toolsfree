<section class="tool-content-section">
    <h2>Complete Guide to JWT Decoding, Claims, and OAuth Token Inspection</h2>
    <p>JSON Web Tokens (JWTs) power authentication and authorization across modern web applications. OpenID Connect identity layers, OAuth 2.0 access tokens, microservice session cookies, and single sign-on portals all serialize identity and permission data into compact, URL-safe strings that clients attach to API requests. A JWT looks opaque at first glance — three Base64URL-encoded segments separated by dots — but the header and payload are only encoded, not encrypted. Understanding how to decode and read JWT claims is essential for debugging login failures, verifying token expiry, and auditing what your applications expose to browsers and mobile clients.</p>
    <p>ToolsFree.org provides a fast, privacy-focused <strong>JWT decoder</strong> that parses tokens entirely in your browser. Paste a JWT to inspect its header and payload JSON, view standard claims like <code>exp</code> and <code>iat</code>, and understand structure without sending tokens to a server. This page explains JWT anatomy, OAuth relationships, claim semantics, and safe debugging practices — not signature verification against secrets, which must remain on trusted servers.</p>

    <h2>What Is a JSON Web Token?</h2>
    <p>A JWT is a compact serialization format defined in RFC 7519. It consists of three parts: <strong>header</strong>, <strong>payload</strong>, and <strong>signature</strong>, joined by periods (<code>.</code>). The header typically declares the signing algorithm (<code>alg</code>) and token type (<code>typ</code>, usually <code>JWT</code>). The payload contains <strong>claims</strong> — JSON key-value pairs asserting facts about the subject, issuer, audience, and validity window. The signature proves integrity: only parties holding the secret or private key could have produced a valid signature for that header and payload.</p>
    <p>Encoding uses Base64URL, a URL-safe variant without padding that replaces <code>+</code> and <code>/</code> with <code>-</code> and <code>_</code>. Decoding is reversible with standard libraries — which means anyone who possesses the token string can read the payload. Never put confidential data in JWT payloads unless you additionally encrypt the token (JWE) or accept that the data is visible to the client.</p>

    <h2>How to Use This JWT Decoder Step by Step</h2>
    <p>Paste the complete JWT string into the input field — all three segments, including dots. The tool decodes the header and payload into formatted JSON for inspection. Review the <code>alg</code> field first: unexpected algorithms (especially <code>none</code> or asymmetric algorithms you did not configure) can indicate misconfiguration or attack attempts in poorly validated servers.</p>
    <p>Check temporal claims next. Compare <code>exp</code> (expiration) against the current time using a timestamp converter if needed. Verify <code>iss</code> (issuer) and <code>aud</code> (audience) match your expected authorization server and API identifier. Use <strong>Copy</strong> to export decoded JSON for support tickets — after redacting sensitive claims. Use <strong>Clear</strong> when finished so tokens do not linger in browser memory longer than necessary on shared machines.</p>

    <h2>Standard Registered Claims</h2>
    <p>RFC 7519 defines registered claim names with recommended semantics. <strong>iss (issuer)</strong> identifies who minted the token — your Auth0 tenant URL, Cognito user pool, or corporate Keycloak realm. <strong>sub (subject)</strong> identifies the user or principal, often an opaque user ID. <strong>aud (audience)</strong> names the intended recipients; APIs should reject tokens whose audience does not include their identifier.</p>
    <p><strong>exp (expiration time)</strong> is a NumericDate — Unix seconds since epoch — after which the token must not be accepted. <strong>nbf (not before)</strong> rejects tokens used too early, useful for clock skew tolerance windows. <strong>iat (issued at)</strong> records mint time and helps detect stale tokens or replay in combination with revocation lists. <strong>jti (JWT ID)</strong> provides a unique token identifier for one-time use or revocation tracking.</p>
    <p>Missing <code>exp</code> on access tokens is a security smell — always configure bounded lifetimes. Refresh tokens may live longer but should be stored server-side or in httpOnly cookies, not localStorage, when possible.</p>

    <h2>Public vs. Private Claims</h2>
    <p>Beyond registered claims, applications add <strong>private claims</strong> — custom fields like <code>roles</code>, <code>permissions</code>, <code>tenant_id</code>, or <code>email</code>. OAuth providers and identity platforms embed profile attributes in ID tokens (OpenID Connect) while access tokens carry scopes and resource permissions. Name collisions are avoided by using namespaced keys (<code>https://example.com/roles</code>) in federated scenarios.</p>
    <p>When debugging authorization bugs, compare decoded claims against your policy engine's expectations. A user missing a <code>admin: true</code> claim might pass authentication but fail authorization middleware. Logging decoded claims in development (never production secrets) accelerates triage.</p>

    <h2>JWT Algorithms: HS256, RS256, and Beyond</h2>
    <p><strong>HMAC algorithms (HS256, HS384, HS512)</strong> use a shared secret. The same secret signs and verifies. Simple for monoliths but difficult to rotate across many microservices without distributing secrets widely.</p>
    <p><strong>RSA and ECDSA algorithms (RS256, ES256)</strong> use public/private key pairs. The authorization server signs with a private key; APIs verify with published public keys from a JWKS (JSON Web Key Set) endpoint. This scales better for multi-service architectures and enables key rotation without redeploying every consumer.</p>
    <p>The historic <code>alg: none</code> attack exploited servers that accepted unsigned tokens. Modern libraries reject <code>none</code> by default. Always validate algorithms against an allowlist on the server — decoding locally for inspection does not replace verification.</p>

    <h2>JWT in OAuth 2.0 and OpenID Connect</h2>
    <p>OAuth 2.0 defines authorization flows (authorization code with PKCE for SPAs, client credentials for machine-to-machine, device code for TVs). Access tokens may be opaque strings or JWTs depending on the authorization server. When JWT-shaped, they carry scopes in a <code>scope</code> claim or space-delimited string and expire quickly (minutes to hours).</p>
    <p>OpenID Connect adds an <strong>ID token</strong> — always a JWT — proving authentication events. ID tokens include <code>auth_time</code>, <code>nonce</code> (bound to the authorization request for replay protection), and profile claims (<code>email</code>, <code>name</code>). Clients must validate ID token signatures against the provider's JWKS, check <code>nonce</code>, and verify <code>aud</code> matches the client ID.</p>
    <p>Refresh tokens are often opaque and long-lived; decoding applies primarily to access and ID tokens. When an API returns 401, decode the access token: if <code>exp</code> passed, refresh the session; if claims look correct, investigate server-side clock skew or wrong signing keys after rotation.</p>

    <h2>Decoding vs. Verifying: Critical Distinction</h2>
    <p>Decoding parses Base64URL and displays JSON. <strong>Anyone can decode any JWT without secrets.</strong> Verification cryptographically validates the signature using the correct secret or public key and checks claims (<code>exp</code>, <code>aud</code>, <code>iss</code>). Only verification establishes trust. Browser-based decoder tools are for development debugging — production APIs must verify on every request before trusting claims.</p>
    <p>Never paste production tokens with live privileges into untrusted online verifiers that send tokens to remote servers. ToolsFree.org keeps decoding local. Still treat decoded output as sensitive: emails, roles, and internal IDs may appear in payloads.</p>

    <h2>Common JWT Debugging Scenarios</h2>
    <p><strong>Token expired immediately:</strong> Check <code>exp</code> and server clock sync (NTP). Confirm timezone confusion did not shorten lifetimes in configuration UI measured in minutes versus hours.</p>
    <p><strong>Invalid audience:</strong> API expects <code>aud: api://my-service</code> but token carries only client ID. Align resource server configuration with authorization server audience settings.</p>
    <p><strong>Algorithm mismatch after key rotation:</strong> APIs cache JWKS keys; stale cache rejects valid tokens. Flush cache or implement kid (key ID) header matching per RFC 7517.</p>
    <p><strong>Missing scopes:</strong> Access token decodes cleanly but lacks <code>read:orders</code>. Trace authorization grant and scope approval in the OAuth consent step.</p>

    <h2>Storage, XSS, and Token Exposure</h2>
    <p>SPAs storing access tokens in localStorage risk XSS exfiltration — any injected script reads tokens. HttpOnly cookies mitigate JavaScript access but require CSRF protections. Mobile apps use secure enclaves and keychains. Decoding helps incident response: if a token leaked, inspect <code>exp</code> to know when it becomes useless and whether <code>jti</code> supports revocation.</p>

    <h2>JWT vs. Session Cookies vs. PASETO</h2>
    <p>Classic server sessions store state server-side with a session ID cookie. JWTs push claims to the client, reducing database lookups but complicating revocation. PASETO is an alternative token format designed with safer defaults (no algorithm agility confusion). JWT remains dominant due to ecosystem support in Kong, AWS, Azure AD, Google, and every major framework middleware package.</p>

    <h2>Privacy and Safe Handling</h2>
    <p>Tokens are credentials. Decode locally on ToolsFree.org without network transmission. Redact tokens and payloads before screenshots. Rotate secrets if tokens appear in public issue trackers. Clear the decoder after use on shared workstations.</p>

    <div class="row mt-4 g-4">
        <div class="col-md-6">
            <div class="tool-info-card">
                <h3>Claims to inspect first</h3>
                <ul>
                    <li><code>exp</code> — confirm the token is still valid</li>
                    <li><code>iat</code> — when the token was issued</li>
                    <li><code>iss</code> — matches your identity provider</li>
                    <li><code>aud</code> — matches your API resource identifier</li>
                    <li><code>sub</code> — maps to the expected user or service principal</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tool-info-card">
                <h3>When to decode JWTs in development</h3>
                <ul>
                    <li>Debugging 401/403 responses from protected API routes</li>
                    <li>Verifying OAuth scope and role claims after login changes</li>
                    <li>Teaching JWT structure in workshops and documentation</li>
                    <li>Comparing ID token profile claims across OIDC providers</li>
                    <li>Validating custom claims from identity platform rule engines</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tool-faq mt-4">
        <h3>Frequently asked questions</h3>
        <details class="tool-faq-item">
            <summary>Is my JWT sent to your servers when I decode it?</summary>
            <p>No. Decoding happens entirely in your browser by splitting the token and Base64URL-decoding the header and payload. Your token never leaves your device.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Does this tool verify the JWT signature?</summary>
            <p>No. This tool decodes and displays header and payload for inspection only. Signature verification requires secrets or public keys and must run on your trusted backend or authorized development environment.</p>
        </details>
        <details class="tool-faq-item">
            <summary>What are exp and iat in a JWT?</summary>
            <p><code>exp</code> is expiration time as Unix seconds — after this instant the token should be rejected. <code>iat</code> is issued-at time — when the token was created. Both are NumericDate values per RFC 7519.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Can I decode JWTs without the secret key?</summary>
            <p>Yes. Payload and header are only Base64URL-encoded, not encrypted. Anyone with the token string can read claims. Protect tokens in transit and storage; do not rely on encoding for confidentiality.</p>
        </details>
        <details class="tool-faq-item">
            <summary>Why does my API reject a token that decodes correctly?</summary>
            <p>Common causes: expired <code>exp</code>, wrong <code>aud</code> or <code>iss</code>, invalid signature, algorithm mismatch, clock skew, or revoked <code>jti</code>. Decoding shows claims; server logs and verification steps pinpoint the failure.</p>
        </details>
    </div>
</section>
