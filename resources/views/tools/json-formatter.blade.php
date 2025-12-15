@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2" style="color: #ffffff !important;">JSON Formatter &amp; Validator</h1>
        <p class="text-muted">
            Paste your JSON below and use the buttons to beautify, minify, validate and copy the result.
        </p>
    </div>

    <div class="card mb-4">
        <div class="tool-actions">
            <button class="btn btn-primary btn-sm" id="json-beautify">Beautify</button>
            <button class="btn btn-outline-secondary btn-sm" id="json-minify">Minify</button>
            <button class="btn btn-outline-success btn-sm" id="json-validate">Validate</button>
            <button class="btn btn-outline-secondary btn-sm" id="json-copy">Copy</button>
            <span class="chip">Client-side only</span>
        </div>
        <textarea id="json-input" class="tool-textarea" placeholder='{"example": true}'></textarea>
        <div id="json-status" class="json-success d-none"></div>
        <div id="json-error" class="json-error d-none"></div>
    </div>
    <section class="mb-4">
        <h2 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: #ffffff !important;">How to use this online JSON formatter</h2>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            This <strong>online JSON formatter and validator</strong> is built for developers working with REST and JSON APIs.
            Paste any JSON response or request body into the editor, click <strong>Beautify</strong> to pretty‑print the data,
            or use <strong>Minify</strong> to compress it into a single compact line. The <strong>Validate</strong> button runs
            a JSON syntax check and shows a helpful error message if there is a missing comma, bracket or quote.
        </p>
        <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
            Because everything runs inside your browser, no JSON is sent to the server. That makes this JSON formatter safe
            for sensitive payloads such as access tokens, configuration files or test data. You can keep the page open while
            debugging APIs, pretty‑print responses from Postman or cURL, and copy cleaned JSON directly into your code.
        </p>
        <div class="row mt-3">
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem; color: #ffffff !important;">Common things you can do</h3>
                <ul style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9); padding-left: 1.1rem;">
                    <li>Reformat compact API responses into readable, indented JSON.</li>
                    <li>Minify configuration files before embedding them into HTML or JavaScript.</li>
                    <li>Validate JSON copied from documentation, ChatGPT or other tools.</li>
                    <li>Quickly spot type errors, missing commas and unescaped characters.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3 style="font-size: 0.95rem; margin-bottom: 0.4rem; color: #ffffff !important;">Example: formatting an API response</h3>
                <p style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.9);">
                    Paste a payload such as:
                    <code>{"user":{"id":1,"name":"Alex","roles":["admin","editor"]}}</code>
                    and click <strong>Beautify</strong>. The JSON formatter will expand it into multiple
                    lines with indentation so that nested objects and arrays are effortless to read.
                </p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function setStatus(message, isError = false) {
        const status = document.getElementById('json-status');
        const error = document.getElementById('json-error');
        status.classList.add('d-none');
        error.classList.add('d-none');
        if (isError) {
            error.textContent = message;
            error.classList.remove('d-none');
        } else if (message) {
            status.textContent = message;
            status.classList.remove('d-none');
        }
    }

    function getJson() {
        return document.getElementById('json-input').value;
    }

    document.getElementById('json-beautify').addEventListener('click', () => {
        try {
            const value = getJson();
            const parsed = JSON.parse(value);
            document.getElementById('json-input').value = JSON.stringify(parsed, null, 2);
            setStatus('JSON formatted successfully.', false);
        } catch (e) {
            setStatus(e.message, true);
        }
    });

    document.getElementById('json-minify').addEventListener('click', () => {
        try {
            const value = getJson();
            const parsed = JSON.parse(value);
            document.getElementById('json-input').value = JSON.stringify(parsed);
            setStatus('JSON minified successfully.', false);
        } catch (e) {
            setStatus(e.message, true);
        }
    });

    document.getElementById('json-validate').addEventListener('click', () => {
        try {
            JSON.parse(getJson());
            setStatus('Valid JSON.', false);
        } catch (e) {
            setStatus(e.message, true);
        }
    });

    document.getElementById('json-copy').addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(getJson());
            setStatus('Copied to clipboard.', false);
        } catch (e) {
            setStatus('Unable to copy to clipboard.', true);
        }
    });
</script>
@endsection


