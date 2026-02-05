<?php

$file = __DIR__ . '/rbac/assignments_bench.php';

// cleanup
if (file_exists($file)) {
    unlink($file);
}

// 1. Generate large file
echo "Generating large assignments file...\n";
$content = "<?php\n\nreturn [\n    'assignments' => [\n";
for ($i = 0; $i < 10000; $i++) {
    $content .= "        '$i' => ['user'],\n";
}
$content .= "    ],\n];\n";
file_put_contents($file, $content);

$size = filesize($file);
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
