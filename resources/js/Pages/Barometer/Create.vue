<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, router } from '@inertiajs/vue3';
import { onMounted, ref,watch } from 'vue';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

let props = defineProps({
    user: Object,
    filters: Object,
});


let month = ref({
    month: parseInt(props.filters.month) -1 || new Date().getMonth(),
    year: parseInt(props.filters.year) || new Date().getFullYear(),
});

watch(month, (newValue) => {
  form.month = parseInt(newValue.month) +1;
  form.year = parseInt(newValue.year);
  router.get(route('barometer.create'), {
    month: form.month, 
    year: form.year 
  });
  calculate_points();
});

let form = useForm({
    points: [],
    month: parseInt(props.filters.month) || new Date().getMonth() + 1,
    year: parseInt(props.filters.year) || new Date().getFullYear(),
});

let points =ref([]);

function calculate_points() {
    for (let i = 0; i < props.user.data.length; i++) {
        if (props.user.data[i].barometers.length > 0) {
            points.value[props.user.data[i].id] = props.user.data[i].barometers[0].points;
        }
    }
}

onMounted(() => {
    calculate_points();
});

function submitForm() {
    for (let i = 0; i < props.user.data.length; i++) {
        form.points.push({
            id: props.user.data[i].id,
            points: points.value[props.user.data[i].id] || 0,
        });
    }
    form.post(route('barometer.store'));
}

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
               Update Barometer
            </h2>

            <div>
                <VueDatePicker class="py-4 overflow-y-visible" dark v-model="month" month-picker />
            </div>  
        </template>
        <div class="overflow-x-auto">
            <form @submit.prevent="submitForm">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
                        <tr scope="col" class="px-6 py-3">
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Points</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <tr v-for="person in props.user.data" :key="person.id" class="bg-white border-b even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-700">
                            <th scope="row">
                                <div class="ml-4 text_input_label">
                                    {{ person.name }}
                                </div>  
                            </th>
                            <td class="px-6 py-3">
                                <input class="text_input" type="text" v-model="points[person.id]">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end m-5">
                    <button type="submit" class="primary_button">Save</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>