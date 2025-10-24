<?php
// app/Views/layout/main.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'TradeSmart' ?></title>
<link href="/assets/css/app.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900">
  <header class="bg-blue-700 text-white shadow-md">
    <div class="container mx-auto px-4 py-3">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <h1 class="text-2xl font-bold">
          <a href="/" class="flex items-center">
            <i class="fas fa-chart-line mr-2"></i> TradeSmart
          </a>
        </h1>
        <nav class="mt-2 md:mt-0">
          <?php if (!empty($_SESSION['user_id'])): ?>
            <a href="/dashboard" class="px-3 py-2 hover:bg-blue-600 rounded transition">
              <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
            </a>
            <a href="/marketoverview" class="px-3 py-2 hover:bg-blue-600 rounded transition">
              <i class="fas fa-chart-bar mr-1"></i> Market Overview
            </a>
            <a href="/profile" class="px-3 py-2 hover:bg-blue-600 rounded transition">
              <i class="fas fa-user mr-1"></i> Profile
            </a>
            <a href="/logout" class="px-3 py-2 hover:bg-blue-600 rounded transition">
              <i class="fas fa-sign-out-alt mr-1"></i> Logout
            </a>
          <?php else: ?>
            <a href="/login" class="px-3 py-2 hover:bg-blue-600 rounded transition">
              <i class="fas fa-sign-in-alt mr-1"></i> Login
            </a>
            <a href="/register" class="px-3 py-2 hover:bg-blue-600 rounded transition">
              <i class="fas fa-user-plus mr-1"></i> Register
            </a>
          <?php endif; ?>
        </nav>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-6">
    <?= $content ?? '' ?>
  </main>

  <footer class="bg-gray-800 text-white py-4 mt-8">
    <div class="container mx-auto px-4 text-center">
      <small>&copy; <?= date('Y') ?> TradeSmart. All rights reserved.</small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
