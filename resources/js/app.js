import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Layout from "./Layouts/Layout.vue";
import TwitLike from "./Components/TwitLike.vue";
import TwitNav from "./Components/TwitNav.vue"
import WhatsHappening from "./Components/WhatsHappening.vue"
import TwitSearch from "./Components/TwitSearch.vue"
import TrendsForYou from "./Components/TrendsForYou.vue"
import WhoToFollow from "./Components/WhoToFollow.vue"
import TwitPost from "./Components/TwitPost.vue"
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);


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
        app.provide('user', user);
        app.component('Link', Link);
        app.component('Head', Head);
        app.component('TwitLike', TwitLike);
        app.component('TwitNav', TwitNav);
        app.component('WhatsHappening', WhatsHappening);
        app.component('TwitSearch', TwitSearch);
        app.component('TrendsForYou', TrendsForYou);
        app.component('WhoToFollow', WhoToFollow);
        app.component('TwitPost', TwitPost);
        app.mount(el);
    },

    title: (title) => `Twitter ${title}`,
});