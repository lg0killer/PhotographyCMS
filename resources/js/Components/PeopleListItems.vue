<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Name
            </th>
            <th scope="col" class="px-6 py-3">
              Status
            </th>
            <th scope="col" class="px-6 py-3">
              Role
            </th>
            <th scope="col" class="px-6 py-3">
              Photos
            </th> 
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Edit</span>
            </th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="person in people" :key="person.id" class="bg-white border-b even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <img class="h-10 w-10 rounded-full" :src="person.profile_photo_url" alt=""/>
                </div>
                <div class="ml-4">
                  <div>
                    {{ person.name }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ person.email }}
                  </div>
                </div>
              </div>
            </th>
            <td class="px-6 py-4 whitespace-nowrap">
              <div v-if="person.blocked">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                  Blocked
                </span>
              </div>
              <div v-if="person.email_verified_at">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
              </div>
              <div v-else>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                  Unverified
                </span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div v-if="person.is_admin">Admin</div>
              <div v-else>Member</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div>{{ person.photos_count }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <Link class="primary_button" :href="route('admin.user.edit',{'user': person.id})">Edit</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</template>
  
<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    people: Object,
});
</script>