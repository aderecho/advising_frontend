<script setup lang="ts">
defineProps<{
  open: boolean
  title: string
}>()

defineEmits<{ close: [] }>()
</script>

<template>
  <Teleport to="body">
    <div
      v-if="open"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
      @click.self="$emit('close')"
    >
      <div class="w-full max-w-lg overflow-hidden rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between bg-up-maroon px-5 py-3.5">
          <h2 class="text-sm font-semibold tracking-wide text-white uppercase">{{ title }}</h2>
          <button
            type="button"
            class="rounded-lg p-1 text-white/80 transition hover:bg-white/10 hover:text-white"
            @click="$emit('close')"
          >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="p-6">
          <slot />
        </div>
      </div>
    </div>
  </Teleport>
</template>
