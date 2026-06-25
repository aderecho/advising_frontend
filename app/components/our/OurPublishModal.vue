<script setup lang="ts">
defineProps<{
  open: boolean
  loading?: boolean
  program?: string
  curriculumYear?: string
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
          <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-up-yellow/10 text-up-yellow-dark">
            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
          </div>

          <p class="text-lg font-semibold text-slate-900">Approve & Publish?</p>
          <p class="mt-2 text-sm text-slate-500">
            Are you sure you want to approve and publish the <span class="font-semibold text-slate-700">{{ program || 'selected program' }}</span> curriculum for <span class="font-semibold text-slate-700">{{ curriculumYear || 'the selected year' }}</span>?
            <br><br>
            Once published, it will be visible to all advisers and students across the system.
          </p>

          <div class="mt-8 flex w-full justify-center gap-3">
            <button
              type="button"
              class="flex-1 rounded-lg bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-200 disabled:opacity-60"
              :disabled="loading"
              @click="$emit('close')"
            >
              Cancel
            </button>
            <button
              type="button"
              class="flex-1 rounded-lg bg-up-green px-4 py-3 text-sm font-semibold text-white transition hover:bg-up-green-dark disabled:opacity-60"
              :disabled="loading"
              @click="$emit('confirm')"
            >
              {{ loading ? 'Publishing…' : 'Approve & Publish' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>
