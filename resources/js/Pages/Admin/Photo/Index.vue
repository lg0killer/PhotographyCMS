<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3';
import PhotoFilter from '@/Components/PhotoFilter.vue';

import { ref, watch } from 'vue';

let props = defineProps({
    photos: Object,
    filters: Object,
    categories: Object,
    total_photos: Number,
    paginate: Object,
});

let awardedImage = ref();
let startDate = ref();
let endDate = ref();
let category = ref();
let photographer = ref();
let paginate = ref(props.filters.paginate || '10');

// Reload the page when the month or award status changes.
watch( [ awardedImage, startDate, endDate, category, photographer, paginate], ([ award, startDate, endDate, category, photographer, paginate])=> {
  router.get(route('admin.photo.index'), {
    awarded: award,
    startDate: startDate,
    endDate: endDate,
    category: category,
    photographer: photographer,
    paginate: paginate,
  }, {
    preserveState: true,
    preserveScroll: true,
    replace: true,
  })
});

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Photo Management ({{ total_photos }})
            </h2>

            <div>
              <Link :href="route('admin.photo.create')">
                  <PrimaryButton>Upload Photos</PrimaryButton>
              </Link>

              <PhotoFilter
                :categories="categories"
                :filters="filters"
                @update-filters="($event) => {
                  awardedImage = $event.awarded;
                  category = $event.category;
                  startDate = $event.startDate;
                  endDate = $event.endDate;
                  photographer = $event.photographer;
                  paginate = $event.paginate;
                }"
              />
          </div>
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
