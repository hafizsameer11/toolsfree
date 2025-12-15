@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="card mb-5" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary);">
            About ToolsFree.org
        </h1>
        <p style="font-size: 1.15rem; color: var(--text-secondary); max-width: 700px; margin: 0 auto; line-height: 1.7;">
            Your trusted platform for free, professional-grade online development tools. 
            Built by developers, for developers.
        </p>
    </div>

    {{-- Mission Section --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🎯 Our Mission
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                At ToolsFree.org, we believe that powerful development tools should be accessible to everyone, 
                regardless of budget or technical expertise. Our mission is to provide a comprehensive suite of 
                free, high-quality online tools that help developers, designers, marketers, and digital 
                professionals work more efficiently and effectively.
            </p>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8;">
                We're committed to maintaining a platform that respects your privacy, loads instantly, works 
                seamlessly across all devices, and never requires registration or payment. Every tool we build 
                is designed with user experience, performance, and security as top priorities.
            </p>
        </div>
    </section>

    {{-- What We Offer --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🛠️ What We Offer
            </h2>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div style="padding: 1.5rem; background: rgba(102, 126, 234, 0.05); border-radius: 12px; height: 100%;">
                        <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700; color: #667eea;">
                            💻 Developer Tools
                        </h3>
                        <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                            Professional JSON formatter and validator for API development, URL encoder/decoder for 
                            web development, and secure password generator for application security. All tools 
                            process data client-side for maximum privacy and speed.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1.5rem; background: rgba(118, 75, 162, 0.05); border-radius: 12px; height: 100%;">
                        <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700; color: #764ba2;">
                            🎨 Design Tools
                        </h3>
                        <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                            HEX to RGB color converter with visual preview for designers and frontend developers. 
                            Instantly convert between color formats, copy values with one click, and maintain 
                            consistency across your design systems and brand guidelines.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1.5rem; background: rgba(79, 172, 254, 0.05); border-radius: 12px; height: 100%;">
                        <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700; color: #4facfe;">
                            📏 Conversion Tools
                        </h3>
                        <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                            Comprehensive unit converter supporting length, weight, volume, temperature, area, 
                            speed, and more. Perfect for international professionals, engineers, scientists, and 
                            anyone working with different measurement systems.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1.5rem; background: rgba(240, 147, 251, 0.05); border-radius: 12px; height: 100%;">
                        <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; font-weight: 700; color: #f093fb;">
                            📚 Educational Content
                        </h3>
                        <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                            Regularly updated blog with tutorials, best practices, and tips for using online 
                            development tools effectively. Learn how to optimize your workflow, improve security, 
                            and work more efficiently with our comprehensive guides.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Values --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                ✨ Our Core Values
            </h2>
            
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    🔒 Privacy First
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    All tools process data entirely in your browser using client-side JavaScript. We never store, 
                    log, or transmit your data to our servers. Your JSON payloads, URLs, passwords, and other 
                    sensitive information remain completely private and secure on your device.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    ⚡ Performance Optimized
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    We obsess over performance. Our tools load instantly, process data in milliseconds, and work 
                    smoothly even on slower connections. No heavy frameworks, no unnecessary dependencies – just 
                    clean, efficient code that gets the job done fast.
                </p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    🌍 Accessibility for All
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    No registration, no payment, no barriers. We believe powerful tools should be available to 
                    everyone, from students learning to code to enterprise developers building production systems. 
                    Our platform is 100% free and always will be.
                </p>
            </div>

            <div>
                <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem; font-weight: 700; color: #667eea;">
                    📱 Mobile-First Design
                </h3>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 0;">
                    In today's mobile world, you need tools that work anywhere. Every feature on ToolsFree.org 
                    is fully responsive and optimized for smartphones, tablets, and desktop computers. Format 
                    JSON on your phone, convert colors on your tablet, generate passwords on your laptop – it 
                    all works seamlessly.
                </p>
            </div>
        </div>
    </section>

    {{-- Technology Stack --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                ⚙️ Technology & Architecture
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                ToolsFree.org is built with modern web technologies and best practices:
            </p>
            <ul style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.8; padding-left: 1.5rem;">
                <li><strong>Frontend:</strong> Vanilla JavaScript for maximum performance and minimal dependencies</li>
                <li><strong>Backend:</strong> Laravel 11 PHP framework for robust, scalable architecture</li>
                <li><strong>Design:</strong> Custom CSS with modern features like CSS Grid, Flexbox, and CSS Variables</li>
                <li><strong>Security:</strong> HTTPS encryption, Content Security Policy, and client-side processing</li>
                <li><strong>Performance:</strong> Optimized assets, lazy loading, and efficient caching strategies</li>
                <li><strong>Hosting:</strong> Designed to work perfectly on shared hosting for maximum accessibility</li>
            </ul>
        </div>
    </section>

    {{-- Future Plans --}}
    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.8rem; margin-bottom: 1.5rem; font-weight: 700; color: var(--text-primary);">
                🚀 Future Plans
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                We're constantly working to improve ToolsFree.org and add new features. Here's what's coming:
            </p>
            <div class="row g-3">
                <div class="col-md-6">
                    <div style="padding: 1rem; background: rgba(102, 126, 234, 0.05); border-radius: 8px;">
                        <strong style="color: #667eea;">📝 New Tools</strong>
                        <p style="font-size: 0.9rem; color: var(--text-secondary); margin: 0.5rem 0 0 0;">
                            Base64 encoder/decoder, Markdown to HTML converter, Hash generator (MD5, SHA), 
                            Image optimizer, and more based on community requests.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1rem; background: rgba(118, 75, 162, 0.05); border-radius: 8px;">
                        <strong style="color: #764ba2;">✨ Enhanced Features</strong>
                        <p style="font-size: 0.9rem; color: var(--text-secondary); margin: 0.5rem 0 0 0;">
                            Dark mode support, keyboard shortcuts, batch processing, export/import 
                            functionality, and advanced formatting options.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1rem; background: rgba(79, 172, 254, 0.05); border-radius: 8px;">
                        <strong style="color: #4facfe;">🌐 API Access</strong>
                        <p style="font-size: 0.9rem; color: var(--text-secondary); margin: 0.5rem 0 0 0;">
                            RESTful API for programmatic access to our tools, enabling integration 
                            with your applications and automation workflows.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1rem; background: rgba(240, 147, 251, 0.05); border-radius: 8px;">
                        <strong style="color: #f093fb;">📱 Mobile Apps</strong>
                        <p style="font-size: 0.9rem; color: var(--text-secondary); margin: 0.5rem 0 0 0;">
                            Native iOS and Android apps for offline access and enhanced mobile 
                            experience with device-specific optimizations.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact & Feedback --}}
    <section class="mb-5">
        <div class="card" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
            <h2 style="font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                💬 Get in Touch
            </h2>
            <p style="font-size: 1.05rem; color: var(--text-secondary); margin-bottom: 1.5rem; max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.7;">
                We love hearing from our users! Whether you have suggestions for new tools, feedback on 
                existing features, bug reports, or just want to say hello, we're here to listen.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('blog.index') }}" class="button-primary">
                    Read Our Blog →
                </a>
                <a href="{{ route('home') }}" class="button-secondary" style="color: var(--text-primary); border-color: rgba(102, 126, 234, 0.5);">
                    Try Our Tools →
                </a>
            </div>
        </div>
    </section>
@endsection
