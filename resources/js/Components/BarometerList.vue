<script setup>
defineProps({
    barometer: Object,
});

let dates = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
</script>

<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Name
            </th>
            <th v-for="date in dates" :key="date">
                <div class="px-6 py-3">
                    {{ date }}
                </div>
            </th>
          </tr>
        </thead>

        <tbody>
            <tr v-for="person in barometer" :key="person.id" class="bg-white border-b even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-700">
                <th scope="row">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" :src="person.profile_photo_url" alt=""/>
                        </div>
                        <div class="ml-4">
                            <div>
                                {{ person.name }}
                            </div>
                        </div>
                    </div>
                </th>
                <td v-for="date in dates" class="px-6 py-3">
                    <div class="ml-2" v-for="barometer in person.barometers">
                        <div v-if="date == barometer.month">
                            {{ barometer.points }}
                        </div>
                    </div>
                    <div class="ml-2" v-if="!person.barometers.find(barometer => barometer.month == date)">
                        -
                    </div>
                </td>
            </tr>
        </tbody>
      </table>
    </div>
</template>
