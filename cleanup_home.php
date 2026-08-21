<?php
$file = __DIR__ . '/resources/views/pages/home.blade.php';
$lines = file($file);
$total = count($lines);
echo "Total lines: $total\n";

// Find the line with the FAQ section close (our new content ends around line 709)
// We want to keep lines 1..709 and then add @endsection
// The old content starts at line 713 (0-indexed: 712)
// Let's find the first occurrence of 'bih-landing-hero' which is the old hero
$cutAt = null;
foreach ($lines as $i => $line) {
    if (strpos($line, 'bih-landing-hero') !== false || strpos($line, 'bih-hero-showcase') !== false) {
        $cutAt = $i;
        echo "Found old hero at line " . ($i + 1) . "\n";
        break;
    }
}

if ($cutAt !== null) {
    // Keep lines 0..$cutAt-1, trim trailing blanks, add @endsection
    $newLines = array_slice($lines, 0, $cutAt);
    // Remove trailing blank lines
    while (count($newLines) > 0 && trim(end($newLines)) === '') {
        array_pop($newLines);
    }
    // Add the FAQ closing section and @endsection back
    // Check if last meaningful line is </section>
    $lastLine = trim(end($newLines));
    echo "Last meaningful line: $lastLine\n";
    $newLines[] = "\n";
    $newLines[] = "@endsection\n";
    file_put_contents($file, implode('', $newLines));
    echo "Done. New line count: " . count(file($file)) . "\n";
} else {
    echo "Old hero not found. Checking for @endsection...\n";
    // Find the second @endsection (old one)
    $positions = [];
    foreach ($lines as $i => $line) {
        if (strpos($line, '@endsection') !== false) {
            $positions[] = $i + 1;
            echo "Found @endsection at line " . ($i + 1) . "\n";
        }
    }
}
