<?php
// app/Views/auth/password_reset.php
$title = 'Reset Password';
$heading = 'Set a new password';
$subheading = 'Create a strong password to secure your account';
$show_login_link = true;
?>

<?php $this->start('content') ?>
  <form class="space-y-6" method="post" action="/password/reset">
    <?= \App\Core\Middleware\Csrf::inputField() ?>
    <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES) ?>">
    
    <div>
      <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
      <div class="mt-1 relative">
        <input id="password" name="password" type="password" autocomplete="new-password" required
               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               placeholder="••••••••">
      </div>
      <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters long</p>
    </div>

    <div>
      <label for="password_confirm" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
      <div class="mt-1">
        <input id="password_confirm" name="password_confirm" type="password" autocomplete="new-password" required
               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               placeholder="••••••••">
      </div>
    </div>

    <div>
      <button type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Reset Password
      </button>
    </div>
  </form>
<?php $this->end() ?>

<?php $this->layout('auth/_auth_layout') ?>
