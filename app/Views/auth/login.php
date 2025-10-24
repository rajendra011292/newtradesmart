<?php
// app/Views/auth/login.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login - <?= e($_ENV['APP_NAME'] ?? 'App') ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    .form { max-width: 420px; margin: 0 auto; }
    .input { margin-bottom: 12px; }
    .alert { padding: 8px 12px; margin-bottom: 12px; border-radius: 4px; }
    .alert.error { background: #ffe1e1; color: #8a0000; }
    .alert.success { background: #e6ffe6; color: #007a00; }
  </style>
</head>
<body>
  <div class="form">
    <h1>Login</h1>

    <?php if ($msg = flash('error')): ?>
      <div class="alert error"><?= $msg ?></div>
    <?php endif; ?>

    <?php if ($msg = flash('success')): ?>
      <div class="alert success"><?= $msg ?></div>
    <?php endif; ?>

    <form method="post" action="/login" autocomplete="off">
      <?= \App\Core\Middleware\Csrf::inputField() ?>

      <div class="input">
        <label for="email">Email</label><br>
        <input id="email" name="email" type="email" value="<?= e(old('email')) ?>" required>
      </div>

      <div class="input">
        <label for="password">Password</label><br>
        <input id="password" name="password" type="password" required>
      </div>

      <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="/register">Register here</a>.</p>
  </div>
</body>
</html>
