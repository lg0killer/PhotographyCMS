<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
    <Box v-for="photo in photos.data" :key="photo.id">
      <div>
        <Link :href="route('photo.show', {photo: photo.id})">
          <PhotoViewer :photo="photo"/>
        </Link>
      </div>
      <div v-if="photo.by_user_id == user.id">
        <div>
          <Link :href="route('photo.edit', {photo: photo.id})">Edit</Link>
        </div>
        <div>
          <Link :href="route('photo.destroy', {photo: photo.id})" method="delete" as="button">Delete</Link>
        </div>
      </div>
    </Box>
  </div>

  <div v-if="photos.data.length" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="photos.links"/>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import PhotoViewer from '@/Components/PhotoViewer.vue'
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
defineProps({
  photos: Object,
  user: Object,
})
</script>
