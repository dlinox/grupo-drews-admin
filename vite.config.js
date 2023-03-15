import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/assets/styles/scss/app.scss",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "./resources/assets/styles/scss/_variables.scss";`,
            },
        },
    },
});
