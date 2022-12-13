require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';

import Vuetify from "vuetify";
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css'
import Notifications from 'vue-notification'

Vue.use(Notifications)
Vue.use(InertiaPlugin);
Vue.use(Vuetify);

const app = document.getElementById('app');

export default new Vuetify({
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
})

new Vue({
    vuetify: new Vuetify(),
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);

