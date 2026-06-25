<script setup lang="ts">
definePageMeta({ layout: 'app' })

const { studentsList } = useAdviserMockData()

function statusVariant(status: string) {
  switch (status) {
    case 'Good Standing':
      return 'success'
    case 'Needs Attention':
      return 'warning'
    default:
      return 'default'
  }
}
</script>

<template>
  <div class="mb-8">
    <h2 class="text-xl font-bold text-slate-900">CS 201 — Section A</h2>
    <p class="mt-1 text-xs text-slate-500">MWF 7:30–8:30 • SC 201 • AY 2025–2026</p>
  </div>

  <div class="mb-8 grid gap-6 md:grid-cols-4">
    <!-- Total Students Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-blue-500"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-3">Total Students</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              <span class="text-4xl font-bold text-blue-500">32</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Good Standing Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-green-600"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-3">Good Standing</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span class="text-4xl font-bold text-green-600">25</span>
            </div>
            <p class="mt-2 text-[10px] font-semibold text-slate-500 uppercase">AY 2025-2026</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Needs Attention Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-orange-500"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-3">Needs Attention</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              <span class="text-4xl font-bold text-orange-500">5</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Flagged / Blocked Card -->
    <div class="flex flex-col justify-center overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
      <div class="flex h-full">
        <div class="w-1.5 shrink-0 bg-red-600"></div>
        <div class="flex w-full items-center justify-between p-6">
          <div class="flex flex-col items-center justify-center w-full">
            <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-3">Flagged / Blocked</p>
            <div class="flex items-center gap-4">
              <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
              </svg>
              <span class="text-4xl font-bold text-red-600">2</span>
            </div>
            <p class="mt-2 text-[10px] font-semibold text-slate-500 uppercase">AY 2025-2026</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div class="relative w-full max-w-sm">
        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input 
          type="text" 
          placeholder="Search student name or ID..." 
          class="w-full rounded-lg border-slate-200 pl-10 text-sm focus:border-up-maroon focus:ring-up-maroon"
        >
      </div>
      
      <select class="rounded-lg border-slate-200 text-sm text-slate-600 focus:border-up-maroon focus:ring-up-maroon">
        <option value="">Select Status</option>
        <option value="good">Good Standing</option>
        <option value="attention">Needs Attention</option>
      </select>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200">
      <table class="w-full min-w-[900px] text-left text-sm">
        <thead>
          <tr class="bg-up-green text-xs font-semibold uppercase tracking-wide text-white">
            <th class="px-6 py-4 text-center">#</th>
            <th class="px-6 py-4">Student</th>
            <th class="px-6 py-4">Year / Program</th>
            <th class="px-6 py-4 text-center">GWA</th>
            <th class="px-6 py-4 text-center">GWA</th>
            <th class="px-6 py-4 text-center">Status</th>
            <th class="px-6 py-4 text-center">Flags</th>
            <th class="px-6 py-4 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
          <tr v-for="student in studentsList" :key="student.id" class="hover:bg-slate-50/50">
            <td class="px-6 py-4 text-center text-slate-500">{{ student.no }}</td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div 
                  class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xs font-bold text-white"
                  :class="student.status === 'Good Standing' ? 'bg-green-200 text-green-700' : (student.initials === 'GC' ? 'bg-pink-200 text-pink-700' : 'bg-blue-100 text-blue-700')"
                >
                  {{ student.initials }}
                </div>
                <div>
                  <p class="text-sm font-semibold text-slate-900">{{ student.name }}</p>
                  <p class="text-xs text-slate-500">{{ student.id }}</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <p class="text-sm text-slate-700">{{ student.year }}</p>
              <p class="text-xs text-slate-500">{{ student.program }}</p>
            </td>
            <td class="px-6 py-4 text-center">
              <span 
                class="font-bold" 
                :class="parseFloat(student.gwa) <= 2.0 ? 'text-green-600' : 'text-orange-500'"
              >
                {{ student.gwa }}
              </span>
            </td>
            <td class="px-6 py-4 text-center text-slate-500">
              {{ student.units }}
            </td>
            <td class="px-6 py-4 text-center">
              <span 
                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium"
                :class="student.status === 'Good Standing' ? 'border-green-200 bg-green-50 text-green-700' : 'border-orange-200 bg-orange-50 text-orange-700'"
              >
                {{ student.status }}
              </span>
            </td>
            <td class="px-6 py-4 text-center">
              <div class="flex flex-wrap justify-center gap-1">
                <span 
                  v-for="flag in student.flags" 
                  :key="flag"
                  class="inline-flex items-center rounded-full border border-pink-200 bg-pink-50 px-2.5 py-0.5 text-xs font-medium text-pink-700"
                >
                  {{ flag }}
                </span>
              </div>
            </td>
            <td class="px-6 py-4 text-center">
              <button 
                type="button" 
                class="rounded-lg bg-up-maroon px-4 py-1.5 text-xs font-bold text-white transition hover:bg-up-maroon-dark"
              >
                Advise
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
