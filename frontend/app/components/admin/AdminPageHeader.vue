<script setup lang="ts">
defineProps<{
  title: string
  description?: string
}>()
</script>

<template>
  <div class="mb-8">
    <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
      {{ title }}
    </h1>
    <p v-if="description" class="mt-1.5 max-w-2xl text-sm leading-relaxed text-slate-500">
      {{ description }}
    </p>
  </div>
</template>
