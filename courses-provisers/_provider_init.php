<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

if (!isset($_SESSION['provider_id']) || (int) $_SESSION['provider_id'] < 1) {
    header('Location: provider-login.php');
    exit;
}

$provider_id = (int) $_SESSION['provider_id'];
$provider_name = (string) ($_SESSION['provider_name'] ?? 'Provider');
