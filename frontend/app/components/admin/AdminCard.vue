<script setup lang="ts">
defineProps<{
  title?: string
  description?: string
  padding?: 'sm' | 'md' | 'lg'
}>()

const paddingClasses = {
  sm: 'p-5',
  md: 'p-6',
  lg: 'p-8',
}
</script>

<template>
  <section
    class="rounded-2xl border border-slate-200/80 bg-white shadow-[var(--shadow-card)] transition-shadow duration-200"
    :class="paddingClasses[padding ?? 'md']"
  >
    <header v-if="title || $slots.header" class="mb-6">
      <slot name="header">
        <h2 v-if="title" class="text-base font-semibold text-slate-900">
          {{ title }}
        </h2>
        <p v-if="description" class="mt-1 text-sm text-slate-500">
          {{ description }}
        </p>
      </slot>
    </header>
    <slot />
  </section>
</template>
