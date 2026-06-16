<script setup lang="ts">
definePageMeta({ layout: 'app' })

const { catalogSemesters } = useOurMockData()
</script>

<template>
  <OurPageShell>
    <div class="mb-6">
      <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Course Catalog</h2>
      <p class="mt-1 text-sm text-slate-600">BS Computer Science</p>
    </div>

    <div class="grid gap-6 xl:grid-cols-2">
      <OurCatalogTable
        v-for="semester in catalogSemesters"
        :key="semester.title"
        :semester="semester"
      />
    </div>
  </OurPageShell>
</template>
