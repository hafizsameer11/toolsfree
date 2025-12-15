<?php

namespace App\Http\Controllers;

class ToolController extends Controller
{
    public function jsonFormatter()
    {
        $meta = [
            'title' => 'Free Online JSON Formatter & Validator - ToolsFree.org',
            'description' => 'Format, beautify, minify and validate JSON instantly with clear error messages. Paste your JSON and clean it up in one click.',
            'keywords' => 'json formatter,json validator,json beautifier,json minifier,online json tool',
        ];

        return view('tools.json-formatter', compact('meta'));
    }

    public function urlEncoder()
    {
        $meta = [
            'title' => 'URL Encoder & Decoder - ToolsFree.org',
            'description' => 'Encode and decode URLs and text safely for use in query strings, APIs and web development. Mobile friendly and fast.',
            'keywords' => 'url encoder,url decoder,percent encode,url escape,online url tool',
        ];

        return view('tools.url-encoder', compact('meta'));
    }

    public function colorConverter()
    {
        $meta = [
            'title' => 'HEX to RGB Color Converter & Picker - ToolsFree.org',
            'description' => 'Convert HEX to RGB and RGB to HEX, pick colors, and build quick palettes for web and UI design.',
            'keywords' => 'hex to rgb,rgb to hex,color picker,online color converter',
        ];

        return view('tools.color-converter', compact('meta'));
    }

    public function unitConverter()
    {
        $meta = [
            'title' => 'Unit Converter (Length, Weight, Volume, Temperature) - ToolsFree.org',
            'description' => 'Convert common and niche units: cm to inches, kg to lbs, liters to gallons, Celsius to Fahrenheit and more.',
            'keywords' => 'unit converter,length converter,weight converter,temperature converter,volume converter',
        ];

        return view('tools.unit-converter', compact('meta'));
    }

    public function passwordGenerator()
    {
        $meta = [
            'title' => 'Random Password Generator & Strength Checker - ToolsFree.org',
            'description' => 'Generate strong, random passwords and check their strength. Options for length, symbols, and pronounceable passwords.',
            'keywords' => 'password generator,password strength checker,secure password,random password',
        ];

        return view('tools.password-generator', compact('meta'));
    }
}


