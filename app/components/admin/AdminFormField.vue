<script setup lang="ts">
defineProps<{
  label: string
  modelValue?: string
  type?: 'text' | 'select'
  placeholder?: string
}>()

defineEmits<{ 'update:modelValue': [value: string] }>()

const fieldClass =
  'w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-800 transition placeholder:text-slate-400 focus:border-up-maroon/40 focus:bg-white focus:outline-none focus:ring-4 focus:ring-up-maroon/10'
</script>

<template>
  <div>
    <label class="mb-2 block text-sm font-medium text-slate-700">{{ label }}</label>
    <select
      v-if="type === 'select'"
      :value="modelValue"
      :class="fieldClass"
      @change="$emit('update:modelValue', ($event.target as HTMLSelectElement).value)"
    >
      <slot />
    </select>
    <input
      v-else
      :type="type || 'text'"
      :value="modelValue"
      :placeholder="placeholder"
      :class="fieldClass"
      @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
    >
  </div>
</template>
