<script setup lang="ts">
defineProps<{
  open: boolean
  loading?: boolean
}>()

defineEmits<{
  close: []
  confirm: []
}>()
</script>

<template>
  <Teleport to="body">
    <div
      v-if="open"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
      @click.self="$emit('close')"
    >
      <div class="relative w-full max-w-md overflow-hidden rounded-xl bg-white p-8 shadow-xl">
        <button
          type="button"
          class="absolute top-4 right-4 rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
          :disabled="loading"
          aria-label="Close"
          @click="$emit('close')"
        >
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <div class="flex flex-col items-center text-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-up-maroon/10 text-up-maroon">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
          </div>

          <p class="text-lg font-semibold text-slate-900">Are you sure you want to logout?</p>
          <p class="mt-2 max-w-xs text-sm text-slate-500">
            You will be signed out of AMIS and redirected to the login page.
          </p>

          <div class="mt-8 flex justify-center gap-4">
            <button
              type="button"
              class="min-w-[7rem] rounded-lg bg-slate-500 px-8 py-3 text-base font-semibold text-white transition hover:bg-slate-600 disabled:opacity-60"
              :disabled="loading"
              @click="$emit('close')"
            >
              Cancel
            </button>
            <button
              type="button"
              class="min-w-[7rem] rounded-lg bg-up-maroon px-8 py-3 text-base font-semibold text-white transition hover:bg-up-maroon-dark disabled:opacity-60"
              :disabled="loading"
              @click="$emit('confirm')"
            >
              {{ loading ? 'Logging out…' : 'Logout' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>
