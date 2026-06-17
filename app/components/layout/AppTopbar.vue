<script setup lang="ts">
import { ref } from 'vue'

const auth = useAuthStore()
const { roleLabel, pageTitle, userInitial, userName } = useAppNavigation()

const isDropdownOpen = ref(false)
const showLogoutModal = ref(false)
const loggingOut = ref(false)

function openLogoutModal() {
  isDropdownOpen.value = false
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
  <header class="sticky top-0 z-40 flex items-center justify-between border-b border-slate-200/80 bg-white/90 px-6 py-4 backdrop-blur-md lg:px-10">
    <div>
      <p class="text-xs font-medium text-slate-400">AMIS · {{ roleLabel }}</p>
      <p class="text-lg font-semibold text-slate-900">{{ pageTitle }}</p>
    </div>

    <div class="flex items-center gap-5">
      <button class="relative rounded-full p-2 text-up-maroon transition-colors hover:bg-slate-100 focus:outline-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span class="absolute right-2.5 top-2.5 flex h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
      </button>

      <div class="relative">
        <button @click="isDropdownOpen = !isDropdownOpen" class="relative flex items-center focus:outline-none">
          <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-up-maroon bg-slate-100 text-sm font-bold text-slate-600 transition-transform hover:scale-105">
            {{ userInitial }}
          </div>
          <div class="absolute -bottom-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full border-[1.5px] border-white bg-slate-200 text-slate-600 shadow-sm">
            <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </button>

        <div v-if="isDropdownOpen" @click="isDropdownOpen = false" class="fixed inset-0 z-40"></div>

        <Transition
          enter-active-class="transition duration-200 ease-out"
          enter-from-class="transform scale-95 opacity-0"
          enter-to-class="transform scale-100 opacity-100"
          leave-active-class="transition duration-150 ease-in"
          leave-from-class="transform scale-100 opacity-100"
          leave-to-class="transform scale-95 opacity-0"
        >
          <div v-if="isDropdownOpen" class="absolute right-0 mt-3 w-80 rounded-2xl border border-slate-100 bg-white p-3 shadow-xl z-50">
            <div class="mb-2 flex cursor-pointer items-center gap-3 rounded-xl p-2 transition hover:bg-slate-50 shadow-sm border border-slate-100">
              <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-up-maroon/10 text-xl font-bold text-up-maroon border border-up-maroon/20">
                {{ userInitial }}
              </div>
              <div class="min-w-0 flex-1">
                <p class="truncate text-base font-bold text-slate-900">{{ userName }}</p>
                <p class="truncate text-sm font-medium text-slate-500">See all profiles</p>
              </div>
            </div>

            <div class="my-2 h-[1px] bg-slate-100"></div>

            <div class="space-y-1">
              <button class="group flex w-full items-center gap-3 rounded-xl p-2 text-left font-semibold text-slate-700 transition hover:bg-slate-50">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 group-hover:bg-white group-hover:shadow-sm">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <span class="flex-1 text-[15px]">Settings & Privacy</span>
                <svg class="h-4 w-4 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
              </button>

              <button class="group flex w-full items-center gap-3 rounded-xl p-2 text-left font-semibold text-slate-700 transition hover:bg-slate-50">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 group-hover:bg-white group-hover:shadow-sm">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="flex-1 text-[15px]">Help & Support</span>
                <svg class="h-4 w-4 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
              </button>

              <button @click="openLogoutModal" class="group flex w-full items-center gap-3 rounded-xl p-2 text-left font-semibold text-slate-700 transition hover:bg-slate-50">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 group-hover:bg-white group-hover:shadow-sm">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </div>
                <span class="flex-1 text-[15px]">Logout</span>
              </button>
            </div>

            <div class="mt-3 px-2 flex flex-wrap gap-x-2 gap-y-1 text-[11px] text-slate-400">
               <a href="#" class="hover:underline">Privacy</a> ·
               <a href="#" class="hover:underline">Terms</a> ·
               <a href="#" class="hover:underline">Cookies</a> ·
               <span>UP Cebu AMIS © 2026</span>
            </div>
          </div>
        </Transition>
      </div>
    </div>

    <LayoutLogoutModal
      :open="showLogoutModal"
      :loading="loggingOut"
      @close="closeLogoutModal"
      @confirm="confirmLogout"
    />
  </header>
</template>
