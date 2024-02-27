import './bootstrap';
import '../css/app.css';
import 'flowbite';
import VueApexCharts from "vue3-apexcharts";

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueEasyLightbox from 'vue-easy-lightbox'
import VueTippy from 'vue-tippy'
import 'tippy.js/dist/tippy.css'
import * as Sentry from '@sentry/vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

Sentry.init({
    dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueApexCharts)
            .use(VueEasyLightbox)
            .use(VueTippy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
