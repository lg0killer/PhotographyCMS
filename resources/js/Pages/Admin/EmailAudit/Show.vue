<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'

    let props = defineProps({
        emailAudit: Object
    });
</script>

<template>
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ emailAudit.subject }}
            </h2>
        </template>

        {{ emailAudit }}
    </AdminLayout>
</template>
