<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue'
import Pagination from '@/Components/Pagination.vue'
import { Link } from '@inertiajs/vue3';

defineProps({
    photos: Object,
})

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                My Vault
            </h2>
            <Link :href="route('vault.create')">
                <PrimaryButton>Upload Photo</PrimaryButton>
            </Link>
        </template>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
            <ImageBoxGallery :photos="photos"/>
        </div>

        <div v-if="photos.data.length" class="w-full flex justify-center">
            <Pagination :links="photos.links" class="text-gray-800 dark:text-gray-200"/>
        </div>
        <div v-else class="w-full py-20 flex justify-center text_input_label"> No Photos Found</div>
    </AppLayout>
</template>