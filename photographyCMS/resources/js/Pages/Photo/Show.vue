<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  photo: Object,
  authorized: Boolean,
})
</script>

<template>
  <AppLayout>
    <template #header>
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
          <div class="flex sm:items-center">
            <h2 v-if="photo.name" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ photo.name }}
            </h2>
            <h2 v-else class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              No name for Photo
            </h2>
          </div>
        </div>
      </div>
    </template>
    <div>
      <img :src="photo.path" alt="" />
    </div>
    <div v-if="!authorized">
      You are not authorized to edit this image
    </div>
  </AppLayout>
</template>
