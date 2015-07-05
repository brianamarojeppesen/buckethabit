<?php

$start = microtime(true);

$dir = dirname(__FILE__);

// list of files to load
$files = array(
'/zepto.min.js',
'/zepto.fx.min.js',
'/zepto.fx.methods.min.js',
'/zepto.history.min.js',
'/pgw.cookie.min.js',
'/BS.min.js',
'/history.connections.min.js',
'/account.connections.min.js',
'/a.connections.min.js',
'/menu.min.js',
);

// md5 fingerprint in case the list of files changes in some way
$scriptjsFile = $dir . '\scripts' . md5(implode('-', $files)) . '.js';

$lastBuild = null;
$rebuild = false;

if (file_exists($scriptjsFile)) {
$lastBuild = filemtime($scriptjsFile);
} else {
$rebuild = true;
}

// if there isn't a scripts.js we have to initially build the file, so there's
// no need to check for the newest js file
if (!$rebuild) {
foreach ($files as $file) {
$filePath = str_replace('/', DIRECTORY_SEPARATOR, $dir . $file);

// if there is any file which was changed after the last build, we need
// to rebuild scripts.js
if (isset($lastBuild) && filemtime($filePath) > $lastBuild) {
$rebuild = true;
}
}
}

if ($rebuild) {
$scriptjs = @fopen($scriptjsFile, 'w+');

foreach ($files as $file) {
$filePath = str_replace('/', DIRECTORY_SEPARATOR, $dir . $file);

@fwrite($scriptjs, file_get_contents($filePath));
}

fclose($scriptjs);
}

header('Content-type: application/javascript');

readfile($scriptjsFile);

$end = microtime(true);
echo '/* Time taken to build: ' . ($end - $start) . ' */';