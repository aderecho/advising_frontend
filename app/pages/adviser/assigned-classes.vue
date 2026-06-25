<script setup lang="ts">
definePageMeta({ layout: 'app' })

const { assignedClasses } = useAdviserMockData()
</script>

<template>
  <div class="mb-6">
    <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Assigned Classes</h2>
  </div>

  <div class="mb-8 grid gap-6 md:grid-cols-3">
    <!-- Classes Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-blue-500"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-xs font-bold tracking-wider text-slate-400 uppercase mb-3">Classes</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <span class="text-4xl font-bold text-blue-500">2</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Students Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-orange-500"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-xs font-bold tracking-wider text-slate-400 uppercase mb-3">Total Students</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span class="text-4xl font-bold text-orange-500">6</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Needs Attention Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-green-600"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-xs font-bold tracking-wider text-slate-400 uppercase mb-3">Needs Attention</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span class="text-4xl font-bold text-green-600">4</span>
            </div>
            <p class="mt-2 text-[10px] font-semibold text-slate-500 uppercase">AY 2025-2026</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    <div 
      v-for="cls in assignedClasses" 
      :key="cls.id"
      class="flex flex-col rounded-xl bg-white p-5 shadow-sm ring-1 ring-slate-200"
    >
      <div class="mb-4 flex items-start justify-between gap-2">
        <h3 class="font-bold text-up-maroon">{{ cls.course }} — Section {{ cls.section }}</h3>
        <span class="inline-flex shrink-0 items-center rounded-full bg-pink-100 px-2 py-0.5 text-[10px] font-bold text-pink-700" v-if="cls.section === 'A' || cls.section === 'B' || cls.section === 'C' || cls.section === 'D'">
          {{ cls.students }} students
        </span>
        <span class="inline-flex shrink-0 items-center rounded-full bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700" v-else>
          {{ cls.students }} students
        </span>
      </div>
      
      <p class="mb-6 text-xs text-slate-500">{{ cls.schedule }}</p>
      
      <div class="mt-auto flex justify-center">
        <NuxtLink 
          to="/adviser/list-of-students" 
          class="rounded-full bg-up-maroon px-6 py-2 text-xs font-bold text-white transition hover:bg-up-maroon-dark"
        >
          VIEW STUDENTS
        </NuxtLink>
      </div>
    </div>
  </div>
</template>
