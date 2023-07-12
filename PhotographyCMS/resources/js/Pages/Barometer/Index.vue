<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BarometerList from '@/Components/BarometerList.vue';
defineProps({
    barometer: Object,
});
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Barometer
            </h2>
        </template>

        <div>
            <BarometerList :barometer="barometer.data" />
        </div>
    </AppLayout>
</template>