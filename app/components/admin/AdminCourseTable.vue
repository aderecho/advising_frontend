<script setup lang="ts">
import type { CourseRow } from '~/composables/useAdminMockData'

defineProps<{
  courses: CourseRow[]
  variant?: 'default' | 'success'
}>()

defineEmits<{
  edit: [course: CourseRow]
  delete: [course: CourseRow]
}>()

const totalUnits = (courses: CourseRow[]) => courses.reduce((sum, c) => sum + c.units, 0)
</script>

<template>
  <div
    class="overflow-hidden rounded-2xl border bg-white"
    :class="variant === 'success' ? 'border-up-green/30 shadow-lg shadow-up-green/5' : 'border-slate-200/80'"
  >
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr
            class="border-b text-left text-xs font-semibold"
            :class="variant === 'success' ? 'border-up-green bg-up-green-dark text-white' : 'border-slate-200 bg-slate-50/80 text-slate-600'"
          >
            <th class="px-5 py-3.5 text-center">#</th>
            <th class="px-5 py-3.5">Course code</th>
            <th class="px-5 py-3.5">Course title</th>
            <th class="px-5 py-3.5 text-center">Units</th>
            <th class="px-5 py-3.5 text-center">Type</th>
            <th class="px-5 py-3.5">Pre-requisite</th>
            <th class="px-5 py-3.5 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y" :class="variant === 'success' ? 'divide-up-green/10' : 'divide-slate-100'">
          <tr
            v-for="(course, index) in courses"
            :key="course.no"
            class="transition-colors"
            :class="[
              variant === 'success' 
                ? (index % 2 === 0 ? 'bg-white' : 'bg-up-green/10') 
                : 'hover:bg-up-green/[0.03]'
            ]"
          >
            <td class="px-5 py-3.5 text-center" :class="variant === 'success' ? 'text-slate-700' : 'text-slate-500'">{{ course.no }}</td>
            <td class="px-5 py-3.5 font-semibold" :class="variant === 'success' ? 'text-up-green-dark' : 'text-up-maroon'">{{ course.code }}</td>
            <td class="px-5 py-3.5 text-slate-800">{{ course.title }}</td>
            <td class="px-5 py-3.5 text-center" :class="variant === 'success' ? 'font-medium text-slate-800' : 'text-slate-700'">{{ course.units }}</td>
            <td class="px-5 py-3.5 text-center">
              <span class="inline-flex rounded-md px-2 py-0.5 text-xs font-medium" :class="variant === 'success' ? 'bg-up-green-dark text-white' : 'bg-up-green text-white'">
                {{ course.type }}
              </span>
            </td>
            <td class="px-5 py-3.5" :class="variant === 'success' ? 'text-slate-700' : 'text-slate-500'">{{ course.prerequisite }}</td>
            <td class="px-5 py-3.5">
              <div class="flex items-center justify-center gap-1">
                <button
                  type="button"
                  class="rounded-lg p-2 text-up-green transition hover:bg-up-green/10"
                  aria-label="Edit"
                  @click="$emit('edit', course)"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </button>
                <button
                  type="button"
                  class="rounded-lg p-2 text-up-maroon transition hover:bg-up-maroon/10"
                  aria-label="Delete"
                  @click="$emit('delete', course)"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div
      class="flex items-center justify-between border-t px-5 py-3.5 text-sm font-bold"
      :class="variant === 'success' ? 'border-up-green/20 bg-slate-200' : 'border-slate-200 bg-slate-50/60'"
    >
      <span class="text-slate-700">{{ variant === 'success' ? 'Current total units:' : 'Total units' }}</span>
      <span class="text-up-green">{{ totalUnits(courses) }}</span>
    </div>
  </div>
</template>
