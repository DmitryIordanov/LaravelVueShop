import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import router from "@/router";
import CKEditor from '@ckeditor/ckeditor5-vue';

const vuetify = createVuetify({
    components,
    directives,
});

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./**/*.vue', { eager: true })
        return pages[`./${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(CKEditor)
            .use(router)
            .use(plugin)
            .use(vuetify)
            .mount(el)
    },
});
