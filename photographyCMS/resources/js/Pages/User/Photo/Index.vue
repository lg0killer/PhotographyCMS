<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  photos: Array,
  photo_owner: String,
})
</script>

<template>
  <AppLayout title="Photos">
    <template #header>
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-between">
          <div class="flex sm:items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ photo_owner.name }}'s Photos
            </h2>
          </div>
        </div>
      </div>
    </template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div v-for="photo in photos" :key="photo.id">
        <Link :href="route('photos.show',[photo])">
          <img :src="photo.path" alt="" />
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
