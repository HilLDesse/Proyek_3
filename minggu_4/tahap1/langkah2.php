<?php

$nama = $_POST['nama'] ?? null;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Langkah 2</title>
</head>
<body>

    <h2>Langkah 2: Server Menerima Data</h2>

    <p>
        Halo,
        <b>
            <?= htmlspecialchars($nama ?? 'tidak diketahui') ?>
        </b>!
    </p>

    <p>Server berhasil menerima nama Anda.</p>

    <a href="langkah3.php">
        Lanjut ke Langkah 3
    </a>

</body>
</html>