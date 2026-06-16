<script setup lang="ts">
</script>

<template>
  <div class="flex min-h-screen bg-surface">
    <LayoutAppSidebar />

    <div class="flex min-w-0 flex-1 flex-col">
      <LayoutAppTopbar />

      <main class="flex-1 overflow-y-auto px-6 py-8 lg:px-10">
        <slot />
      </main>
    </div>
  </div>
</template>
