<script setup>
import VueHcaptcha from '@hcaptcha/vue3-hcaptcha';
import { useForm,Link } from '@inertiajs/vue3'
import { ref } from 'vue';

import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const verified = ref(false);
const expired = ref(false);
const token = ref("");
const eKey = ref("");
const error = ref("");
const invisibleHcaptcha = ref(null);
const asyncExecuteHCaptcha = ref(null);

function onVerify(tokenStr, ekey) {
    verified.value = true;
    token.value = tokenStr;
    eKey.value = ekey;
    console.log(`Callback token: ${tokenStr}, ekey: ${ekey}`);
    form.hcaptcha = tokenStr;
    form.post(route('email'), {
        preserveScroll: true,
        preserveState: true,
    })
}

function onExpire() {
    verified.value = false;
    token.value = null;
    eKey.value = null;
    expired.value = true;
    console.log('Expired');
}
function onError(err) {
    token.value = null;
    eKey.value = null;
    error.value = err;
    console.log(`Error: ${err}`);
}

function onSubmit() {
    form.processing = true;
    console.log('Submitting the invisible hCaptcha');
    invisibleHcaptcha.value.execute();
}

let form = useForm({
  name: '',
  email: '',
  message: '',
  hcaptcha: '',
})
</script>

<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Contact Us
        </h2>
        <hr class="mt-4 mb-4">
        <form @submit.prevent="onSubmit">
            <div class="grid grid-cols-3 gap-4 p-4">
                <div class="col-span-1">
                    <InputLabel for="name" value="Contact Name" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="col-span-2">
                    <InputLabel for="email" value="Contact Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError :message="form.errors.email" class="mt-2" />
                </div>

                <div class="col-span-3">
                    <InputLabel for="message" value="Comment" />
                    <textarea
                        id="message"
                        v-model="form.message"
                        class="mt-1 block w-full text_textarea"
                    ></textarea>
                    <InputError :message="form.errors.message" class="mt-2" />
                </div>
            </div>
            <div class="col-span-4" dir="rtl">
                <PrimaryButton  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <span v-if="form.processing">Sending</span>
                    <span v-else>Send Message</span>
                </PrimaryButton>
            </div>
            
            <vue-hcaptcha 
                ref="invisibleHcaptcha"
                sitekey="144a7405-8705-4fe0-876f-86227c6571ab"
                size="invisible"
                theme="dark"
                @verify="onVerify"
                @expired="onExpire"
                @challenge-expired="onExpire"
                @error="onError"
            />
        </form>
    </div>
</template>