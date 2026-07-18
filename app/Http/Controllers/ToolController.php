<?php

namespace App\Http\Controllers;

use App\Support\Seo;

class ToolController extends Controller
{
    public function jsonFormatter()
    {
        $meta = Seo::merge([
            'title' => 'Free JSON Formatter & Validator Online | ToolsFree.org',
            'description' => 'Format, beautify, minify and validate JSON instantly with clear error messages. Paste your JSON and clean it up in one click. 100% client-side and private.',
            'keywords' => 'json formatter,json validator,json beautifier,json minifier,online json tool,pretty print json',
            'canonical' => route('tools.json'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'JSON Formatter & Validator',
            $meta['description'],
            route('tools.json'),
            'json-formatter'
        );

        return view('tools.json-formatter', compact('meta', 'jsonLd'));
    }

    public function urlEncoder()
    {
        $meta = Seo::merge([
            'title' => 'URL Encoder & Decoder Online | ToolsFree.org',
            'description' => 'Encode and decode URLs and text safely for query strings, APIs and web development. Supports component and full-URL encoding modes.',
            'keywords' => 'url encoder,url decoder,percent encode,url escape,online url tool,query string encoder',
            'canonical' => route('tools.url'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'URL Encoder & Decoder',
            $meta['description'],
            route('tools.url'),
            'url-encoder'
        );

        return view('tools.url-encoder', compact('meta', 'jsonLd'));
    }

    public function colorConverter()
    {
        $meta = Seo::merge([
            'title' => 'HEX to RGB & HSL Color Converter Online | ToolsFree.org',
            'description' => 'Convert HEX to RGB and HSL, RGB to HEX, pick colors with a visual preview, and copy clean color codes for web and UI design.',
            'keywords' => 'hex to rgb,rgb to hex,hsl converter,color picker,online color converter,css colors',
            'canonical' => route('tools.color'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'HEX RGB HSL Color Converter',
            $meta['description'],
            route('tools.color'),
            'color-converter'
        );

        return view('tools.color-converter', compact('meta', 'jsonLd'));
    }

    public function unitConverter()
    {
        $meta = Seo::merge([
            'title' => 'Free Unit Converter Online - Length, Weight & More | ToolsFree.org',
            'description' => 'Convert metric and imperial units: cm to inches, kg to lbs, liters to gallons, Celsius to Fahrenheit and Kelvin, area, speed, and data storage units.',
            'keywords' => 'unit converter,length converter,weight converter,temperature converter,volume converter,area converter,speed converter',
            'canonical' => route('tools.unit'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'Unit Converter',
            $meta['description'],
            route('tools.unit'),
            'unit-converter'
        );

        return view('tools.unit-converter', compact('meta', 'jsonLd'));
    }

    public function passwordGenerator()
    {
        $meta = Seo::merge([
            'title' => 'Random Password Generator & Strength Checker | ToolsFree.org',
            'description' => 'Generate strong, cryptographically secure random passwords with customizable length and character sets. Includes real-time strength analysis.',
            'keywords' => 'password generator,password strength checker,secure password,random password,crypto password generator',
            'canonical' => route('tools.password'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'Password Generator',
            $meta['description'],
            route('tools.password'),
            'password-generator'
        );

        return view('tools.password-generator', compact('meta', 'jsonLd'));
    }

    public function base64Encoder()
    {
        $meta = Seo::merge([
            'title' => 'Base64 Encoder & Decoder Online | ToolsFree.org',
            'description' => 'Encode and decode Base64 text and files instantly. Supports UTF-8, URL-safe Base64, and binary file encoding — 100% client-side and private.',
            'keywords' => 'base64 encoder,base64 decoder,base64 encode,base64 decode,online base64 tool,utf8 base64',
            'canonical' => route('tools.base64'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'Base64 Encoder & Decoder',
            $meta['description'],
            route('tools.base64'),
            'base64-encoder'
        );

        return view('tools.base64-encoder', compact('meta', 'jsonLd'));
    }

    public function hashGenerator()
    {
        $meta = Seo::merge([
            'title' => 'SHA Hash Generator (SHA-256 / SHA-512) Online | ToolsFree.org',
            'description' => 'Generate SHA-256, SHA-384, and SHA-512 hashes from text using the Web Crypto API. Instant, secure, client-side hashing for developers and security workflows.',
            'keywords' => 'sha256 generator,sha512 hash,hash generator,checksum generator,web crypto hash,online hash tool',
            'canonical' => route('tools.hash'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'SHA Hash Generator',
            $meta['description'],
            route('tools.hash'),
            'hash-generator'
        );

        return view('tools.hash-generator', compact('meta', 'jsonLd'));
    }

    public function textCaseConverter()
    {
        $meta = Seo::merge([
            'title' => 'Text Case Converter: camelCase, snake_case | ToolsFree.org',
            'description' => 'Convert text between uppercase, lowercase, title case, camelCase, PascalCase, snake_case, kebab-case, and CONSTANT_CASE. Essential for developers and writers.',
            'keywords' => 'case converter,camelcase converter,snake case,kebab case,text transform,variable naming',
            'canonical' => route('tools.case'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'Text Case Converter',
            $meta['description'],
            route('tools.case'),
            'text-case-converter'
        );

        return view('tools.text-case-converter', compact('meta', 'jsonLd'));
    }

    public function wordCounter()
    {
        $meta = Seo::merge([
            'title' => 'Free Word & Character Counter Online | ToolsFree.org',
            'description' => 'Count words, characters, sentences, and paragraphs instantly. Includes reading time estimate for writers, bloggers, students, and SEO professionals. 100% free and private.',
            'keywords' => 'word counter,character counter,word count online,text counter,reading time calculator,seo word count',
            'canonical' => route('tools.wordcount'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'Word & Character Counter',
            $meta['description'],
            route('tools.wordcount'),
            'word-counter'
        );

        return view('tools.word-counter', compact('meta', 'jsonLd'));
    }

    public function timestampConverter()
    {
        $meta = Seo::merge([
            'title' => 'Unix Timestamp Converter (Epoch to Date) | ToolsFree.org',
            'description' => 'Convert Unix epoch timestamps to human-readable dates and back. Supports seconds and milliseconds, UTC and local timezone. Essential for developers and sysadmins.',
            'keywords' => 'unix timestamp converter,epoch converter,timestamp to date,unix time,datetime converter',
            'canonical' => route('tools.timestamp'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'Unix Timestamp Converter',
            $meta['description'],
            route('tools.timestamp'),
            'timestamp-converter'
        );

        return view('tools.timestamp-converter', compact('meta', 'jsonLd'));
    }

    public function uuidGenerator()
    {
        $meta = Seo::merge([
            'title' => 'UUID Generator (v4) – Free Online GUID Tool | ToolsFree.org',
            'description' => 'Generate random UUID v4 / GUID identifiers instantly. Bulk generate up to 100 UUIDs with one click. Cryptographically secure, client-side, no signup required.',
            'keywords' => 'uuid generator,guid generator,uuid v4,random uuid,online uuid generator,unique id generator',
            'canonical' => route('tools.uuid'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'UUID Generator',
            $meta['description'],
            route('tools.uuid'),
            'uuid-generator'
        );

        return view('tools.uuid-generator', compact('meta', 'jsonLd'));
    }

    public function jwtDecoder()
    {
        $meta = Seo::merge([
            'title' => 'JWT Decoder – Decode JSON Web Tokens Online | ToolsFree.org',
            'description' => 'Decode and inspect JWT header and payload online. View expiration, issued-at, and claims. Client-side only — your tokens never leave your browser.',
            'keywords' => 'jwt decoder,jwt decode,json web token decoder,jwt parser,inspect jwt online',
            'canonical' => route('tools.jwt'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'JWT Decoder',
            $meta['description'],
            route('tools.jwt'),
            'jwt-decoder'
        );

        return view('tools.jwt-decoder', compact('meta', 'jsonLd'));
    }

    public function qrCodeGenerator()
    {
        $meta = Seo::merge([
            'title' => 'Free QR Code Generator Online | ToolsFree.org',
            'description' => 'Create QR codes for URLs, text, WiFi, email, and phone numbers instantly. Download as PNG. No signup, no watermark, 100% client-side generation.',
            'keywords' => 'qr code generator,free qr code,create qr code online,qr code maker,url qr code',
            'canonical' => route('tools.qr'),
        ]);

        $jsonLd = Seo::toolJsonLd(
            'QR Code Generator',
            $meta['description'],
            route('tools.qr'),
            'qr-code-generator'
        );

        return view('tools.qr-code-generator', compact('meta', 'jsonLd'));
    }
}
