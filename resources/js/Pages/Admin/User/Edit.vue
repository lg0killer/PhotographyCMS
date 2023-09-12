<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import RedButton from '@/Components/RedButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import DeleteUser from '@/Pages/Admin/User/Partials/DeleteUser.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    score: props.user.score,
    password: '',
    password_confirmation: '',
    is_admin: props.user.is_admin ? true : false,
    email_verified_at: props.user.email_verified_at ? true : false,
});

const update = () => {
        form.transform(data => ({
            ...data,
            is_admin: form.is_admin ? 1 : 0,
            email_verified_at: form.email_verified_at ? new Date().toISOString().slice(0, 19).replace('T', ' ') : null,
        })).put(route('admin.user.update', { user: props.user.id }));
    };
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit User
            </h2>
        </template>

        <form @submit.prevent="update">
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
                <div v-if="form.password" class="col-span-2">
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
                    <InputLabel for="is_admin" value="Admin" />
                    <input type="checkbox" v-model="form.is_admin" id="is_admin" :checked="form.is_admin" :value="form.is_admin" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <InputError :message="form.errors.is_admin" class="mt-2" />
                </div>

                <!-- add an email verified tick box and set date to today-->
                <div class="col-span-3">
                    <InputLabel for="email_verified_at" value="Email Verified" />
                    <input type="checkbox" v-model="form.email_verified_at" id="email_verified_at" :checked="form.email_verified_at" :value="form.email_verified_at" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <InputError :message="form.errors.email_verified_at" class="mt-2" />
                </div>

                <div class="col-span-4 flex justify-between" dir="rtl">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <span v-if="form.processing">Updating</span>
                        <span v-else>Update</span>
                    </PrimaryButton>
                    <DeleteUser :user="props.user" />
                </div>
            </div>
        </form>

    </AppLayout>
</template>