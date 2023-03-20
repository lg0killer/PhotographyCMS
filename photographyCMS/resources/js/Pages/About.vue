<script setup>
import AppLayout from '@/Layouts/AppLayoutExternal.vue'
</script>

<template>
  <AppLayout title="About" can-login="canLogin" can-register="canRegister">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        About
      </h2>
    </template>
  </AppLayout>
</template>
