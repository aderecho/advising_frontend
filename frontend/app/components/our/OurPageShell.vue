<script setup lang="ts">
defineProps<{ title?: string }>()
</script>

<template>
  <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[var(--shadow-card)]">
    <div class="bg-up-maroon px-6 py-3.5 text-center">
      <h1 class="text-base font-semibold tracking-wide text-white">
        {{ title ?? 'Academic Advisement' }}
      </h1>
    </div>
    <div class="p-6">
      <slot />
    </div>
  </div>
</template>
