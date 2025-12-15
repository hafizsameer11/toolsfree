@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="hero mb-5">
        <div>
            <h1 class="hero-title">
                Professional Free Online Tools for
                <span class="hero-gradient">Developers, Designers & Digital Creators</span>
            </h1>
            <p class="hero-subtitle">
                Transform your workflow with our comprehensive suite of free online tools. Format and validate JSON data, 
                encode and decode URLs, convert colors between HEX and RGB, perform unit conversions, and generate 
                cryptographically secure passwords – all in one powerful, privacy-focused platform at <strong>ToolsFree.org</strong>.
            </p>

            <div class="hero-badges">
                <span class="badge">✓ No Registration Required</span>
                <span class="badge">✓ Lightning Fast Performance</span>
                <span class="badge">✓ 100% Privacy Protected</span>
                <span class="badge">✓ Mobile Optimized</span>
            </div>

            <div class="hero-cta">
                <a href="{{ route('tools.json') }}" class="button-primary">
                    Start Using Tools Now
                    <span>→</span>
                </a>
                <a href="{{ route('blog.index') }}" class="button-secondary">
                    Explore Our Blog
                </a>
            </div>
        </div>
        <div class="card">
            <h2 style="font-size: 1.3rem; margin-bottom: 1rem; font-weight: 700; color: var(--text-primary);">
                🚀 Most Popular Developer Tools
            </h2>
            <div class="tools-grid">
                <article class="tool-card">
                    <h3>JSON Formatter & Validator</h3>
                    <p>Professional JSON beautifier and validator with syntax highlighting. Instantly format, minify, and validate JSON data with detailed error messages for API development and debugging.</p>
                    <div class="tool-meta">
                        <span>🔧 API Development</span>
                        <a href="{{ route('tools.json') }}" class="tool-link">Try JSON Tool ↗</a>
                    </div>
                </article>
                <article class="tool-card">
                    <h3>URL Encoder & Decoder</h3>
                    <p>Encode and decode URLs, query strings, and URI components. Essential for web development, marketing campaigns, and creating safe, shareable links.</p>
                    <div class="tool-meta">
                        <span>🌐 Web Development</span>
                        <a href="{{ route('tools.url') }}" class="tool-link">Open URL Tool ↗</a>
                    </div>
                </article>
                <article class="tool-card">
                    <h3>HEX to RGB Color Converter</h3>
                    <p>Convert between HEX, RGB, and HSL color formats instantly. Perfect for designers, developers, and anyone working with web colors and CSS styling.</p>
                    <div class="tool-meta">
                        <span>🎨 Design & UI/UX</span>
                        <a href="{{ route('tools.color') }}" class="tool-link">Convert Colors ↗</a>
                    </div>
                </article>
                <article class="tool-card">
                    <h3>Universal Unit Converter</h3>
                    <p>Convert between length, weight, volume, temperature, area, speed, and more. Supports metric, imperial, and specialized units for professional use.</p>
                    <div class="tool-meta">
                        <span>📏 Measurements</span>
                        <a href="{{ route('tools.unit') }}" class="tool-link">Convert Units ↗</a>
                    </div>
                </article>
                <article class="tool-card">
                    <h3>Secure Password Generator</h3>
                    <p>Generate strong, cryptographically secure passwords with customizable length and character sets. Includes real-time password strength analysis.</p>
                    <div class="tool-meta">
                        <span>🔒 Security</span>
                        <a href="{{ route('tools.password') }}" class="tool-link">Generate Password ↗</a>
                    </div>
                </article>
            </div>
        </div>
    </div>

    {{-- Key Features Section --}}
    <section class="mb-5">
        <div class="card" style="text-align: center; margin-bottom: 2rem;">
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary);">
                Why Choose ToolsFree.org?
            </h2>
            <p style="font-size: 1.1rem; color: var(--text-secondary); max-width: 800px; margin: 0 auto;">
                We've built the most comprehensive, user-friendly suite of online tools for developers, designers, 
                marketers, and digital professionals. Here's what makes us different.
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">⚡</div>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">Lightning-Fast Performance</h3>
                    <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                        Our JSON Formatter, URL Encoder, Color Converter, Unit Converter, and Password Generator 
                        are optimized for instant results. All processing happens client-side in your browser, 
                        ensuring maximum speed and privacy. No server delays, no waiting – just instant results 
                        every time you use our tools.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">🔒</div>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">Complete Privacy Protection</h3>
                    <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                        Your data never leaves your device. We don't store, log, or transmit any information you 
                        process through our tools. Whether you're formatting sensitive JSON API responses, encoding 
                        confidential URLs, or generating passwords for critical systems, your data remains 100% 
                        private and secure.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">📱</div>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">Fully Mobile Responsive</h3>
                    <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                        Work seamlessly across all devices – desktop computers, tablets, and smartphones. Our 
                        responsive design ensures that whether you're debugging JSON on your laptop, converting 
                        colors on your iPad, or generating passwords on your phone, you get the same powerful, 
                        intuitive experience.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Detailed Tool Descriptions --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                Comprehensive Tool Suite for Every Professional Need
            </h2>
            
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; font-weight: 700; color: #667eea;">
                    🔧 JSON Formatter & Validator – Professional API Development Tool
                </h3>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                    Our advanced JSON formatter is the go-to tool for developers working with REST APIs, GraphQL, 
                    configuration files, and data interchange formats. Simply paste your JSON data and instantly 
                    beautify it with proper indentation and syntax highlighting. The built-in validator catches 
                    common errors like missing commas, unclosed brackets, invalid escape sequences, and duplicate 
                    keys, providing clear error messages with line numbers for quick debugging.
                </p>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8;">
                    <strong>Key Features:</strong> Beautify/Pretty-print JSON, Minify JSON for production, 
                    Validate JSON syntax, Syntax error detection with line numbers, Support for large JSON files, 
                    Copy formatted output with one click, Dark mode support for comfortable viewing.
                </p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; font-weight: 700; color: #667eea;">
                    🌐 URL Encoder & Decoder – Essential Web Development Utility
                </h3>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                    Perfect for web developers, digital marketers, and SEO professionals, our URL encoder/decoder 
                    handles all your URL encoding needs. Encode special characters, spaces, and symbols to create 
                    valid URLs for query parameters, API endpoints, and shareable links. Decode encoded URLs to 
                    read and understand complex query strings and parameters.
                </p>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8;">
                    <strong>Use Cases:</strong> Encode URLs for email marketing campaigns, Decode tracking URLs 
                    from analytics platforms, Prepare query strings for API requests, Create safe redirect URLs, 
                    Handle international characters in URLs, Debug webhook endpoints and callbacks.
                </p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; font-weight: 700; color: #667eea;">
                    🎨 HEX to RGB Color Converter – Designer's Essential Tool
                </h3>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                    Streamline your design workflow with instant color format conversions. Convert between HEX 
                    color codes (like #667eea), RGB values (rgb(102, 126, 234)), and HSL formats. Perfect for 
                    web designers, UI/UX professionals, graphic designers, and frontend developers working with 
                    CSS, design systems, and brand guidelines.
                </p>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8;">
                    <strong>Features:</strong> Instant HEX to RGB conversion, RGB to HEX conversion, Visual color 
                    preview, Copy color codes with one click, Support for alpha channel/transparency, Color palette 
                    generation, Accessibility contrast checking.
                </p>
            </div>

            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; font-weight: 700; color: #667eea;">
                    📏 Universal Unit Converter – Comprehensive Measurement Tool
                </h3>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                    Convert between hundreds of units across multiple categories. Our unit converter handles 
                    length (meters, feet, inches, kilometers, miles), weight (kilograms, pounds, ounces, grams), 
                    volume (liters, gallons, milliliters, cups), temperature (Celsius, Fahrenheit, Kelvin), area, 
                    speed, pressure, energy, and more. Essential for engineers, scientists, students, and 
                    international professionals.
                </p>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8;">
                    <strong>Supported Conversions:</strong> Length (metric & imperial), Weight/Mass, Volume/Capacity, 
                    Temperature, Area, Speed/Velocity, Pressure, Energy, Power, Time, Data storage (bytes, KB, MB, GB).
                </p>
            </div>

            <div>
                <h3 style="font-size: 1.3rem; margin-bottom: 0.75rem; font-weight: 700; color: #667eea;">
                    🔒 Secure Password Generator – Advanced Security Tool
                </h3>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                    Generate cryptographically secure passwords for your accounts, databases, API keys, and 
                    applications. Customize password length (6-64 characters), include or exclude uppercase 
                    letters, lowercase letters, numbers, and special symbols. Our real-time password strength 
                    analyzer helps you create passwords that meet security requirements for banking, enterprise 
                    systems, and high-security applications.
                </p>
                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8;">
                    <strong>Security Features:</strong> Cryptographically secure random generation, Customizable 
                    character sets, Real-time strength analysis (weak to very strong), Password length control, 
                    One-click copy to clipboard, No password storage or logging, Meets enterprise security standards.
                </p>
            </div>
        </div>
    </section>

    {{-- Use Cases Section --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                Who Uses ToolsFree.org? Real-World Applications
            </h2>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">👨‍💻 Software Developers & Engineers</h3>
                    <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                        <li>Debug and format JSON API responses from REST and GraphQL endpoints</li>
                        <li>Validate configuration files (package.json, tsconfig.json, etc.)</li>
                        <li>Encode URLs for webhook callbacks and OAuth redirects</li>
                        <li>Generate secure passwords for database users and API keys</li>
                        <li>Convert units for scientific calculations and data processing</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">🎨 Designers & Creative Professionals</h3>
                    <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                        <li>Convert HEX color codes to RGB for CSS and design tools</li>
                        <li>Extract and convert colors from brand guidelines</li>
                        <li>Create consistent color palettes across projects</li>
                        <li>Convert measurements for print and digital design</li>
                        <li>Generate secure passwords for design tool accounts</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">📊 Digital Marketers & SEO Specialists</h3>
                    <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                        <li>Encode URLs for email marketing campaigns and UTM parameters</li>
                        <li>Decode tracking URLs from Google Analytics and ad platforms</li>
                        <li>Format JSON data from marketing APIs and analytics tools</li>
                        <li>Create safe, shareable links for social media campaigns</li>
                        <li>Generate passwords for marketing tool accounts</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700;">🏢 Business Professionals & Students</h3>
                    <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                        <li>Convert units for international business (currency, measurements)</li>
                        <li>Generate secure passwords for business applications</li>
                        <li>Format and validate data files for analysis</li>
                        <li>Convert temperature, weight, and volume for recipes and projects</li>
                        <li>Encode URLs for presentations and documents</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Comparison Section --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                ToolsFree.org vs. Other Online Tool Platforms
            </h2>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                    <thead>
                        <tr style="background: rgba(102, 126, 234, 0.1); border-bottom: 2px solid #667eea;">
                            <th style="padding: 1rem; text-align: left; font-weight: 700;">Feature</th>
                            <th style="padding: 1rem; text-align: center; font-weight: 700; color: #667eea;">ToolsFree.org</th>
                            <th style="padding: 1rem; text-align: center; font-weight: 700;">Other Platforms</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
                            <td style="padding: 1rem;">No Registration Required</td>
                            <td style="padding: 1rem; text-align: center; color: #22c55e; font-weight: 700;">✓ Yes</td>
                            <td style="padding: 1rem; text-align: center; color: #ef4444;">✗ Often Required</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
                            <td style="padding: 1rem;">100% Free Forever</td>
                            <td style="padding: 1rem; text-align: center; color: #22c55e; font-weight: 700;">✓ Yes</td>
                            <td style="padding: 1rem; text-align: center; color: #ef4444;">✗ Freemium/Paid</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
                            <td style="padding: 1rem;">No Data Storage</td>
                            <td style="padding: 1rem; text-align: center; color: #22c55e; font-weight: 700;">✓ Yes</td>
                            <td style="padding: 1rem; text-align: center; color: #ef4444;">✗ May Store Data</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
                            <td style="padding: 1rem;">Mobile Optimized</td>
                            <td style="padding: 1rem; text-align: center; color: #22c55e; font-weight: 700;">✓ Yes</td>
                            <td style="padding: 1rem; text-align: center; color: #f59e0b;">~ Sometimes</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(148, 163, 184, 0.2);">
                            <td style="padding: 1rem;">No Ads Interruption</td>
                            <td style="padding: 1rem; text-align: center; color: #22c55e; font-weight: 700;">✓ Minimal</td>
                            <td style="padding: 1rem; text-align: center; color: #ef4444;">✗ Heavy Ads</td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem;">Fast Performance</td>
                            <td style="padding: 1rem; text-align: center; color: #22c55e; font-weight: 700;">✓ Lightning Fast</td>
                            <td style="padding: 1rem; text-align: center; color: #f59e0b;">~ Variable</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Blog Section --}}
    @if($latestPosts->isNotEmpty())
        <section class="mb-5">
            <div class="card" style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--text-primary);">
                    📚 Latest Articles from Our Blog
                </h2>
                <p style="font-size: 1rem; color: var(--text-secondary);">
                    Learn best practices, tips, and tutorials for using online development tools effectively
                </p>
            </div>
            <div class="blog-list">
                @foreach($latestPosts as $post)
                    <article class="blog-card">
                        <h2>
                            <a href="{{ route('blog.show', $post->slug) }}" class="tool-link">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <div class="blog-card-meta">
                            📅 {{ optional($post->published_at)->format('F d, Y') ?? 'Draft' }}
                        </div>
                        @if($post->excerpt)
                            <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                                {{ $post->excerpt }}
                            </p>
                        @endif>
                    </article>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('blog.index') }}" class="button-primary">
                    View All Articles →
                </a>
            </div>
        </section>
    @endif

    {{-- Comprehensive FAQ Section --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                ❓ Frequently Asked Questions (FAQ)
            </h2>
            
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Is ToolsFree.org completely free to use?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    Yes, absolutely! All tools on ToolsFree.org are 100% free to use with no hidden costs, 
                    subscription fees, or premium tiers. You don't need to create an account, provide credit card 
                    information, or pay anything to access our JSON formatter, URL encoder, color converter, unit 
                    converter, or password generator. The site is supported by privacy-friendly, non-intrusive 
                    advertising that doesn't interfere with your work.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Do you store or log the data I process through your tools?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    No, we never store, log, or transmit any data you process through our tools. All operations 
                    (JSON formatting, URL encoding/decoding, color conversion, unit conversion, and password 
                    generation) happen entirely in your browser using client-side JavaScript. Your sensitive JSON 
                    API responses, confidential URLs, and generated passwords never leave your device. This ensures 
                    complete privacy and security for all your data.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Can I use these tools on my mobile phone or tablet?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    Yes! ToolsFree.org is fully responsive and optimized for all devices including smartphones 
                    (iPhone, Android), tablets (iPad, Android tablets), and desktop computers. The interface 
                    automatically adapts to your screen size, providing an optimal experience whether you're 
                    formatting JSON on your laptop, converting colors on your tablet, or generating passwords on 
                    your phone. All features work seamlessly across devices.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    How accurate is the JSON validator and formatter?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    Our JSON validator uses the same parsing engine as modern web browsers, ensuring 100% accuracy 
                    in detecting syntax errors, missing commas, unclosed brackets, invalid escape sequences, and 
                    other common JSON formatting issues. The formatter properly handles nested objects, arrays, 
                    special characters, and Unicode, making it suitable for production use with REST APIs, GraphQL, 
                    and configuration files.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Are the generated passwords truly secure?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    Yes, our password generator uses cryptographically secure random number generation 
                    (window.crypto.getRandomValues() API) to create truly random passwords. The passwords are 
                    generated entirely in your browser and are never transmitted over the internet. With customizable 
                    length (up to 64 characters) and character sets (uppercase, lowercase, numbers, symbols), you 
                    can create passwords that meet even the strictest security requirements for banking, enterprise 
                    systems, and government applications.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    What units does the unit converter support?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    Our comprehensive unit converter supports hundreds of units across multiple categories: Length 
                    (meters, feet, inches, kilometers, miles, yards, centimeters, millimeters), Weight/Mass 
                    (kilograms, pounds, ounces, grams, tons), Volume (liters, gallons, milliliters, cups, pints, 
                    quarts), Temperature (Celsius, Fahrenheit, Kelvin), Area (square meters, square feet, acres, 
                    hectares), Speed (mph, km/h, m/s), Pressure, Energy, Power, Time, and Data Storage (bytes, KB, 
                    MB, GB, TB). Perfect for international professionals, engineers, and students.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Can I suggest new tools or features?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    Absolutely! We're constantly improving ToolsFree.org based on user feedback. If you have ideas 
                    for new tools (like Base64 encoder, Markdown converter, Hash generator, etc.) or improvements 
                    to existing tools, please reach out through our About or Privacy Policy pages. We actively 
                    consider all suggestions and regularly add new features based on community needs.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    Do I need to install any software or browser extensions?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    No installation required! ToolsFree.org works directly in your web browser without any downloads, 
                    installations, or browser extensions. Simply visit the website and start using any tool 
                    immediately. This makes it perfect for quick tasks, working on shared computers, or when you 
                    don't have permission to install software. Works with all modern browsers: Chrome, Firefox, 
                    Safari, Edge, and Opera.
                </p>
            </div>

            <div>
                <h3 style="font-size: 1.15rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    How often do you update and add new features?
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 0;">
                    We continuously update ToolsFree.org with new features, performance improvements, and bug fixes. 
                    Our development team regularly adds new tools based on user requests and industry trends. Follow 
                    our blog to stay updated on new releases, feature announcements, and best practices for using 
                    online development tools. We're committed to making ToolsFree.org the most comprehensive and 
                    user-friendly online tool platform available.
                </p>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="mb-5">
        <div class="card" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
            <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary);">
                Ready to Boost Your Productivity?
            </h2>
            <p style="font-size: 1.1rem; color: var(--text-secondary); margin-bottom: 2rem; max-width: 700px; margin-left: auto; margin-right: auto;">
                Join thousands of developers, designers, and professionals who use ToolsFree.org daily. 
                Start using our free online tools now – no registration required!
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('tools.json') }}" class="button-primary">
                    Try JSON Formatter →
                </a>
                <a href="{{ route('tools.password') }}" class="button-primary">
                    Generate Password →
                </a>
                <a href="{{ route('tools.color') }}" class="button-secondary" style="color: var(--text-primary); border-color: rgba(102, 126, 234, 0.5);">
                    Convert Colors →
                </a>
            </div>
        </div>
    </section>
@endsection


