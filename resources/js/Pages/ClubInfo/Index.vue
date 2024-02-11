<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { initFlowbite } from 'flowbite'
import { ref, watch, onMounted, computed } from 'vue';
import CategoryPartial from '@/Pages/ClubInfo/Partials/00-Categories.vue';
import SubmissionsPartial from '@/Pages/ClubInfo/Partials/01-Submissions.vue';

onMounted(() => {
    initFlowbite();
})

let props = defineProps({
    categories: Object,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Club Information
            </h2>
        </template>

        <div class="box mx-auto py-5">
            <div id="information" class="w-full  p-10" data-accordion="collapse" data-active-classes="bg-blue-100 dark:bg-gray-700 text-blue-600 dark:text-white">
                <CategoryPartial :categories="categories"/>
                <SubmissionsPartial />
            </div>
        </div>
    </AppLayout>
</template>
