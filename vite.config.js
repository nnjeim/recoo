import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl';

export default defineConfig({
  plugins: [
    // basicSsl(),
    laravel({
      input: [
        'resources/scss/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@': '/resources/js',
    },
  },
  server: {
    host: '10.28.10.10',
  },
});
