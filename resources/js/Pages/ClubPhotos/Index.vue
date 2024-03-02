<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue'
import ListSection from '@/Components/ListSection.vue';
import Pagination from '@/Components/Pagination.vue'
import { router } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import PhotoFilter from '@/Components/PhotoFilter.vue';

let props = defineProps({
  photos: Object,
  filters: Object,
  categories: Object,
  photographers: Object,
  paginate: Object,
});

let awardedImage = ref();
let startDate = ref(props.filters.startDate);
let endDate = ref(props.filters.endDate || null);
let category = ref();
let photographer = ref();
let paginate = ref(props.filters.paginate || '10');

const monthLabel = computed( () => {
  if (endDate.value != null && (startDate.value.year != endDate.value.year || startDate.value.month != endDate.value.month)) {
    let start_month = new Date(startDate.value.year, startDate.value.month, 1).toLocaleString('default', { month: 'long', year: 'numeric'});
    let end_month = new Date(endDate.value.year, endDate.value.month, 1).toLocaleString('default', { month: 'long', year: 'numeric'});
    return `${start_month} - ${end_month}`;
  } else {
    return new Date(startDate.value.year, startDate.value.month, 1).toLocaleString('default', { month: 'long', year: 'numeric'});
  }
  });

// Reload the page when the month or award status changes.
watch( [ awardedImage, startDate, endDate, category, photographer, paginate ], ([ award, startDate, endDate, category, photographer, paginate])=> {
  router.get(route('clubphoto.index'), {
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
              Club Photos
          </h2>

          <PhotoFilter
            :categories="categories"
            :filters="filters"
            :monthly_range="true"
            @update-filters="($event) => {
              awardedImage = $event.awarded;
              category = $event.category;
              startDate = $event.startDate;
              endDate = $event.endDate;
              photographer = $event.photographer;
              paginate = $event.paginate;
            }"
          />

    </template>


    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <ListSection >
        <template #title>
            {{ monthLabel }}
        </template>

        <template #form>
          <div v-if="photos.data.length">
            <div class="s:columns-1 md:columns-2 xl:columns-3 gap-2">
              <ImageBoxGallery :photos="photos" :ClubInfo="true"/>
            </div>
        </div>
        <div v-else class="w-full py-2 flex justify-center text_input_label"> No Photos Found</div>
        </template>
      </ListSection>
    </div>

    <div v-if="photos.data.length" class="w-full flex justify-center">
      <Pagination :links="photos.links" class="text-gray-800 dark:text-gray-200"/>
    </div>
    </AppLayout>
</template>
