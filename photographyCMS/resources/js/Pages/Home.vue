<script setup>
import AppLayout from '@/Layouts/AppLayoutExternal.vue'
import WelcomeMessage from '@/Components/WelcomeMessage.vue'

import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'


defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  photos: Array,
})

</script>

<template>
  <AppLayout title="Home" can-login="canLogin" can-register="canRegister">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Home
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
          <WelcomeMessage />
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h1>Photos</h1>
      <carousel :items-to-show="1.5">
        <slide v-for="photo in photos" :key="photo">
          <img :src="photo.path" class="carousel__itme h-75" alt="" />
        </slide>

        <template #addons>
          <navigation />
          <pagination />
        </template>
      </carousel>
    </div>
  </AppLayout>
</template>
