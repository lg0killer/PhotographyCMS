<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

let props = defineProps({
    photo: Object,
    awards: Object,
    categories: Object,
});

const processing = ref(false);

const form = useForm({
    name: props.photo.name,
    category: props.photo.category.name,
    submitted_at: props.photo.submitted_at,
    score: props.photo.score,
    awards: props.photo.awards.map((award) => award.id),
});

const update = () => form.put(route('admin.photo.update', props.photo.id), {
    onStart: () => {
        processing.value = true;
    },
    onSuccess: () => {
        processing.value = false;
        form.reset();
    },
    onError: () => {
        processing.value = false;
    },
});
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Photo
            </h2>
        </template>

        <form @submit.prevent="update">
            <div class="grid grid-cols-3 gap-4 p-4">
                <div class="col-span-3">
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        :disabled="true"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-3">
                    <InputLabel for="category" value="Category" />
                    <select class="dropdown_input" v-model="form.category">
                        <option v-for="category in categories" :key="category.id" :value="category.name" :selected="category.name === form.category">{{ category.name }}</option>
                    </select>
                    <InputError :message="form.errors.category" class="mt-2" />
                </div>

                <div class="col-span-3">
                    <InputLabel for="submitted_at" value="Submitted At" />
                    <TextInput
                        id="submitted_at"
                        v-model="form.submitted_at"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.submitted_at" class="mt-2" />
                </div>

                <div class="col-span-3">
                    <InputLabel for="score" value="Score" />
                    <TextInput
                        id="score"
                        v-model="form.score"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.score" class="mt-2" />
                </div>

                <div class="col-span-3">
                    <InputLabel for="awards" :value="`Awards (${form.awards.length})`"/>
                    <select class="dropdown_input" multiple v-model="form.awards">
                        <option v-for="award in awards" :key="award.id" :value="award.id" :selected="form.awards.includes(award.id)" >{{ award.name }}</option>
                    </select>
                    <InputError :message="form.errors.awards" class="mt-2" />
                </div>

                <div class="col-span-3" dir="rtl">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <span v-if="form.processing">Updating</span>
                        <span v-else>Update</span>
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </AppLayout>
</template>