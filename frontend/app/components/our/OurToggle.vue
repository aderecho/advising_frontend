<script setup lang="ts">
const model = defineModel<boolean>({ default: false })
</script>

<template>
  <button
    type="button"
    role="switch"
    :aria-checked="model"
    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200"
    :class="model ? 'bg-up-green' : 'bg-slate-300'"
    @click="model = !model"
  >
    <span
      class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200"
      :class="model ? 'translate-x-5' : 'translate-x-0'"
    />
  </button>
</template>
