require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

// import Vue from 'vue';
// import VueSweetalert2 from 'vue-sweetalert2';
// // If you don't need the styles, do not connect
// import 'sweetalert2/dist/sweetalert2.min.css';

// Vue.use(VueSweetalert2);

InertiaProgress.init({ color: '#4B5563' });
