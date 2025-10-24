<?php
// app/Views/profile/show.php
$title = 'My Profile';
$heading = 'Profile Information';
$subheading = 'Manage your account settings and profile details';


?>

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <div class="text-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900"><?= $heading ?></h1>
    <p class="mt-2 text-sm text-gray-600"><?= $subheading ?></p>
  </div>
  
  <div class="bg-white shadow rounded-lg overflow-hidden">
  <div class="px-6 py-8 sm:px-10">
    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-6 sm:space-y-0 sm:space-x-6">
      <!-- Avatar -->
      <div class="flex-shrink-0">
        <?php if (!empty($user['avatar'])): ?>
          <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-lg" 
               src="<?= e($user['avatar']) ?>" 
               alt="<?= e($user['name']) ?>'s avatar">
        <?php else: ?>
          <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-4xl font-bold">
            <?= strtoupper(substr($user['name'], 0, 1)) ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- User Info -->
      <div class="flex-1 min-w-0">
        <div class="flex items-center justify-between">
          <h2 class="text-2xl font-bold text-gray-900 leading-7 sm:truncate">
            <?= e($user['name']) ?>
          </h2>
          <div class="ml-4">
            <a href="/profile/edit" 
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
              </svg>
              Edit Profile
            </a>
          </div>
        </div>
        
        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
          <div class="mt-2 flex items-center text-sm text-gray-500">
            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
              <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
            </svg>
            <?= e($user['email']) ?>
          </div>
          
          <?php if (!empty($user['location'])): ?>
            <div class="mt-2 flex items-center text-sm text-gray-500">
              <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
              <?= e($user['location']) ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Bio Section -->
    <?php if (!empty($user['bio'])): ?>
      <div class="mt-8 border-t border-gray-200 pt-8">
        <h3 class="text-lg font-medium text-gray-900">About</h3>
        <div class="mt-4 text-gray-600 whitespace-pre-line">
          <?= nl2br(e($user['bio'])) ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  
  <!-- Stats -->
  <div class="border-t border-gray-200 bg-gray-50 px-6 py-5">
    <dl class="grid grid-cols-1 gap-5 sm:grid-cols-3">
      <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Member Since</dt>
        <dd class="mt-1 text-2xl font-semibold text-gray-900">
          <?= date('M Y', strtotime($user['created_at'] ?? 'now')) ?>
        </dd>
      </div>
      <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Account Status</dt>
        <dd class="mt-1">
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            Active
          </span>
        </dd>
      </div>
      <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
        <dt class="text-sm font-medium text-gray-500 truncate">Last Login</dt>
        <dd class="mt-1 text-sm text-gray-900">
          <?= !empty($user['last_login']) ? date('M j, Y g:i A', strtotime($user['last_login'])) : 'N/A' ?>
        </dd>
      </div>
    </dl>
  </div>
  
  <!-- Actions -->
  <div class="bg-gray-50 px-6 py-4 sm:px-10 border-t border-gray-200">
    <div class="flex justify-between items-center">
      <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
        <svg class="mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to Dashboard
      </a>
      <div class="space-x-3">
        <a href="/change-password" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Change Password
        </a>
      </div>
    </div>
  </div>
  </div>
</div>


