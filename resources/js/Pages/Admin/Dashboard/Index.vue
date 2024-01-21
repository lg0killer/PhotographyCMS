<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue'

  let props = defineProps({
    user_activity: Object
  });
</script>

<template>
  <AdminLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Admin Dashboard
      </h2>
    </template>

    <div class="box mx-auto py-5">
      <h3 class="boxHeader">User Statistics</h3>

      <h4 class="boxHeader2">Latest Logins</h4>
      <div class="boxEmpty" v-if="!user_activity">
        <h3 class="text-gray-800 dark:text-gray-200 leading-tight p-1">No new logins</h3>
      </div>
      <div v-else>
          <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <!-- Headers -->
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                    Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Last Login
                    </th>
                </tr>
              </thead>

              <!-- Data -->
              <tbody>
                <tr v-for="user in user_activity" :key="user.id" class="bg-white border-b even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-700">
                  <th class="px-6 py-4 whitespace-nowrap">
                      {{ user.name }}
                  </th>
                  <td class="px-6 py-4">
                    {{ user.last_login }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div> 
      </div>
    </div>
    
  </AdminLayout>
</template>

<style scoped>
    .box {
        @apply flex flex-col m-4 border-gray-100 dark:border-gray-700 rounded-md shadow-sm dark:text-gray-300
    }

    .boxHeader {
        @apply font-semibold text-gray-800 dark:text-gray-200 leading-tight p-1
    }

    .boxHeader2 {
        @apply font-semibold text-gray-800 dark:text-gray-200 leading-tight p-4
    }

    .boxEmpty {
        @apply flex justify-center pb-4
    }
</style>
