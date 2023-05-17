<template>
  <div>
    <img :src="photo.image" class="object-cover h-48 w-96 object-center"/>
    <div>{{ photo.name }}</div>
  </div>
</template>

<script setup>
defineProps({
  photo: Object,
})
</script>
