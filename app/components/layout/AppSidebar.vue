<script setup lang="ts">
const auth = useAuthStore()
const { sections, isActive, roleLabel, userName, userInitial } = useAppNavigation()

const showLogoutModal = ref(false)
const loggingOut = ref(false)

const isMinimized = useState('isSidebarMinimized', () => false)

function toggleSidebar() {
  isMinimized.value = !isMinimized.value
}

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
  <aside 
    class="sticky top-0 flex h-screen shrink-0 flex-col bg-up-maroon transition-[width] duration-300"
    :class="isMinimized ? 'w-[5rem]' : 'w-[17.5rem]'"
  >
    <div class="border-b border-white/10 py-5 flex items-center h-[5.05rem]" :class="isMinimized ? 'justify-center px-0' : 'justify-between px-5'">
      <div v-if="!isMinimized" class="flex items-center gap-3 overflow-hidden">
        <img
          src="/images/logos/up-logo.png"
          alt="UP Cebu"
          class="h-10 w-auto shrink-0 object-contain"
        >
        <div class="min-w-0">
          <p class="truncate text-sm font-semibold leading-tight text-white">UP Cebu</p>
          <p class="truncate text-xs font-medium text-white/70">Advising Management</p>
        </div>
      </div>

      <button @click="toggleSidebar" class="shrink-0 rounded-lg p-2 text-white/70 transition hover:bg-white/10 hover:text-white">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <nav class="flex-1 space-y-6 overflow-y-auto py-4" :class="isMinimized ? 'px-2' : 'px-4'">
      <div v-for="section in sections" :key="section.title">
        <p v-if="!isMinimized" class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-white/50">
          {{ section.title }}
        </p>
        <div class="space-y-1">
          <NuxtLink
            v-for="item in section.items"
            :key="item.to"
            :to="item.to"
            :title="isMinimized ? item.label : undefined"
            class="group flex items-center rounded-xl transition-all duration-200"
            :class="[
              isMinimized ? 'justify-center py-3' : 'gap-3 px-3 py-2.5',
              isActive(item.to)
                ? 'bg-white text-up-maroon shadow-md shadow-black/10'
                : 'text-white/90 hover:bg-white/10 hover:text-white'
            ]"
          >
            <span
              class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg transition-colors"
              :class="isActive(item.to) ? 'bg-up-maroon/10' : 'bg-white/10 group-hover:bg-white/15'"
            >
              <AdminIcon :name="item.icon" />
            </span>
            <span v-if="!isMinimized" class="truncate text-sm font-medium">{{ item.label }}</span>
          </NuxtLink>
        </div>
      </div>
    </nav>

    <div class="border-t border-white/10 py-4" :class="isMinimized ? 'px-2 flex flex-col items-center' : 'px-4'">
      <div v-if="!isMinimized" class="mb-3 flex items-center gap-3 px-1 overflow-hidden">
        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/15 text-sm font-semibold text-white">
          {{ userInitial }}
        </div>
        <div class="min-w-0">
          <p class="truncate text-sm font-medium text-white">{{ userName }}</p>
          <p class="truncate text-xs text-white/60">{{ roleLabel }}</p>
        </div>
      </div>

      <button
        type="button"
        :title="isMinimized ? 'Logout' : undefined"
        class="flex shrink-0 items-center justify-center rounded-xl border border-white/20 bg-white/10 transition hover:bg-white/20"
        :class="isMinimized ? 'h-10 w-10 p-0' : 'w-full gap-2 px-4 py-2.5 text-sm font-medium'"
        @click="openLogoutModal"
      >
        <svg class="h-4 w-4 shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        <span v-if="!isMinimized" class="text-sm font-medium text-white">Logout</span>
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
