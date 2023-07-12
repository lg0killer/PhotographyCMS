<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ImageBoxGallery from '@/Components/ImageBoxGallery.vue'
import ListSection from '@/Components/ListSection.vue';
import Pagination from '@/Components/Pagination.vue'
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch, onMounted, computed } from 'vue';

import { initFlowbite } from 'flowbite'

import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

onMounted(() => {
    initFlowbite();
})

let props = defineProps({
  photos: Object,
  filters: Object,
  categories: Object,
  photographers: Object,
});

const awardedImage = ref( props.filters.awarded || false );
const month = ref({
  month: parseInt(props.filters.month) -1 || new Date().getMonth(),
  year: parseInt(props.filters.year) || new Date().getFullYear(),
});
const category = ref(props.filters.category || '');
const photographer = ref(props.filters.photographer || '');

//const monthNames = new Intl.DateTimeFormat('en-US', { month: 'long' }).format;
const monthLabel = computed( () => {
  return new Date(month.value.year, month.value.month, 1).toLocaleString('default', { month: 'long', year: 'numeric'});
  });
//const monthLabel = ref(monthNames(new Date(month.year, month.month)));

// Reload the page when the month or award status changes.
watch( [ awardedImage, month, category, photographer ], ([ award, month, category, photographer ])=> {
  router.get(route('clubphoto.index'), { 
    awarded: award, 
    month: month['month']+1, 
    year: month['year'],
    category: category,
    photographer: photographer,
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

      <!-- Filter Dropdown -->
      <button 
        id="dropdownSearchButton" 
        data-dropdown-toggle="dropdownSearch" 
        data-dropdown-placement="bottom" 
        class="filter_button" 
        type="button"
      >
        Filter
        <svg 
          class="w-4 h-4 ml-2" 
          aria-hidden="true" 
          fill="none" 
          stroke="currentColor" 
          viewBox="0 0 24 24" 
          xmlns="http://www.w3.org/2000/svg"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>

      <!-- Dropdown menu -->
      <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
          <!-- User Search -->
          <div class="px-3 pt-3">
            <div class="relative" data-tooltip-target="tooltip-username">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
              </div>
              <input v-model="photographer" type="text" id="input-group-search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search user">
            </div>
            <div id="tooltip-username" role="tooltip" class="invisible tooltip_text">
              Filter images by user names
              <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
          </div>

          <!-- Date filter -->
          <div class="px-3 pt-3">
            <div class="relative">
              <VueDatePicker input-class-name="dp_theme_dark" dark v-model="month" month-picker />
              <div id="tooltip-calendar" role="tooltip" class="invisible tooltip_text">
                Filter images by month and year
                <div class="tooltip-arrow" data-popper-arrow></div>
              </div>
            </div>
          </div>

          <!-- Category -->
          <div class="px-3 pt-3">
            <label for="categories"></label>
            <select name="categories" v-model="category" id="categories" class="dropdown_selects">
              <option value="">Category</option>
              <option v-for="category in categories" :value="category.name">{{ category.name }}</option>
            </select>
          </div>

          <!-- Checkboxes -->
          <ul class="h-48 px-3 py-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
            <li>
              <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <input id="checkbox-awarded-photos" v-model="awardedImage" type="checkbox" :checked="awardedImage" :value="awardedImage" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                <label for="checkbox-awarded-photos" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Awarded Photos</label>
              </div>
            </li>
          </ul>
      </div>

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

<style scoped>
.dp__theme_dark {
  --dp-background-color: #4B5563;
  --dp-menu-background-color: #4B5563;
  --dp-text-color: #ffffff;
  --dp-hover-color: #484848;
  --dp-hover-text-color: #ffffff;
  --dp-hover-icon-color: #959595;
  --dp-primary-color: #005cb2;
  --dp-primary-text-color: #ffffff;
  --dp-secondary-color: #a9a9a9;
  --dp-border-color: #2d2d2d;
  --dp-menu-border-color: #2d2d2d;
  --dp-border-color-hover: #aaaeb7;
  --dp-disabled-color: #737373;
  --dp-scroll-bar-background: #212121;
  --dp-scroll-bar-color: #484848;
  --dp-success-color: #00701a;
  --dp-success-color-disabled: #428f59;
  --dp-icon-color: #959595;
  --dp-danger-color: #e53935;
  --dp-highlight-color: rgba(0, 92, 178, 0.2);
  }
</style>