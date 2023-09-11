<template>
  <div class="flex flex-col">
    <img :src="photo.image" class=""/>
    <div class="basis-3/4">{{ photo.name }}</div>
  </div>
</template>

<script setup>
defineProps({
  photo: Object,
})
</script>
