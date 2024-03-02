<script setup>
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue'
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import PhotoFilter from '@/Components/PhotoFilter.vue';

let props = defineProps({
  photos: Object,
  categories: Object,
  filters: Object,
})

let awardedImage = ref();
let startDate = ref();
let endDate = ref();
let category = ref();
let paginate = ref(props.filters.paginate || '10');

// Reload the page when the month or award status changes.
watch( [ awardedImage, startDate, endDate, category, paginate], ([ award, startDate, endDate, category, paginate])=> {
  router.get(route('photo.index'), {
    awarded: award,
    startDate: startDate,
    endDate: endDate,
    category: category,
    paginate: paginate,
  }, {
    preserveState: true,
    preserveScroll: true,
    replace: true,
  })
});
</script>

<template>
  <AppLayout title="Photos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Photos
      </h2>

      <PhotoFilter
        :categories="categories"
        :filters="filters"
        :filter_photographer="false"
        @update-filters="($event) => {
          awardedImage = $event.awarded;
          category = $event.category;
          startDate = $event.startDate;
          endDate = $event.endDate;
          paginate = $event.paginate;
        }"
      />

    </template>

    <div class="s:columns-1 md:columns-2 xl:columns-3 gap-2">
      <ImageBoxGallery :photos="photos" :UserInfo="true"/>
    </div>

    <div v-if="photos.data.length" class="w-full flex justify-center">
      <Pagination :links="photos.links" class="text-gray-800 dark:text-gray-200"/>
    </div>
    <div v-else class="w-full py-20 flex justify-center text_input_label"> No Photos Found</div>
  </AppLayout>
</template>
