import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Layout from "./Layouts/Layout.vue";


createInertiaApp({
    progress: {
        enabled: true,
        delay: 250,
        color: '#29d',
        includeCSS: true,
        showSpinner: false,
    },

    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (page.default.layout === undefined) {
            page.default.layout = Layout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        // app.component('Link', Link);
        // app.component('Head', Head),
        app.mount(el);
    },

    title: (title) => `Twitter ${title}`,
});