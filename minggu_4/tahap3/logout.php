<?php

session_start();

// Kosongkan seluruh data session
$_SESSION = [];

// Hapus cookie session jika session menggunakan cookie
if (ini_get('session.use_cookies')) {

    $p = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $p['path'],
        $p['domain'],
        $p['secure'],
        $p['httponly']
    );
}

// Hancurkan session di server
session_destroy();

// Kembali ke halaman login
header('Location: login.php');
exit;