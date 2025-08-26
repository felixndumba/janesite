
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: '1/build',
        manifest: true,
        rollupOptions: {
            input: ['resources/css/app.css', 'resources/js/app.js'],
        },
    },
    base: '/build/', // 👈 This ensures Laravel looks in /build for assets
});
