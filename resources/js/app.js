import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import route from "ziggy-js";


createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue')
        return pages[`./Pages/${name}.vue`]()
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('inertia-link', Link)
            .mount(el)
    },
})
