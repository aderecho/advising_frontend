import axios from 'axios'
import { defineStore } from 'pinia'
import type { User } from '~/types/auth'
import { roleDashboardRoutes } from '~/types/auth'

interface LoginPayload {
  email: string
  password: string
  remember?: boolean
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as User | null,
    initialized: false,
    loading: false,
    error: null as string | null,
  }),

  getters: {
    isAuthenticated: (state) => state.user !== null,
    dashboardRoute: (state) =>
      state.user ? roleDashboardRoutes[state.user.role] : '/login',
  },

  actions: {
    async ensureCsrfCookie() {
      const config = useRuntimeConfig()
      const { $axios } = useNuxtApp()
      const apiBase = config.public.apiBase as string

      await $axios.get('/sanctum/csrf-cookie', {
        baseURL: apiBase || undefined,
      })
    },

    async fetchUser() {
      const { $axios } = useNuxtApp()

      try {
        const { data } = await $axios.get<User>('/user')
        this.user = data
      } catch {
        this.user = null
      } finally {
        this.initialized = true
      }
    },

    async login(payload: LoginPayload) {
      const { $axios } = useNuxtApp()
      this.loading = true
      this.error = null

      try {
        await this.ensureCsrfCookie()
        const { data } = await $axios.post<{ user: User }>('/login', payload)
        this.user = data.user
        return data.user
      } catch (error) {
        if (axios.isAxiosError(error)) {
          if (!error.response) {
            this.error = 'Cannot reach the API. Make sure Laravel is running: php artisan serve'
          } else if (error.response.status === 422) {
            this.error = error.response.data?.message ?? 'These credentials do not match our records.'
          } else if (error.response.status === 419) {
            this.error = 'Session expired. Please try again.'
          } else if (error.response.status >= 500) {
            this.error = error.response.data?.message ?? 'Server error during login. Is Laravel running?'
          } else {
            this.error = error.response.data?.message ?? 'Login failed. Please try again.'
          }
        } else {
          this.error = 'These credentials do not match our records.'
        }
        throw new Error(this.error)
      } finally {
        this.loading = false
      }
    },

    async logout() {
      const { $axios } = useNuxtApp()

      try {
        await $axios.post('/logout')
      } finally {
        this.user = null
        await navigateTo('/login')
      }
    },
  },
})
