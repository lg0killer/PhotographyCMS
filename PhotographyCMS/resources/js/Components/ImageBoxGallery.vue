<template>
    <ImageBox class="relative" :edit="edit" v-for="photo in photos.data" :photo="photo" :key="photo.id">
    </ImageBox>
</template>
<script setup>
import ImageBox from '@/Components/ImageBox.vue'

defineProps({
    photos: Object,
    edit: Boolean,
})
</script>