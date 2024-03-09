import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/FrontOffice/App.jsx", "resources/js/BackOffice/DashboardApp.jsx"],
            refresh: true,
        }),
        react(),
    ],
});
