<script setup lang="ts">
const props = defineProps<{
  modelValue: string
  tabs: { id: string, label: string }[]
}>()

const emit = defineEmits<{ 'update:modelValue': [value: string] }>()
</script>

<template>
  <div class="flex flex-wrap gap-2">
    <button
      v-for="tab in tabs"
      :key="tab.id"
      type="button"
      class="rounded-lg px-5 py-2.5 text-sm font-semibold transition"
      :class="modelValue === tab.id
        ? 'bg-up-maroon text-white shadow-sm'
        : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-slate-50'"
      @click="emit('update:modelValue', tab.id)"
    >
      {{ tab.label }}
    </button>
  </div>
</template>
