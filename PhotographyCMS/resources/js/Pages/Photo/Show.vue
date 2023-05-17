<template>
  <div class="grid grid-cols-3">
    <!-- <Box class="col-span-12 flex items-center">
      <div class="w-full text-center">No Images</div>
    </Box> -->
    <!-- <PhotoViewer class="col-span-10" :photo="photo"/> -->

  </div>
</template>

<script setup>
import PhotoViewer from '@/Components/PhotoViewer.vue'
defineProps({
  photo: Object,
})
</script>
