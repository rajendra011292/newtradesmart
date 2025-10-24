<?php
// app/Views/dashboard.php
// Variables available: $user, $stats
?>

<div class="mb-8">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
    <div>
      <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Welcome back, <?= e($user['name'] ?? 'Trader') ?> <span class="text-blue-600">👋</span></h1>
      <p class="text-gray-600 mt-1">
        <?= e($user['email']) ?>
        <span class="mx-2 text-gray-400">•</span>
        <a href="/profile" class="text-blue-600 hover:text-blue-800 hover:underline">
          <i class="fas fa-user-edit mr-1"></i>Profile
        </a>
        <span class="mx-2 text-gray-400">•</span>
        <a href="/logout" class="text-red-600 hover:text-red-800 hover:underline">
          <i class="fas fa-sign-out-alt mr-1"></i>Logout
        </a>
      </p>
    </div>
    <div class="mt-3 md:mt-0">
      <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
        <?= strtoupper(e($_ENV['APP_ENV'] ?? 'development')) ?>
      </span>
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Trades Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500">Total Trades</p>
          <p class="mt-1 text-3xl font-semibold text-gray-900"><?= intval($stats['total_trades'] ?? 0) ?></p>
        </div>
        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
          <i class="fas fa-exchange-alt text-xl"></i>
        </div>
      </div>
    </div>

    <!-- Winning Trades Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500">Winning Trades</p>
          <p class="mt-1 text-3xl font-semibold text-green-600"><?= intval($stats['winning_trades'] ?? 0) ?></p>
          <?php if (isset($stats['total_trades']) && $stats['total_trades'] > 0): ?>
            <p class="text-sm text-gray-500 mt-1">
              <?= number_format(($stats['winning_trades'] / $stats['total_trades']) * 100, 1) ?>% win rate
            </p>
          <?php endif; ?>
        </div>
        <div class="p-3 rounded-full bg-green-100 text-green-600">
          <i class="fas fa-arrow-up text-xl"></i>
        </div>
      </div>
    </div>

    <!-- Losing Trades Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500">Losing Trades</p>
          <p class="mt-1 text-3xl font-semibold text-red-600"><?= intval($stats['losing_trades'] ?? 0) ?></p>
          <?php if (isset($stats['total_trades']) && $stats['total_trades'] > 0): ?>
            <p class="text-sm text-gray-500 mt-1">
              <?= number_format(($stats['losing_trades'] / $stats['total_trades']) * 100, 1) ?>% loss rate
            </p>
          <?php endif; ?>
        </div>
        <div class="p-3 rounded-full bg-red-100 text-red-600">
          <i class="fas fa-arrow-down text-xl"></i>
        </div>
      </div>
    </div>

    <!-- Average R:R Card -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500">Avg. Risk:Reward</p>
          <p class="mt-1 text-3xl font-semibold text-purple-600">
            <?= number_format((float)($stats['avg_rr'] ?? 0), 2) ?>
          </p>
          <p class="text-sm text-gray-500 mt-1">
            <?= (($stats['avg_rr'] ?? 0) >= 1.5) ? 'Good' : (($stats['avg_rr'] ?? 0) >= 1 ? 'Average' : 'Needs improvement') ?>
          </p>
        </div>
        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
          <i class="fas fa-balance-scale text-xl"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Trades Section -->
  <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800 flex items-center">
        <i class="fas fa-history mr-2 text-blue-600"></i> Recent Trades
      </h2>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Symbol</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entry</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exit</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">P/L</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Closed At</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php if (empty($stats['recent_trades'])): ?>
            <tr>
              <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                No trades recorded yet. <a href="/trades/new" class="text-blue-600 hover:text-blue-800">Add your first trade</a>
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($stats['recent_trades'] as $t): ?>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  <?= e($t['symbol']) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?= $t['entry_price'] !== null ? number_format((float)$t['entry_price'], 2) : '-' ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?= $t['exit_price'] !== null ? number_format((float)$t['exit_price'], 2) : '-' ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium <?= ($t['net_profit'] > 0) ? 'text-green-600' : (($t['net_profit'] < 0) ? 'text-red-600' : 'text-gray-500') ?>">
                  <?= $t['net_profit'] !== null ? (($t['net_profit'] > 0 ? '+' : '') . number_format((float)$t['net_profit'], 2)) : '-' ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <?php
                  $statusClass = [
                    'open' => 'bg-blue-100 text-blue-800',
                    'closed' => 'bg-green-100 text-green-800',
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'cancelled' => 'bg-red-100 text-red-800'
                  ][strtolower($t['status'])] ?? 'bg-gray-100 text-gray-800';
                  ?>
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                    <?= ucfirst(e($t['status'])) ?>
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <?= $t['closed_at'] ?? '<span class="text-gray-400">-</span>' ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if (!empty($stats['recent_trades'])): ?>
      <div class="px-6 py-3 bg-gray-50 text-right text-sm">
        <a href="/trades" class="text-blue-600 hover:text-blue-800 font-medium">View all trades →</a>
      </div>
    <?php endif; ?>
  </div>

  <!-- Monthly P/L Section -->
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
      <h3 class="text-lg font-semibold text-gray-800 flex items-center">
        <i class="fas fa-calendar-alt mr-2 text-blue-600"></i> Monthly P/L (Last 6 Months)
      </h3>
    </div>
    <div class="p-6">
      <?php if (empty($stats['monthly_pl'])): ?>
        <p class="text-gray-500">No closed trades recorded yet.</p>
      <?php else: ?>
        <div class="space-y-4">
          <?php foreach ($stats['monthly_pl'] as $month => $val): ?>
            <div>
              <div class="flex justify-between text-sm mb-1">
                <span class="font-medium text-gray-700"><?= e($month) ?></span>
                <span class="font-medium <?= $val >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                  <?= ($val >= 0 ? '+' : '') . number_format($val, 2) ?>
                </span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <?php
                $maxValue = max(max(array_values($stats['monthly_pl'])), 1);
                $width = min(abs($val) / ($maxValue * 1.2) * 100, 100);
                ?>
                <div class="h-2 rounded-full <?= $val >= 0 ? 'bg-green-500' : 'bg-red-500' ?>"
                  style="width: <?= $width ?>%;">
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>