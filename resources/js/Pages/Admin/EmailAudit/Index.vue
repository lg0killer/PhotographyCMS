<script setup>
  import AdminLayout from '@/Layouts/AdminLayout.vue'


  let props = defineProps({
    emailAudits: Object
  });

  function jsonTONames(json) {
    return json.map((item) => item.email).join(', ');
  }
</script>

<template>
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Email Audit
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <!-- Headers -->
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        Subject
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Sent to
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Status
                        </th>
                    </tr>
                    </thead>

                    <!-- Data -->
                    <tbody>
                        <tr v-for="email in emailAudits.data" :key="email.id" class="bg-white border-b even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-700">
                            <th class="px-6 py-4 whitespace-nowrap">
                                <a :href="`/admin/emailaudit/${email.id}`" class="text-blue-500 hover:underline">
                                    {{ email.subject }}
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                {{ jsonTONames(email.to) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ email.status }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
