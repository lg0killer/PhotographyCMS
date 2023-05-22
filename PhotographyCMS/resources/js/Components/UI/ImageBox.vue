<template>
    <Box>
        <div class="max-w-sm rounded overflow-hidden">
            <img class="w-full" :src="photo.image"/>
        </div>
        <div class="flex flex-colomn">
            <div>{{ photo.owner.name }}</div>
            <div>{{ photo.category.name }}</div>            
        </div>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'

defineProps({
    photo: Object,
})
</script>