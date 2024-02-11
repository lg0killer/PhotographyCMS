<template>
  <div class="flex gap-1 py-2">
    <div v-for="(link, index) in links" :key="index" class="py-2 px-2 rounded-md">
      <div v-if = "link.url">
        <Link
          :is="link.url ? 'a' : 'span'"
          :href="link.url"
          :class="{'text-gray-300 dark:text-gray-400 cursor-default': ! link.url, 'font-bold text-gray-300 dark:text-gray-400 cursor-default': link.active}"
          v-html="link.label"
        />
      </div>
    </div>

    <!-- <Link
      :is="link.url ? 'a' : 'span'"
      v-for="(link, index) in links"
      :key="index" class="py-2 px-2 rounded-md" 
      :href="link.url"
      :class="{'text-gray-300 dark:text-gray-400 cursor-default': ! link.url, 'font-bold text-gray-300 dark:text-gray-400 cursor-default': link.active}"
      v-html="link.label"
    /> -->
  </div>

</template>

<script setup>
  import { Link } from '@inertiajs/vue3'
  defineProps({
    links: Array,
  })
</script>
