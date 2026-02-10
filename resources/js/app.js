import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { createHead } from '@vueuse/head'
import { ZiggyVue } from 'ziggy-js';

const head = createHead()

createInertiaApp({
    title: title => `${title} - AppointSys`,
    resolve: name =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        import('./Components/PrimaryButton.vue');
        import('./Layouts/GuestLayout.vue');
        

        app.use(plugin);
        app.use(head)
        app.use(ZiggyVue, Ziggy);

        return app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});