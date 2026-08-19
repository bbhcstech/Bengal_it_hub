<?php
$file = __DIR__ . '/resources/views/pages/home.blade.php';
$content = file_get_contents($file);
$marker = '@endsection';
$pos = strpos($content, $marker);
if ($pos !== false) {
    $newContent = substr($content, 0, $pos + strlen($marker)) . "\n";
    file_put_contents($file, $newContent);
    echo 'Done. Lines: ' . count(file($file)) . "\n";
} else {
    echo "Not found\n";
}
