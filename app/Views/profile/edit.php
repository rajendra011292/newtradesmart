<?php
// app/Views/profile/edit.php
$title = 'Edit Profile';
$heading = 'Edit Profile';
$subheading = 'Update your account information';

?>

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900"><?= $heading ?></h1>
    <p class="mt-2 text-sm text-gray-600"><?= $subheading ?></p>
  </div>
  
  <div class="bg-white shadow rounded-lg overflow-hidden">
  <div class="px-6 py-8 sm:px-10">
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

    <form action="/profile/update" method="post" enctype="multipart/form-data" class="space-y-6">
      <?= \App\Core\Middleware\Csrf::inputField() ?>
      
      <!-- Avatar Upload -->
      <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
        <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
          Profile Photo
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
          <div class="flex items-center">
            <?php if (!empty($user['avatar'])): ?>
              <img class="h-16 w-16 rounded-full object-cover" src="<?= e($user['avatar']) ?>" alt="">
            <?php else: ?>
              <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xl font-bold">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
              </div>
            <?php endif; ?>
            <div class="ml-4">
              <label class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Change
                <input type="file" name="avatar" accept="image/*" class="sr-only">
              </label>
              <p class="mt-1 text-xs text-gray-500">PNG, JPG, WebP up to 2MB</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Name -->
      <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
        <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
          Full name
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
          <input type="text" name="name" id="name" autocomplete="name" required
                 value="<?= e($user['name']) ?>"
                 class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
        </div>
      </div>

      <!-- Email (Read-only) -->
      <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
        <label class="block text-sm font-medium text-gray-700">
          Email
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
          <div class="max-w-lg flex rounded-md shadow-sm">
            <input type="text" value="<?= e($user['email']) ?>" disabled
                   class="flex-1 block w-full rounded-md bg-gray-100 border-gray-300 sm:text-sm">
          </div>
          <p class="mt-1 text-sm text-gray-500">Contact support to change your email address.</p>
        </div>
      </div>

      <!-- Bio -->
      <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
        <label for="bio" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
          Bio
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
          <textarea id="bio" name="bio" rows="3" 
                    class="max-w-lg shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border border-gray-300 rounded-md"><?= e($user['bio'] ?? '') ?></textarea>
          <p class="mt-2 text-sm text-gray-500">Tell us a little bit about yourself.</p>
        </div>
      </div>

      <!-- Location -->
      <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
        <label for="location" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
          Location
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
          <input type="text" name="location" id="location" 
                 value="<?= e($user['location'] ?? '') ?>"
                 class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
        </div>
      </div>

      <!-- Form Actions -->
      <div class="pt-5 border-t border-gray-200">
        <div class="flex justify-end">
          <a href="/profile" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Cancel
          </a>
          <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Save Changes
          </button>
        </div>
      </div>
    </form>
  </div>
</div>


