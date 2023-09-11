<template>
    <ImageBox class="relative" :delete="delete" :edit="edit" v-for="photo in photos.data" :photo="photo" :key="photo.id" :ClubInfo="ClubInfo" :UserInfo="UserInfo" :AdminInfo="AdminInfo">
    </ImageBox>
</template>
<script setup>
import ImageBox from '@/Components/ImageBox.vue'

defineProps({
    photos: Object,
    edit: Boolean,
    delete: Boolean,
    ClubInfo: Boolean,
    UserInfo: Boolean,
    AdminInfo: Boolean,
})
</script>