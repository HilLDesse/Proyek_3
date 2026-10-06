<?php

// 1. Jika form dikirim, simpan nama ke cookie
if (isset($_POST['nama']) && trim($_POST['nama']) !== '') {

    $nama = trim($_POST['nama']);

    // Cookie berlaku selama 7 hari
    setcookie(
        'nama',
        $nama,
        time() + (7 * 24 * 60 * 60),
        '/'
    );

    // Refresh halaman agar cookie bisa dibaca
    header('Location: cookie_dasar.php');
    exit;
}

// 2. Jika tombol "Lupakan saya" ditekan, hapus cookie
if (isset($_GET['hapus'])) {

    setcookie(
        'nama',
        '',
        time() - 3600,
        '/'
    );

    header('Location: cookie_dasar.php');
    exit;
}

// 3. Baca cookie
$nama = $_COOKIE['nama'] ?? null;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cookie Dasar</title>
</head>
<body>

    <?php if ($nama): ?>

        <h1>Halo, <?= htmlspecialchars($nama) ?>!</h1>

        <p>Nama kamu tersimpan di cookie.</p>

        <a href="?hapus=1">Lupakan saya</a>

    <?php else: ?>

        <h1>Halo, tamu!</h1>

        <form method="post">

            <input
                type="text"
                name="nama"
                placeholder="Nama Anda"
                required
            >

            <button type="submit">Simpan</button>

        </form>

    <?php endif; ?>

</body>
</html>