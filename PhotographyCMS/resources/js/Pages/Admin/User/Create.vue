<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    is_admin: false,
});

const create = () => form.post(route('admin.user.store'));

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create User
            </h2>
        </template>

        <form @submit.prevent="create">
            <div class="grid grid-cols-4 gap-4 p-4">
                <div class="col-span-2">
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-2">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="col-span-2">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>

                <div class="col-span-3">
                    <InputLabel for="is_admin" value="Is Admin" />
                    <Checkbox 
                        id="is_admin"
                        type="checkbox"
                        checked: form.is_admin
                    />
                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="col-span-4" dir="rtl">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <span v-if="form.processing">Updating</span>
                        <span v-else>Create</span>
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </AppLayout>
</template>