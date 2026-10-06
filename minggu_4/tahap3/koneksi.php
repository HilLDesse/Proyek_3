<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=proyek3;charset=utf8mb4',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);