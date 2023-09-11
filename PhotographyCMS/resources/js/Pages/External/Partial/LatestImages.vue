<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Latest Submissions
        </h2>
        <hr class="mt-4 mb-4">
        <Carousel :pictures="photos"></Carousel>
    </div>
</template>

<script setup>
import theme from 'tailwindcss/defaultTheme';
import Carousel from '@/Components/Carousel.vue';

defineProps({
    photos: Object,
})
</script>