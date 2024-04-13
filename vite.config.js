import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue"; 
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    resolve: {
        alias: {
            'ziggy-js': path.resolve('vendor/tightenco/ziggy/dist/index.esm.js'),
        }  
    },
    plugins: [
        vue(), 
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
