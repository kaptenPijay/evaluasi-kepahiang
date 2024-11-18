import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss','resources/js/app.js','public/css/layout.css','public/css/card-dashboard.css','public/css/data-table.css','public/css/super-admin.css'],
            refresh: true,
        }),
    ],
});
