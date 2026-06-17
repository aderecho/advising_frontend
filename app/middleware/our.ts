export default defineNuxtRouteMiddleware(async () => {
  const auth = useAuthStore()

  if (!auth.initialized) {
    await auth.fetchUser()
  }

  if (!auth.isAuthenticated) {
    return navigateTo('/login')
  }

  if (auth.user?.role !== 'our') {
    return navigateTo(auth.dashboardRoute)
  }
})
