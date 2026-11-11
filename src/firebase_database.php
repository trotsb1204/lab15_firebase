<?php
// src/firebase_database.php
declare(strict_types=1);

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;

function database(): Database
{
    static $db = null;

    if ($db === null) {
        $key = $_ENV['FIREBASE_CREDENTIALS'] ?? '';
        $kpath = dirname(__DIR__) . '/' . $key;

        if ($key === '' || !is_file($kpath)) {
            throw new RuntimeException('Невірний .env або відсутній файл service-account.json');
        }

        // Ініціалізація Firebase з ключем авторизації та URL вашої бази даних
        $factory = (new Factory)
            ->withServiceAccount($kpath)
            ->withDatabaseUri('https://lab15-firebase-default-rtdb.europe-west1.firebasedatabase.app/');

        $db = $factory->createDatabase();
    }

    return $db;
}