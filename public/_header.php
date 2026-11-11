<?php
// public/_header.php
require_once __DIR__ . '/../src/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firebase Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="container">
        <h1>Firebase Form (Realtime Database)</h1>
        <hr>
    </header>
    <main class="container">
        <?php foreach (get_flash() as $f): ?>
            <div class="flash <?= e($f['type']) ?>"><?= e($f['msg']) ?></div>
        <?php endforeach; ?>