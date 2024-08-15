import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
  plugins: [
    vue({
      template: {
        transformAssetUrls: {
          includeAbsolute: false,
        },
      },
    }),
  ],
  server: {
    proxy: {

      /**
       * When developing locally - proxies "/api" to the local Colyseus server.
       * This mimics the behaviour of the production server.
       */
      '/api': {
        target: 'http://localhost:2567',
        changeOrigin: true,
        ws: true,
        rewrite: (path) => path.replace(/^\/api/, ''),
      },

    },
  },

  build: {
    rollupOptions: {
      output: {
        manualChunks: undefined, // Ensure manualChunks is undefined to disable chunking
        format: 'iife', // Use 'iife' format for a single self-contained file
        entryFileNames: 'assets/index.js',
        chunkFileNames: 'assets/[name]-[hash].js',
        assetFileNames: 'assets/[name]-[hash].[ext]'
      },
    },
    chunkSizeWarningLimit: 5000,
    copyPublicDir: false,
  },
})
