<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineProps, ref, onMounted } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, Link } from '@inertiajs/vue3'

let props = defineProps({
    categories: Object,
})

const processing = ref(false);

function deleteCategory(category) {
    if (confirm('Are you sure you want to delete category ' + category.name + '?')) {
        processing.value = true;
        router.delete(route('admin.category.destroy', {'category': category.id}), {
            onSuccess: () => {
                processing.value = false;
            },
        });
    }
}
</script>

<template>
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Categories
            </h2>
            <Link :href="route('admin.category.create')">
                <PrimaryButton>Add Category</PrimaryButton>
            </Link>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <!-- Headers -->
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>

                    <!-- Data -->
                    <tbody>
                        <tr v-for="category in categories" :key="category.id" class="bg-white border-b even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-700">
                            <th class="px-6 py-4 whitespace-nowrap">
                                {{ category.name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ category.description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div>
                                            <a :href="route('admin.category.edit',category)" >Edit</a>
                                        </div>
                                        <div>
                                            <Link @click="deleteCategory(category)" >Delete</Link>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
