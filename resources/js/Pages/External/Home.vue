<script setup>
import ExternalAppLayout from '@/Layouts/ExternalAppLayout.vue';
import AboutUsText from './Partial/AboutUsText.vue';
import LatestImages from './Partial/LatestImages.vue';
import ContactUs from './Partial/ContactUs.vue';

defineProps({
    photos: Object,
});
</script>

<template>
    <ExternalAppLayout :canRegister=false>
        <div v-if="photos.length">
            <LatestImages :photos="photos"/>
        </div>
        <AboutUsText />
        <ContactUs />

    </ExternalAppLayout>
</template>