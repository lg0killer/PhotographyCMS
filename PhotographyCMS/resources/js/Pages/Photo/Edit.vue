<template>
  <form @submit.prevent="update">
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
        <label class="label">Image</label>
        <input class="input" type="text" v-model="form.image">
        <div v-if="form.errors.image" class="error">{{ form.errors.image }}</div>
      </div>

      <div>
        <button class="btn-primary" type="submit">Edit</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
  photo: Object,
})

const form = useForm({
  name: props.photo.name,
  description: props.photo.description,
  image: props.photo.image,
})

const update = () => form.put(route('photo.update', {photo: props.photo.id}))
</script>


