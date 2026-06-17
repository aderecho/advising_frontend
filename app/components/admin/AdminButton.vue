<script setup lang="ts">
withDefaults(defineProps<{
  variant?: 'primary' | 'secondary' | 'primary-sm' | 'ghost'
  type?: 'button' | 'submit'
}>(), {
  variant: 'primary',
  type: 'button',
})

const classes: Record<string, string> = {
  primary: 'bg-up-green text-white shadow-sm shadow-up-green/20 hover:bg-up-green-dark px-6 py-2.5 text-sm',
  secondary: 'border border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50 px-6 py-2.5 text-sm',
  'primary-sm': 'bg-up-green text-white shadow-sm shadow-up-green/20 hover:bg-up-green-dark px-4 py-2 text-sm',
  ghost: 'text-up-maroon hover:bg-up-maroon/5 px-4 py-2 text-sm',
}
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center justify-center gap-2 rounded-xl font-semibold transition-all duration-200 active:scale-[0.98]"
    :class="classes[variant]"
  >
    <slot />
  </button>
</template>
