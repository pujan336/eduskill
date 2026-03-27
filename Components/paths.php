<?php

$appRoot = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$scriptPath = str_replace('\\', '/', dirname(realpath($_SERVER['SCRIPT_FILENAME'])));
$sub = '';
if ($appRoot && strpos($scriptPath, $appRoot) === 0) {
    $sub = trim(substr($scriptPath, strlen($appRoot)), '/');
}
$depth = ($sub === '') ? 0 : substr_count($sub, '/') + 1;
$ROOT = $depth ? str_repeat('../', $depth) : '';
