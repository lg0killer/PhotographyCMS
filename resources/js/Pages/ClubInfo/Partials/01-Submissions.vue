<script setup>

</script>

<template>
    <h2>
        <button type="button" class="flex items-center justify-between w-full p-5 accordion_middle" data-accordion-target="#dimentions-body" aria-expanded="false" aria-controls="dimentions-body">
        <span>What dimentions can I submit in?</span>
        <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
        </svg>
        </button>
    </h2>
    <div id="dimentions-body" class="hidden w-full" aria-labelledby="dimentions-heading">
        <div class="border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                </p>
            </div>
        </div>
    </div>
</template>
