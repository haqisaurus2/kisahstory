import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/images/favicon.ico",
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/jquery.min.js",
                "resources/js/rate.min.js",
                "resources/react/app.tsx",
            ],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources"),
        },
    },
    build: {
        assetsInlineLimit: 0,
        rollupOptions: {
            output: {
                manifest: true,
            },
        },
    },
});
