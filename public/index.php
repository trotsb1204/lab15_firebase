<?php
// public/index.php
require_once __DIR__ . '/../src/functions.php';
?>
<?php include __DIR__ . '/_header.php'; ?>

<h2>Додати повідомлення</h2>
<form method="post" action="submit.php" novalidate>
    <!-- CSRF токен для безпеки -->
    <input type="hidden" name="_token" value="<?= e(csrf_token()) ?>">
    
    <div class="row">
        <div>
            <label>Імʼя *</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" placeholder="example@mail.com">
        </div>
    </div>
    
    <div>
        <label>Повідомлення *</label>
        <textarea name="message" rows="3" required></textarea>
    </div>

    <button class="primary" type="submit">Надіслати</button>
</form>

<hr>

<h2>Останні повідомлення</h2>
<?php
$rows = [];
$err = null;
try {
    // Отримання даних з Firebase
    $rows = list_submissions(20);
} catch (Throwable $e) {
    $err = $e->getMessage();
}

if ($err) {
    echo '<div class="flash error">Помилка: ' . e($err) . '</div>';
}
?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Імʼя</th>
            <th>Email</th>
            <th>Повідомлення</th>
            <th>Створено</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= e($r['id']) ?></td>
                <td><?= e($r['name']) ?></td>
                <td><?= e($r['email']) ?></td>
                <td><?= nl2br(e($r['message'])) ?></td>
                <td><?= e($r['created_at']) ?></td>
            </tr>
        <?php endforeach;
        if (!$rows): ?>
            <tr>
                <td colspan="5">Немає записів.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/_footer.php'; ?>