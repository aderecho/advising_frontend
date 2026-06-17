<script setup lang="ts">
import type { OurStatusVariant } from '~/composables/useOurMockData'

defineProps<{
  label: string
  variant: OurStatusVariant
}>()

const variantClasses: Record<OurStatusVariant, string> = {
  passed: 'bg-up-green text-white',
  incomplete: 'bg-red-600 text-white',
  published: 'bg-up-green text-white',
  draft: 'bg-amber-500 text-white',
  review: 'bg-sky-500 text-white',
  archived: 'bg-slate-400 text-white',
  aligned: 'bg-up-green text-white',
  misaligned: 'bg-red-600 text-white',
  active: 'bg-up-green text-white',
  pending: 'bg-amber-500 text-white',
  disabled: 'bg-red-600 text-white',
  enrolled: 'bg-sky-500 text-white',
}
</script>

<template>
  <span
    class="inline-flex rounded-full px-3 py-0.5 text-[11px] font-semibold whitespace-nowrap"
    :class="variantClasses[variant]"
  >
    {{ label }}
  </span>
</template>
