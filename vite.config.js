import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from "vite-plugin-static-copy";
import viteCompression from "vite-plugin-compression";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/mail.css',
                'resources/js/app.js',
                'resources/js/mail.js',
                'resources/js/guest.js',
            ],
            refresh: true,
            autoprefixer: {}
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/views/images/*',
                    dest: '../images'
                }
            ],
        }),
        viteCompression()
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                }
            }
        }
    }
});
