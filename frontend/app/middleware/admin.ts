export default defineNuxtRouteMiddleware(async () => {
  const auth = useAuthStore()

  if (!auth.initialized) {
    await auth.fetchUser()
  }

  if (!auth.isAuthenticated) {
    return navigateTo('/login')
  }

  if (auth.user?.role !== 'admin') {
    return navigateTo(auth.dashboardRoute)
  }
})
