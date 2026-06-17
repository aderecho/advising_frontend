<script setup lang="ts">
defineProps<{
  label: string
  value: number | string
  icon: 'calendar' | 'upload' | 'clock' | 'archive'
}>()

const iconPaths: Record<string, string> = {
  calendar: 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
  upload: 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12',
  clock: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
  archive: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a2 2 0 00-2-2H6a2 2 0 00-2 2v4h16z',
}
</script>

<template>
  <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white px-5 py-4 shadow-[var(--shadow-card)]">
    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="iconPaths[icon]" />
      </svg>
    </div>
    <div>
      <p class="text-xs font-medium text-slate-500">{{ label }}</p>
      <p class="text-2xl font-bold text-slate-900">{{ value }}</p>
    </div>
  </div>
</template>
