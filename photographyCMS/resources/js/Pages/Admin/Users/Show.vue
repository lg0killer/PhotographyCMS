<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
  <AppLayout>
    <template #header>
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
          <div class="flex sm:items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              User Management
            </h2>
          </div>

          <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative">
              <button type="button" class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                Add New User
              </button>
            </div>
          </div>
        </div>
      </div>
    </template>
    <div>
      <h1>
        Some other items to show
      </h1>
    </div>
  </AppLayout>
</template>
