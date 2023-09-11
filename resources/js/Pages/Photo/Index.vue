<script setup>
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue'
import Pagination from '@/Components/Pagination.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

let props = defineProps({
  photos: Object,
  user: Object,
  theme: Object,
  filters: Object,
})

let awardedImage = ref(props.filters.awarded);

watch(awardedImage, value => {
  // router.reload({ query: { awarded: value } });
  router.get(route('photo.index'), { awarded: value }, {
    preserveState: true,
    preserveScroll: true,
  })
  // Inertia.get(route('clubphoto.index', { awarded: value }));
});

</script>

<template>
  <AppLayout title="Photos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Photos
      </h2>

      <PrimaryButton v-if="awardedImage" @click="awardedImage = !awardedImage">Award Images</PrimaryButton>
      <SecondaryButton v-if="!awardedImage" @click="awardedImage = !awardedImage">Award Images</SecondaryButton>

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
