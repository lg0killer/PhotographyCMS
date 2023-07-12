<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({
    barometer: Object,
});
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
               Update Barometer
            </h2>
        </template>

        <div>
            <form @submit.prevent="update">
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>
            </form>
        </div>
    </AppLayout>
</template>