<?php
// app/Views/auth/password_forgot.php
$title = 'Forgot Password';
$heading = 'Reset your password';
$subheading = 'Enter your email and we\'ll send you a link to reset your password';
$show_login_link = true;
?>

<?php $this->start('content') ?>
  <form class="space-y-6" method="post" action="/password/forgot">
    <?= \App\Core\Middleware\Csrf::inputField() ?>
    
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
      <div class="mt-1">
        <input id="email" name="email" type="email" autocomplete="email" required
               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               placeholder="you@example.com">
      </div>
    </div>

    <div>
      <button type="submit"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Send reset link
      </button>
    </div>
  </form>
<?php $this->end() ?>

<?php $this->layout('auth/_auth_layout') ?>
