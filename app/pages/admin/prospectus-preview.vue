<script setup lang="ts">
definePageMeta({ layout: 'app' })

const { semesters } = useAdminMockData()
</script>

<template>
  <AdminPageHeader
    title="Prospectus preview"
    description="Review curriculum details and semester breakdown before generating the prospectus."
  />

  <div class="mb-8 grid gap-4 sm:grid-cols-3">
    <div class="group flex items-center gap-4 rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[var(--shadow-card)] transition-shadow hover:shadow-[var(--shadow-card-hover)]">
      <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-up-green/10 text-up-green">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
      </div>
      <div>
        <p class="text-sm font-medium text-slate-500">Total units</p>
        <p class="text-3xl font-semibold tracking-tight text-up-green">153</p>
      </div>
    </div>
    <div class="group flex items-center gap-4 rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[var(--shadow-card)] transition-shadow hover:shadow-[var(--shadow-card-hover)]">
      <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-up-maroon/10 text-up-maroon">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
      </div>
      <div>
        <p class="text-sm font-medium text-slate-500">Semesters</p>
        <p class="text-3xl font-semibold tracking-tight text-up-maroon">8</p>
      </div>
    </div>
    <div class="group flex items-center gap-4 rounded-2xl border border-slate-200/80 bg-white p-5 shadow-[var(--shadow-card)] transition-shadow hover:shadow-[var(--shadow-card-hover)]">
      <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-up-yellow/15 text-up-yellow-dark">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
      </div>
      <div>
        <p class="text-sm font-medium text-slate-500">Year level</p>
        <p class="text-3xl font-semibold tracking-tight text-up-yellow-dark">4</p>
      </div>
    </div>
  </div>

  <div class="mb-8 flex flex-wrap items-center gap-3">
    <AdminButton>Generate &amp; publish</AdminButton>
    <AdminButton variant="secondary">Print preview</AdminButton>
    <AdminButton variant="secondary">Export prospectus</AdminButton>
  </div>

  <div class="grid gap-6 lg:grid-cols-2">
    <AdminSemesterTable
      v-for="semester in semesters"
      :key="semester.title"
      :title="semester.title"
      :courses="semester.courses"
    />
  </div>
</template>
