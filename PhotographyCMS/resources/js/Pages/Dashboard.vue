<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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

        <!-- <div class="box">
            <h3 class="boxHeader">My Photos</h3>

            <div class="boxEmpty" v-if="!photos.data.length">
                <h3 class="text-gray-800 dark:text-gray-200 leading-tight p-1">No images uploaded</h3>
            </div>
            <div v-else>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                    <ImageBoxGallery :edit=true :photos="photos"/>
                </div>

                <div v-if="photos.data.length" class="w-full flex justify-center">
                    <Pagination :links="photos.links" class="text-gray-800 dark:text-gray-200"/>
                </div>
            </div>
        </div>


        <div class="box">
            <h3 class="boxHeader">My Submissions</h3>
            <div class="flex justify-center pb-4" v-if="!submittedPhotos.length">
                <h3 class="text-gray-800 dark:text-gray-200 leading-tight p-1">No images submitted</h3>
            </div>
        </div> -->
    </AppLayout>
</template>


<style scoped>
    .box {
        @apply flex flex-col border m-4 border-gray-100 dark:border-gray-700 rounded-md shadow-sm dark:text-gray-300
    }

    .boxHeader {
        @apply font-semibold text-gray-800 dark:text-gray-200 leading-tight p-1
    }

    .boxEmpty {
        @apply flex justify-center pb-4
    }
</style>