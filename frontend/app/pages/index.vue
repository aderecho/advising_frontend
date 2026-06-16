<script setup lang="ts">
const auth = useAuthStore()

if (!auth.initialized) {
  await auth.fetchUser()
}

if (auth.isAuthenticated) {
  await navigateTo(auth.dashboardRoute)
} else {
  await navigateTo('/login')
}
</script>

<template>
  <div />
</template>
