<template>
    <ImageBox class="relative" v-for="photo in photos.data" :photo="photo" :key="photo.id">
    </ImageBox>
</template>
<script setup>
import ImageBox from '@/Components/UI/ImageBox.vue'

defineProps({
    photos: Object,
})
</script>