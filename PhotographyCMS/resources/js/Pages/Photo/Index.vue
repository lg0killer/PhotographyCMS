<template>
  <AppLayout title="Photos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Photos
      </h2>
    </template>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
      <ImageBoxGallery :photos="photos"/>
    </div>

    <div v-if="photos.data.length" class="w-full flex justify-center">
      <Pagination :links="photos.links" class="text-gray-800 dark:text-gray-200"/>
    </div>
  </AppLayout>
</template>

<script setup>
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue'
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  photos: Object,
  user: Object,
  theme: Object,
})
</script>
