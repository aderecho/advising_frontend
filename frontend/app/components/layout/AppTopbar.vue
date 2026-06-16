<script setup lang="ts">
const { roleLabel, pageTitle } = useAppNavigation()
</script>

<template>
  <header class="sticky top-0 z-10 border-b border-slate-200/80 bg-white/90 px-6 py-4 backdrop-blur-md lg:px-10">
    <div>
      <p class="text-xs font-medium text-slate-400">AMIS · {{ roleLabel }}</p>
      <p class="text-lg font-semibold text-slate-900">{{ pageTitle }}</p>
    </div>
  </header>
</template>
