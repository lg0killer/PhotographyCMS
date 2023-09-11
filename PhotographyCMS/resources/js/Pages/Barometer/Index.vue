<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BarometerList from '@/Components/BarometerList.vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
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
            <div v-if="$page.props.auth.user.is_admin" class="flex">
                <Link :href="route('barometer.create')">
                    <PrimaryButton>Update Barometer</PrimaryButton>
                </Link>
            </div>
        </template>

        <div>
            <BarometerList :barometer="barometer.data" />
        </div>
    </AppLayout>
</template>