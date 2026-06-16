export default defineNuxtPlugin(async () => {
  const auth = useAuthStore()

  if (auth.initialized) {
    return
  }

  try {
    await auth.fetchUser()
  } catch {
    auth.initialized = true
  }
})
