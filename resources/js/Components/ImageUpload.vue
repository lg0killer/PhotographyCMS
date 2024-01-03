<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from "vue";

// Import FilePond
import vueFilePond, { setOptions } from 'vue-filepond';

import {watch} from 'vue';


 // Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
import FilePondPluginFileMetadata from 'filepond-plugin-file-metadata';

// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const props = defineProps({
    user: Object,
    csrf_token: String
});

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview, FilePondPluginFileMetadata);


var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// Set global options on filepond init
const handleFilePondInit = () => {
    setOptions({
        credits: false,
        server: {
            url: '/filepond',
            headers: {
                'X-CSRF-TOKEN': csrf_token,
            }
        }
    });
};

const filepondGalleryInput = ref(null); // Reference the input to clear the files later

let month = ref({
    month: new Date().getMonth(),
    year: new Date().getFullYear(),
});

watch(month, (newValue) => {
    form.month = newValue.month + 1;
    form.year = newValue.year;
});

const form = useForm({
    gallery: [],
    month: new Date().getMonth()+1,
    year: new Date().getFullYear(),
});

const submit = () => {
  form
    .transform((data) => {
        return {
            ...data,
            gallery: data.gallery.map(item => item.serverId) // Pluck only the serverIds
        }
    })
    .put(route('admin.photo.store'), {
        onSuccess: () => {
            filepondGalleryInput.value.removeFiles();
        },
    });
};

// Set the server id from response
const handleFilePondGalleryProcess = (error, file) => {
    form.gallery.push({id: file.id, serverId: file.serverId});
};
// Remove the server id on file remove
const handleFilePondGalleryRemoveFile = (error, file) => {
    form.gallery = form.gallery.filter(item => item.id !== file.id);
}

</script>

<template>
  <form @submit.prevent="submit">
    <div id="app">
      <file-pond
        name="gallery"
        ref="filepondGalleryInput"
        class-name="my-pond"
        allow-multiple="true"
        accepted-file-types="image/*"
        @init="handleFilePondInit"
        @processfile="handleFilePondGalleryProcess"
        @removefile="handleFilePondGalleryRemoveFile"
      />
    </div>
    <div v-if="form.errors">
        <div v-for="(error, index) in form.errors" class="text-red-500">{{ error }}</div>
    </div>

    <button
        type="submit"
        class="inline-flex items-center justify-center mt-3 p-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition w-full"
        :disabled="form.processing"
    >
        Submit
    </button>
  </form>
</template>
