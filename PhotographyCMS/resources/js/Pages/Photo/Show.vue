<template>
  <!-- <div class="flex place-content-center max-h-screen max-w-screen">
    <img :src="photo.image" class="rounded basis-3/4 flex"/>
  </div> -->
  <div class="flex place-content-center max-h-screen max-w-screen">
    <img :src="photo.image" class="rounded flex"/>
  </div>
</template>

<script setup>
import PhotoViewer from '@/Components/PhotoViewer.vue'
defineProps({
  photo: Object,
})
</script>
