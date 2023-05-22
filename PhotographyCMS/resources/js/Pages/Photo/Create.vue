<template>
  <form enctype="multipart/form-data" @submit.prevent="create">
    <div class="grid grid-cols-3 gap-4">
      <div class="col-span-3">
        <label class="label">Image Name</label>
        <input class="input" type="text" v-model="form.name">
        <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
      </div>

      <div class="col-span-3">
        <label class="label">Image Description</label>
        <input class="input" type="text" v-model="form.description">
        <div v-if="form.errors.description" class="error">{{ form.errors.description }}</div>
      </div>

      <div class="col-span-3">
        <label class="label">Category</label>
        <select class="input" v-model="form.category_id">
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
        <div v-if="form.errors.category_id" class="error">{{ form.errors.category_id }}</div>
      </div>

      <div class="col-span-4">
        <label class="label">Image</label>
        <input 
          class="w-full border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
          type="file" 
          name="image" 
          @input="form.image = $event.target.files[0]">
        <div v-if="form.errors.image" class="error">{{ form.errors.image }}</div>
      </div>

      <div class="col-span-4" dir="rtl">
        <button class="btn-primary" type="submit">Submit</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'

defineProps({
  categories: Object,
})

const form = useForm({
  name: '',
  description: '',
  category_id: '',
  image: null,
})

const create = () => form.post(route('photo.store'))
</script>

