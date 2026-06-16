<script setup lang="ts">
const auth = useAuthStore()
const { sections, isActive, roleLabel, userName, userInitial } = useAppNavigation()

const showLogoutModal = ref(false)
const loggingOut = ref(false)

function openLogoutModal() {
  showLogoutModal.value = true
}

function closeLogoutModal() {
  if (!loggingOut.value) {
    showLogoutModal.value = false
  }
}

async function confirmLogout() {
  loggingOut.value = true
  try {
    await auth.logout()
  } finally {
    loggingOut.value = false
    showLogoutModal.value = false
  }
}
</script>

<template>
  <aside class="sticky top-0 flex h-screen w-[17.5rem] shrink-0 flex-col bg-up-maroon">
    <div class="border-b border-white/10 px-5 py-5">
      <div class="flex items-center gap-3">
        <img
          src="/images/logos/up-logo.png"
          alt="UP Cebu"
          class="h-10 w-auto shrink-0 object-contain"
        >
        <div>
          <p class="text-sm font-semibold leading-tight text-white">UP Cebu</p>
          <p class="text-xs font-medium text-white/70">Academic Management</p>
        </div>
      </div>
    </div>

    <nav class="flex-1 space-y-6 overflow-y-auto p-4">
      <div v-for="section in sections" :key="section.title">
        <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-white/50">
          {{ section.title }}
        </p>
        <div class="space-y-1">
          <NuxtLink
            v-for="item in section.items"
            :key="item.to"
            :to="item.to"
            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200"
            :class="isActive(item.to)
              ? 'bg-white text-up-maroon shadow-md shadow-black/10'
              : 'text-white/90 hover:bg-white/10 hover:text-white'"
          >
            <span
              class="flex h-8 w-8 items-center justify-center rounded-lg transition-colors"
              :class="isActive(item.to) ? 'bg-up-maroon/10' : 'bg-white/10 group-hover:bg-white/15'"
            >
              <AdminIcon :name="item.icon" />
            </span>
            {{ item.label }}
          </NuxtLink>
        </div>
      </div>
    </nav>

    <div class="border-t border-white/10 p-4">
      <div class="mb-3 flex items-center gap-3 px-1">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/15 text-sm font-semibold text-white">
          {{ userInitial }}
        </div>
        <div class="min-w-0">
          <p class="truncate text-sm font-medium text-white">{{ userName }}</p>
          <p class="text-xs text-white/60">{{ roleLabel }}</p>
        </div>
      </div>

      <button
        type="button"
        class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-white/20"
        @click="openLogoutModal"
      >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        Logout
      </button>
    </div>

    <LayoutLogoutModal
      :open="showLogoutModal"
      :loading="loggingOut"
      @close="closeLogoutModal"
      @confirm="confirmLogout"
    />
  </aside>
</template>
