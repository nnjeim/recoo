import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import basicSsl from '@vitejs/plugin-basic-ssl';
// import fs from 'fs';

const host = '10.28.10.10';

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
    host,
    // https: true,
    hmr: { host },
    // https: {
    //   key: fs.readFileSync('/etc/ssl/private/_dev-key.pem'),
    //   cert: fs.readFileSync('/etc/ssl/certs/_dev.pem'),
    // },
  },
});
