<?php

$nama = $_POST['nama'] ?? null;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Langkah 3</title>
</head>
<body>

    <h2>Langkah 3: Apakah Server Masih Ingat?</h2>

    <p>
        Halo,
        <b>
            <?= htmlspecialchars($nama ?? 'tidak diketahui') ?>
        </b>.
    </p>

    <p>
        Server tidak lagi mengetahui nama Anda
        karena halaman ini merupakan request baru.
    </p>

</body>
</html>