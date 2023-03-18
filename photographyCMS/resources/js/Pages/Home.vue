<script setup>
import AppLayout from '@/Layouts/AppLayoutExternal.vue';
import WelcomeMessage from '@/Components/WelcomeMessage.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <AppLayout title="Home" canLogin=canLogin canRegister=canRegister>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Home
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <WelcomeMessage />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
