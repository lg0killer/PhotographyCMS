<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    photos: Object,
    total_photos: Number,
});

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Photo Management ({{ total_photos }})
            </h2>
            <Link :href="route('admin.photo.create')">
                <PrimaryButton>Upload Photos</PrimaryButton>
            </Link>
        </template>

        <div class="s:columns-1 md:columns-2 xl:columns-3 gap-2">
            <ImageBoxGallery :photos="photos" :AdminInfo="true" :edit="true" :delete="true"/>
        </div>

        <div v-if="photos.data.length" class="w-full flex justify-center">
            <Pagination :links="photos.links" class="text-gray-800 dark:text-gray-200"/>
        </div>
        <div v-else>
            <div class="w-full py-6 flex justify-center text_input_label"> No Photos Found</div>
        </div>
    </AppLayout>
</template>