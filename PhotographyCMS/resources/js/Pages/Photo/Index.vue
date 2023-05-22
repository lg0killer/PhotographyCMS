<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
    <ImageBoxGallery :photos="photos"/>
  </div>

  <div v-if="photos.data.length" class="w-full flex justify-center">
    <Pagination :links="photos.links"/>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import PhotoViewer from '@/Components/PhotoViewer.vue'
import ImageBoxGallery from '@/Components/UI/ImageBoxGallery.vue'
import Pagination from '@/Components/UI/Pagination.vue'
defineProps({
  photos: Object,
  user: Object,
  theme: Object,
})
</script>
