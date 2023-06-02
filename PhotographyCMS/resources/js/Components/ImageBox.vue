<template>
    <Box class="relative" @mouseover="visible = true" @mouseleave="visible = false">
        <div class="flex justify-between" v-if="visible">
            <a class="absolute left-1 top-1 fa fa-edit" v-if="edit" @click="editPhoto(photo)"/>
            <a class="absolute right-1 top-1 fa fa-trash" v-if="edit" @click="deletePhoto(photo)"/>
        </div>
        <div class="max-w-sm rounded overflow-hidden">
            <img class="w-full" :src="photo.image"/>
        </div>
        <div v-if="edit">
        </div>
        <div class="text flex flex-colomn justify-between mt-3">
            <div>{{ photo.owner.name }}</div>
            <div>{{ photo.category.name }}</div>            
        </div>
    </Box>
</template>

<script setup>
import Box from '@/Components/Box.vue'
import { router } from '@inertiajs/vue3'

function editPhoto(photo) {
    router.get(route('photo.edit', photo))
}

function deletePhoto(photo) {
    router.delete(route('photo.destroy', photo), {
        preserveState: false,
        onSuccess: () => {
            router.reload()
        }
    })
}

defineProps({
    photo: Object,
    edit: Boolean,
    visible: Boolean,
})

</script>