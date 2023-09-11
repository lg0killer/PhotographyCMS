<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import ListSection from '@/Components/ListSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import PeopleListItems from '@/Components/PeopleListItems.vue';

defineProps({
    users: Array,
});

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                User Management
            </h2>
            <Link :href="route('admin.user.create')">
                <PrimaryButton>Create User</PrimaryButton>
            </Link>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <ListSection >
                <template #title>
                    Users
                </template>
                <template #description>
                    Manage users
                </template>

                <template #form>
                    <div v-if="users.data.length">
                        <PeopleListItems :people="users.data" />
                    </div>
                    <div v-else class="w-full py-2 flex justify-center text_input_label"> No Users Found</div>
                </template>
            </ListSection>
        </div>
    </AppLayout>
</template>