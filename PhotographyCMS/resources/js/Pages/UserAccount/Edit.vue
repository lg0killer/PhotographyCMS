<template>
    <form @submit.prevent="update">
        <div class="grid gap-4">
            <div>
                <label class="label">Name</label>
                <input class="input" type="text" v-model="form.name">
                <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
            </div>
            
            <div>
                <label class="label">Email</label>
                <input class="input" type="text" v-model="form.email">
                <div v-if="form.errors.email" class="error">{{ form.errors.email }}</div>
            </div>

            <div>
                <label class="label">Password</label>
                <input class="input" type="text" v-model="form.password">
                <div v-if="form.errors.password" class="error">{{ form.errors.password }}</div>
            </div>

            <div v-if="form.password">
                <label class="label">Confirm Password</label>
                <input class="input" type="text" v-model="form.password_confirmation">
            </div>

            <div>
                <button class="btn-primary" type="submit">Edit</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: null,
    password_confirmation: null,
})

const update = () => form.put(route('user-account.update', {user_account: props.user.id}))
</script>