<script setup lang="ts">
import type { CourseRow } from '~/composables/useAdminMockData'

defineProps<{ title: string; courses: CourseRow[] }>()

const totalUnits = (courses: CourseRow[]) => courses.reduce((sum, c) => sum + c.units, 0)
</script>

<template>
  <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-[var(--shadow-card)]">
    <div class="flex items-center gap-2.5 border-b border-slate-100 bg-gradient-to-r from-up-maroon to-up-maroon-dark px-5 py-3.5">
      <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/15">
        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
      </span>
      <h3 class="text-sm font-semibold text-white">{{ title }}</h3>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full text-xs">
        <thead>
          <tr class="border-b border-slate-200 bg-up-green/5 text-left text-[11px] font-semibold uppercase tracking-wide text-up-green">
            <th class="px-4 py-2.5 text-center">#</th>
            <th class="px-4 py-2.5">Code</th>
            <th class="px-4 py-2.5">Title</th>
            <th class="px-4 py-2.5 text-center">Units</th>
            <th class="px-4 py-2.5 text-center">Type</th>
            <th class="px-4 py-2.5">Pre-req</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr v-for="course in courses" :key="course.no" class="hover:bg-slate-50/80">
            <td class="px-4 py-2.5 text-center text-slate-500">{{ course.no }}</td>
            <td class="px-4 py-2.5 font-semibold text-slate-800">{{ course.code }}</td>
            <td class="px-4 py-2.5 text-slate-700">{{ course.title }}</td>
            <td class="px-4 py-2.5 text-center text-slate-700">{{ course.units }}</td>
            <td class="px-4 py-2.5 text-center text-slate-600">{{ course.type }}</td>
            <td class="px-4 py-2.5 text-slate-500">{{ course.prerequisite }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="border-t border-slate-200 bg-slate-50/60 px-4 py-2.5 text-xs text-slate-600">
      Total units: <span class="font-semibold text-up-green">{{ totalUnits(courses) }}</span>
    </div>
  </div>
</template>
