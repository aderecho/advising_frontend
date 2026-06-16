import tailwindcss from '@tailwindcss/vite'

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },

  modules: ['@pinia/nuxt'],

  app: {
    head: {
      link: [
        { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
        { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: 'anonymous' },
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        },
      ],
    },
  },

  css: ['~/assets/css/main.css'],

  runtimeConfig: {
    public: {
      // Leave empty in dev to use the Nitro proxy (same-origin cookies + CSRF).
      apiBase: process.env.NUXT_PUBLIC_API_BASE ?? '',
    },
  },

  nitro: {
    devProxy: {
      '/api': {
        target: 'http://127.0.0.1:8000/api',
        changeOrigin: true,
      },
      '/sanctum': {
        target: 'http://127.0.0.1:8000/sanctum',
        changeOrigin: true,
      },
    },
  },

  vite: {
    plugins: [tailwindcss()],
  },

  devServer: {
    port: 3000,
  },

  routeRules: {
    '/login': { ssr: false },
    '/admin/**': { ssr: false },
    '/our/**': { ssr: false },
    '/student/**': { ssr: false },
    '/student/**': { ssr: false },
  },
})
