<script setup>
let props = defineProps({
    categories: Object,
});
</script>

<template>
    <h2 id="category-heading">
        <button type="button" class="flex items-center justify-between w-full p-5 accordion_top" data-accordion-target="#category-body" aria-expanded="false" aria-controls="category-body">
        <span>What categories are available?</span>
        <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
        </svg>
        </button>
    </h2>
    <div id="category-body" class="hidden w-full" aria-labelledby="category-heading">
        <div class="border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
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
                    <th v-if="$page.props.auth.user.is_admin" scope="col" class="px-6 py-3">
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
                        <td v-if="$page.props.auth.user.is_admin" class="px-6 py-4 whitespace-nowrap">
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
</template>
