<?php
// app/Views/auth/_auth_layout.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Authentication' ?> - <?= e($_ENV['APP_NAME'] ?? 'TradeSmart') ?></title>
  <link href="/assets/css/app.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    .auth-bg {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }
    .auth-card {
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
  </style>
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <!-- Logo/App Name -->
      <div class="text-center mb-8">
        <a href="/" class="inline-flex items-center justify-center">
          <i class="fas fa-chart-line text-3xl text-blue-600 mr-2"></i>
          <span class="text-2xl font-bold text-gray-800"><?= e($_ENV['APP_NAME'] ?? 'TradeSmart') ?></span>
        </a>
        <h1 class="mt-4 text-2xl font-bold text-gray-900"><?= $heading ?? 'Welcome Back' ?></h1>
        <p class="mt-2 text-sm text-gray-600"><?= $subheading ?? 'Please sign in to your account' ?></p>
      </div>

      <!-- Flash Messages -->
      <?php if ($msg = flash('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
          <div class="flex">
            <div class="flex-shrink-0">
              <i class="fas fa-exclamation-circle h-5 w-5"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm"><?= $msg ?></p>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($msg = flash('success')): ?>
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
          <div class="flex">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle h-5 w-5"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm"><?= $msg ?></p>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Content -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 auth-card">
        <div class="px-8 py-8">
          <?= $content ?? '' ?>
        </div>
      </div>

      <!-- Footer Links -->
      <div class="mt-6 text-center text-sm text-gray-600">
        <?php if (isset($show_register_link) && $show_register_link): ?>
          <p>Don't have an account? <a href="/register" class="font-medium text-blue-600 hover:text-blue-500">Sign up</a></p>
        <?php endif; ?>
        <?php if (isset($show_login_link) && $show_login_link): ?>
          <p class="mt-2">Already have an account? <a href="/login" class="font-medium text-blue-600 hover:text-blue-500">Sign in</a></p>
        <?php endif; ?>
        <?php if (isset($show_forgot_link) && $show_forgot_link): ?>
          <p class="mt-2"><a href="/password/forgot" class="font-medium text-blue-600 hover:text-blue-500">Forgot your password?</a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
