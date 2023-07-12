<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import {ref,watch} from 'vue';
import { useForm } from '@inertiajs/vue3';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

let month = ref({
  month: new Date().getMonth(),
  year: new Date().getFullYear(),
});

watch(month, (newValue) => {
  form.month = newValue.month + 1;
  form.year = newValue.year;
});

let form = useForm({
  images: [],
  month: new Date().getMonth()+1,
  year: new Date().getFullYear(),
});

let images = ref([]);

function previewImages(event) {
  const files = event.target.files;
  if (files) {
    previewImagesFiles(files);
  }
}

function previewImagesFiles(files) {
  images.value = [];
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const reader = new FileReader();
    reader.onload = (e) => {
      images.value.push({
        file,
        preview: e.target.result,
      });
    };
    reader.readAsDataURL(file);
  }
}

function removeImage(index) {
  images.value.splice(index, 1);
}

function submitForm() {
  for (let i = 0; i < images.value.length; i++) {
    form.images.push(images.value[i].file)
  }
  //form.month = month['month']+1;
  //form.year = month['year'];
  // Send formData to server using axios or fetch
  form.post(route('admin.photo.store'),{
    preserveScroll: true,
    preserveState: true,
    onError: () => {
      form.images = [];
      let newImages = [];
      const errorMessages = form.errors;
      for (const key in errorMessages) {
        for (let i = 0; i < images.value.length; i++) {
          if (errorMessages.hasOwnProperty(key)) {
            if (images.value[i].file.name.includes(key)) {
              newImages.push(images.value[i]);
              continue;
            }
          }
        }
      }
      for (let i = images.value.length; i >= 0; i--) {
        if (!newImages.includes(images.value[i])) {
          removeImage(i);
        }
      }
    },
  })
}

</script>

<template>
  <AppLayout class="!overflow-hidden">
    <form @submit.prevent="submitForm">
      <div class="flex flex-col gap-4 p-4">
        <div class="flex flex-wrap flex-col m-4">
          <input class="image_input" type="file" name="images[]" multiple @change="previewImages" />
          <VueDatePicker class="py-4 overflow-y-visible" dark v-model="month" month-picker />
          <div class="col-span-4" dir="rtl">
            <PrimaryButton class="" type="submit">Submit</PrimaryButton>
          </div>
          <div v-for="errormessage in form.errors" :key="errormessage">
            <InputError :message="errormessage" class="mt-2" />
          </div>
        </div>
        <!-- Preview Pannel -->
        <div class="flex flex-wrap justify-center flex-auto gap-4">
          <div v-for="(image, index) in images" :key="index" class="flex flex-col w-1/4">
            <img :src="image.preview" class="w-full h-auto" />
            <TextInput :value="image.file.name" class="w-full my-2" />
            <SecondaryButton @click="removeImage(index)">Delete image {{ index }}</SecondaryButton>
            <InputError :message="form.errors[image.file.name.split('.').slice(0, -1).join('.')]" class="mt-2" />
          </div>
        </div>
      </div>
    </form>
  </AppLayout>
</template>