<?php
// public/submit.php
require_once __DIR__ . '/../src/functions.php';

// Перевірка CSRF токену
csrf_check();

// Отримання та очищення даних з форми
$data = [
    'name' => trim($_POST['name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'message' => trim($_POST['message'] ?? ''),
];

// Валідація даних
$errors = validate_submission($data);
if ($errors) {
    set_flash('error', implode(' ', $errors));
    header('Location: index.php');
    exit;
}

// Збереження в Firebase
try {
    $id = create_submission($data);
    set_flash('success', 'Збережено. ID: ' . $id);
} catch (Throwable $e) {
    set_flash('error', 'Помилка збереження: ' .
$e->getMessage());
}

// Перенаправлення назад на форму
header('Location: index.php');