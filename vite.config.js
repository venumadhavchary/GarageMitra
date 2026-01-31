import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/style.css",
                "resources/js/app.js",
                "resources/js/auth.js",
                "resources/js/api.js",
                "resources/js/bill.js",
                "resources/js/jobcards.js",
                "resources/js/mechanics.js",
                "resources/js/vehicles.js",
            ],
            refresh: true,
        }),
    ],
    server: {
        host: "garagemitra.test",
        port: 3000,
        hmr: {
            host: "garagemitra.test",
        },
    },
});
