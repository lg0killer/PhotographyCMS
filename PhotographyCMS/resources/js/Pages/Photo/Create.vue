<template>
  <AppLayout title="Photos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Photos
      </h2>
    </template>

  <form enctype="multipart/form-data" @submit.prevent="create">
    <div class="grid grid-cols-3 gap-4 p-4">
      <div class="col-span-3">
        <InputLabel for="name" value="Image Name" />
        <TextInput
            id="name"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
        />
        <InputError :message="form.errors.name" class="mt-2" />
      </div>

      <div class="col-span-3">
        <InputLabel for="description" value="Image Description" />
        <TextInput
            id="description"
            v-model="form.description"
            type="text"
            class="mt-1 block w-full"
        />
        <InputError :message="form.errors.description" class="mt-2" />
      </div>

      <div class="col-span-3">
        <InputLabel for="category" value="Image Category" />
        <select class="dropdown_input" v-model="form.category_id">
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
        </select>
        <InputError :message="form.errors.category_id" class="mt-2" />
      </div>

      <div class="col-span-3">
        <InputLabel for="image" value="Image" />
        <input 
          class="image_input"
          type="file" 
          name="image" 
          ref="imageInput"
          @input="form.image = $event.target.files[0]">
        <InputError :message="form.errors.image" class="mt-2" />
      </div>

      <div class="col-span-4" dir="rtl">
        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          <span v-if="form.processing">Creating</span>
          <span v-else>Create</span>
        </PrimaryButton>
      </div>
    </div>
  </form>
  </AppLayout>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';


defineProps({
  categories: Object,
})

let form = useForm({
  name: '',
  description: '',
  category_id: '',
  image: null,
})

let create = () => {
  form.post(route('photo.store'))
  //form.post(route('photo.store'))
}
</script>

