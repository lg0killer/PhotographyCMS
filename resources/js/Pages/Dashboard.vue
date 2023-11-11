<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CategoryDonutChart from '@/Components/CategoryDonutChart.vue';

let props = defineProps({
    user_data: Object,
    club_data: Object,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
            <!-- <Link :href="route('photo.create')">
                <PrimaryButton>Upload Photo</PrimaryButton>
            </Link> -->
        </template>

        <div class="box mx-auto py-5">
            <h3 class="boxHeader">Submission Statistics</h3>
            <div class="boxEmpty" v-if="!user_data">
                <h3 class="text-gray-800 dark:text-gray-200 leading-tight p-1">No images uploaded</h3>
            </div>
            <div v-else class="">
                <div class="s:columns-1 md:columns-2 px-auto">
                    <CategoryDonutChart :series="user_data.series" :chartOptions="user_data.chartOptions"></CategoryDonutChart>
                    <CategoryDonutChart :series="club_data.series" :chartOptions="club_data.chartOptions"></CategoryDonutChart>
                </div>
            </div>
        </div>

    </AppLayout>
</template>


<style scoped>
    .box {
        @apply flex flex-col m-4 border-gray-100 dark:border-gray-700 rounded-md shadow-sm dark:text-gray-300
    }

    .boxHeader {
        @apply font-semibold text-gray-800 dark:text-gray-200 leading-tight p-1
    }

    .boxEmpty {
        @apply flex justify-center pb-4
    }
</style>
