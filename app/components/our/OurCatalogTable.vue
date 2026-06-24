<script setup lang="ts">
import type { CatalogSemester } from '~/composables/useOurMockData'
import { ourStatusVariant } from '~/composables/useOurMockData'

defineProps<{ semester: CatalogSemester }>()
</script>

<template>
  <div class="overflow-hidden rounded-lg border border-slate-200">
    <div class="flex items-center justify-between bg-up-green px-4 py-2.5 text-sm font-semibold text-white">
      <span>{{ semester.title }}</span>
      <span class="text-xs font-medium text-white/90">{{ semester.academicYear }}</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full min-w-[640px] text-left text-xs">
        <thead>
          <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-semibold uppercase tracking-wide text-slate-600">
            <th class="px-3 py-2.5">Code</th>
            <th class="px-3 py-2.5">Course Title</th>
            <th class="px-3 py-2.5 text-center">Units</th>
            <th class="px-3 py-2.5 text-center">Grades</th>
            <th class="px-3 py-2.5">AY &amp; Sem Taken</th>
            <th class="px-3 py-2.5">Prerequisites</th>
            <th class="px-3 py-2.5 text-center">Remarks</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          <tr
            v-for="course in semester.courses"
            :key="course.code"
            :class="course.grade === 'INC' ? 'bg-red-50 hover:bg-red-100' : 'hover:bg-slate-50/80'"
          >
            <td class="px-3 py-2 font-semibold text-up-maroon">{{ course.code }}</td>
            <td class="px-3 py-2 text-slate-700">{{ course.title }}</td>
            <td class="px-3 py-2 text-center text-slate-700">{{ course.units }}</td>
            <td
              class="px-3 py-2 text-center"
              :class="course.grade === 'INC' ? 'font-bold text-red-600' : 'font-medium text-slate-700'"
            >
              {{ course.grade }}
            </td>
            <td class="px-3 py-2 text-slate-600">{{ course.aySemTaken }}</td>
            <td class="px-3 py-2 text-slate-500">{{ course.prerequisite || '—' }}</td>
            <td class="px-3 py-2 text-center text-slate-500">
              <span v-if="course.grade === 'INC'" class="font-bold text-red-600">Incomplete</span>
              <span v-else-if="course.grade && course.grade !== 'INC'" class="font-medium text-up-green">Passed</span>
              <span v-else>—</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="space-y-1 border-t border-slate-200 bg-slate-50 px-4 py-3 text-xs text-slate-600">
      <p>Semester GWA: <span class="font-semibold text-slate-800">{{ semester.semesterGwa }}</span></p>
      <p>
        Scholastic Standing:
        <span class="font-semibold text-up-green">{{ semester.scholasticStanding }}</span>
      </p>
    </div>
  </div>
</template>
