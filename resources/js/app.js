import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import naive from "naive-ui";

import NProgress from "nprogress";
import { router } from "@inertiajs/vue3";
router.on("start", () => NProgress.start());
router.on("finish", () => NProgress.done());

createInertiaApp({
    progress: {
        showSpinner: true,
        color: "#000",
    },
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(naive)
            .use(plugin)
            .mount(el);
    },
});
