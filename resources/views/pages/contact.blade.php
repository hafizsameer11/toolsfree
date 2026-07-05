@extends('layouts.app')

@section('content')
    <div class="card mb-5" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary);">
            Contact ToolsFree.org
        </h1>
        <p style="font-size: 1.15rem; color: var(--text-secondary); max-width: 700px; margin: 0 auto; line-height: 1.7;">
            We'd love to hear from you. Send feedback, report bugs, suggest new tools, or ask questions about our platform.
        </p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-7">
            <div class="card">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.25rem; color: var(--text-primary);">
                    Send us a message
                </h2>
                <form action="mailto:contact@toolsfree.org" method="post" enctype="text/plain" class="contact-form">
                    <div class="mb-3">
                        <label class="form-label" for="contact-name">Your name</label>
                        <input type="text" id="contact-name" name="name" class="tool-input" required placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact-email">Email address</label>
                        <input type="email" id="contact-email" name="email" class="tool-input" required placeholder="you@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact-subject">Subject</label>
                        <select id="contact-subject" name="subject" class="form-select tool-select">
                            <option value="General inquiry">General inquiry</option>
                            <option value="Bug report">Bug report</option>
                            <option value="Feature suggestion">Feature suggestion</option>
                            <option value="Content feedback">Content / SEO feedback</option>
                            <option value="Partnership">Partnership / advertising</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact-message">Message</label>
                        <textarea id="contact-message" name="message" class="tool-textarea" rows="6" required placeholder="Tell us what's on your mind…"></textarea>
                    </div>
                    <button type="submit" class="button-primary">Send message →</button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card mb-4">
                <h2 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                    📬 Direct contact
                </h2>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 0.75rem;">
                    Email us directly at:
                </p>
                <p style="font-size: 1.05rem; margin-bottom: 0;">
                    <a href="mailto:contact@toolsfree.org" class="tool-link">contact@toolsfree.org</a>
                </p>
            </div>
            <div class="card mb-4">
                <h2 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                    💡 Suggest a new tool
                </h2>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7;">
                    We're always expanding ToolsFree.org based on community needs. Popular requests include Base64 encoder/decoder, 
                    Markdown preview, hash generators (MD5, SHA-256), text diff tools, and cron expression builders. 
                    Tell us what would help your workflow most.
                </p>
            </div>
            <div class="card">
                <h2 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                    ⏱ Response time
                </h2>
                <p style="font-size: 0.95rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 0;">
                    We typically respond within 2–3 business days. For urgent security issues related to our website, 
                    please include "SECURITY" in your subject line for priority handling.
                </p>
            </div>
        </div>
    </div>

    <section class="mb-5">
        <div class="card">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                About ToolsFree.org
            </h2>
            <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem;">
                ToolsFree.org is a free online platform offering professional-grade developer and productivity tools. 
                Our mission is to provide fast, privacy-friendly utilities that work entirely in your browser — 
                no registration, no data collection, no cost. We serve developers, designers, marketers, students, 
                and anyone who needs reliable online tools for everyday digital work.
            </p>
            <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 0;">
                Our current tool suite includes a JSON formatter and validator, URL encoder and decoder, HEX/RGB/HSL color converter, 
                comprehensive unit converter, and cryptographically secure password generator. We also maintain an educational blog 
                with in-depth guides on web development, API design, security, and tool usage best practices.
            </p>
        </div>
    </section>
@endsection
