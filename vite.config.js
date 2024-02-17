import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/js/app.js"],
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
    ],
    ssr: {
        noExternal: ["@inertiajs/server"],
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js/vue"),
        },
    },
});
