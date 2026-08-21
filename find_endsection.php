<?php
$file = __DIR__ . '/resources/views/pages/home.blade.php';
$lines = file($file);
echo "Total lines: " . count($lines) . "\n";
foreach ($lines as $i => $line) {
    if (strpos($line, '@endsection') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
