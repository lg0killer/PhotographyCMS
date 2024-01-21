<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    description: '',
    short_code: '',
});

function create() {
    form.post(route('admin.category.store'), {
        preserveScroll: true,
    });
}

</script>

<template>
  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Categories
      </h2>
    </template>

    <form @submit.prevent="create">
      <div class="grid grid-cols-3 gap-4 p-4">
        <div class="col-span-3">
          <InputLabel for="name" value="Name" />
          <TextInput
              id="name"
              v-model="form.name"
              type="text"
              class="mt-1 block w-full"
          />
          <InputError :message="form.errors.name" class="mt-2" />
        </div>
        <div class="col-span-3">
          <InputLabel for="description" value="Description" />
          <TextInput
              id="description"
              v-model="form.description"
              type="text"
              class="mt-1 block w-full"
          />
          <InputError :message="form.errors.description" class="mt-2" />
        </div>
        <div class="col-span-3">
          <InputLabel for="short_code" value="Short Code" />
          <TextInput
              id="short_code"
              v-model="form.short_code"
              type="text"
              class="mt-1 block w-full"
          />
          <InputError :message="form.errors.short_code" class="mt-2" />
        </div>
        <div class="col-span-3">
          <PrimaryButton
              type="submit"
              :processing="form.processing"
              class="mt-4"
          >
              Create Category
          </PrimaryButton>
        </div>
      </div>
    </form>
  </AdminLayout>
</template>
