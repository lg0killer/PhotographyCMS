<template>
    <Box class="break-inside-avoid-column" @mouseover="visible = true" @mouseleave="visible = false">
        <div class="flex justify-between" v-if="visible">
            <!-- <a class="absolute left-1 top-1 fa fa-edit" v-if="edit" @click="editPhoto(photo)"/> -->
            <Link v-if="edit" :href="route('admin.photo.edit',photo)">
                <a class="absolute left-1 top-1 fa fa-edit" v-if="edit" />
            </Link>

            <a class="absolute right-1 top-1 fa fa-trash" v-if="edit" @click="deletePhoto(photo)"/>
        </div>
        <div class="max-w-sm rounded m-auto">
            <div class="relative">
                <div v-if="photo.awards" class="absolute">
                    <div v-for="award in photo.awards" :key="award.id" class="float-left">
                        <span class="award_yellow">{{ award.name }}</span>
                    </div>
                </div>
                <img class="object-center" :src="photo.image_path"/>
            </div>
        </div>
        <div v-if="UserInfo">
            <div>{{ photo.name }}</div>
            <div>{{ photo.category.name }}</div>
            <div v-if="photo.submitted_at">{{ photo.submitted_at }}</div>
            <div v-if="photo.score">{{ photo.score }}/15</div>
        </div>

        <div v-if="ClubInfo">
            <div>{{ photo.name }}</div>
            <div v-if="photo.owner">{{ photo.owner.name }}</div>
            <div v-if="photo.category">{{ photo.category.name }}</div>
        </div>
        <div v-if="AdminInfo">
            <div>{{ photo.name }}</div>
            <div v-if="photo.owner">{{ photo.owner.name }}</div>
            <div v-if="photo.score">{{ photo.score }}/15</div>
            <div class="flex justify-between">
                <div v-if="photo.category">{{ photo.category.name }}</div>
                <div v-if="photo.submitted_at">{{ photo.submitted_at .replace(' ','/') }}</div>
            </div>
        </div>
    </Box>
</template>

<script setup>
import Box from '@/Components/Box.vue'
import { router, Link } from '@inertiajs/vue3'

function editPhoto(photo) {
    router.get(route('admin.photo.edit', photo))
}

function deletePhoto(photo) {
    router.delete(route('admin.photo.destroy', photo), {
        preserveState: false,
        onSuccess: () => {
            router.reload()
        }
    })
}

defineProps({
    photo: Object,
    edit: Boolean,
    delete: Boolean,
    visible: Boolean,
    ClubInfo: Boolean,
    UserInfo: Boolean,
    AdminInfo: Boolean,
})

</script>