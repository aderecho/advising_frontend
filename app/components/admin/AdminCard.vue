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
    class="flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-[var(--shadow-card)] transition-shadow duration-200"
  >
    <header v-if="title || $slots.header" class="bg-up-maroon px-5 py-2.5">
      <slot name="header">
        <h2 v-if="title" class="text-base font-semibold text-white">
          {{ title }}
        </h2>
        <p v-if="description" class="mt-0.5 text-xs text-white/80">
          {{ description }}
        </p>
      </slot>
    </header>
    <div :class="paddingClasses[padding ?? 'md']">
      <slot />
    </div>
  </section>
</template>
