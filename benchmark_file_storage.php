<?php

$file = __DIR__ . '/rbac/assignments_bench.php';

// cleanup
if (file_exists($file)) {
    unlink($file);
}

// 1. Generate large file
echo "Generating large assignments file...\n";
$genStartTime = microtime(true);
$lines = [];
$lines[] = "<?php\n\nreturn [\n    'assignments' => [\n";
for ($i = 0; $i < 10000; $i++) {
    $lines[] = "        '$i' => ['user'],\n";
}
$lines[] = "    ],\n];\n";
$content = implode('', $lines);
$genEndTime = microtime(true);
file_put_contents($file, $content);

$genDuration = ($genEndTime - $genStartTime) * 1000; // ms
echo "Generation time: " . round($genDuration, 4) . " ms\n";

$size = filesize($file);
echo "File hash: " . md5_file($file) . "\n";
echo "File generated. Size: " . round($size / 1024, 2) . " KB\n";

// 2. Measure modification
$userId = 'new_user_id';
$startTime = microtime(true);

$content = file_get_contents($file);
$newContent = str_replace(
    "'assignments' => [",
    "'assignments' => [\n        '$userId' => ['admin'],",
    $content
);
file_put_contents($file, $newContent);

$endTime = microtime(true);
$duration = ($endTime - $startTime) * 1000; // ms

echo "Time to add user: " . round($duration, 4) . " ms\n";

// cleanup
unlink($file);
