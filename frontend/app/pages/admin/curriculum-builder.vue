<script setup lang="ts">
definePageMeta({ layout: 'app' })

const {
  courses,
  summaryItems,
  curriculumYears,
  departmentsColleges,
  programDurations,
} = useAdminMockData()

const curriculumYear = ref('2026-2027')
const department = ref('cos')
const programDuration = ref('4-years')
</script>

<template>
  <AdminPageHeader
    title="Build your curriculum"
    description="Set up program details, add courses, and review the curriculum summary before publishing."
  />

  <div class="grid gap-6 xl:grid-cols-3">
    <div class="space-y-6 xl:col-span-2">
      <AdminCard
        title="Program information"
        description="Basic details for the curriculum you are creating."
      >
        <div class="grid gap-5 sm:grid-cols-2">
          <AdminFormField label="Program name" placeholder="e.g. BS Information Technology" class="sm:col-span-2" />
          <AdminFormField v-model="curriculumYear" label="Curriculum year" type="select">
            <option value="">Select curriculum year</option>
            <option v-for="year in curriculumYears" :key="year.value" :value="year.value">
              {{ year.label }}
            </option>
          </AdminFormField>
          <AdminFormField v-model="department" label="Department / college" type="select">
            <option value="">Select department or college</option>
            <option v-for="college in departmentsColleges" :key="college.value" :value="college.value">
              {{ college.label }}
            </option>
          </AdminFormField>
          <AdminFormField v-model="programDuration" label="Program duration" type="select" class="sm:col-span-2">
            <option value="">Select program duration</option>
            <option v-for="duration in programDurations" :key="duration.value" :value="duration.value">
              {{ duration.label }}
            </option>
          </AdminFormField>
        </div>
      </AdminCard>

      <AdminCard
        title="Add course"
        description="Enter course details and save to the curriculum."
      >
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
          <AdminFormField label="Course code" placeholder="e.g. IT 101" />
          <AdminFormField label="Course title" placeholder="Enter course title" />
          <AdminFormField label="Units" placeholder="3" />
          <AdminFormField label="Pre-requisite" placeholder="None" />
          <AdminFormField label="Semester" placeholder="1st Semester" />
        </div>
        <div class="mt-8 flex flex-wrap gap-3 border-t border-slate-100 pt-6">
          <AdminButton>Save course</AdminButton>
          <AdminButton variant="secondary">Reset form</AdminButton>
        </div>
      </AdminCard>
    </div>

    <AdminCard padding="sm" class="h-fit xl:sticky xl:top-24">
      <template #header>
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-base font-semibold text-slate-900">Curriculum summary</h2>
            <p class="mt-1 text-sm text-slate-500">Live preview of your draft</p>
          </div>
          <span class="inline-flex items-center gap-1.5 rounded-full bg-up-green/10 px-3 py-1 text-xs font-semibold text-up-green">
            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-up-green" />
            Active
          </span>
        </div>
      </template>

      <ul class="space-y-4">
        <li
          v-for="[label, value] in summaryItems"
          :key="label"
          class="flex items-start gap-3 rounded-xl border border-slate-100 bg-slate-50/50 px-3 py-2.5"
        >
          <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-up-maroon/10 text-up-maroon">
            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </span>
          <div class="min-w-0">
            <p class="text-xs font-medium text-slate-500">{{ label }}</p>
            <p class="truncate font-medium text-slate-900">{{ value }}</p>
          </div>
        </li>
      </ul>

      <div class="mt-6 grid grid-cols-2 gap-3">
        <div class="rounded-xl border border-slate-100 bg-white px-3 py-4 text-center">
          <p class="text-xs font-medium text-slate-500">Courses added</p>
          <p class="mt-1 text-2xl font-semibold text-up-maroon">2</p>
        </div>
        <div class="rounded-xl border border-slate-100 bg-white px-3 py-4 text-center">
          <p class="text-xs font-medium text-slate-500">Total units</p>
          <p class="mt-1 text-2xl font-semibold text-up-green">6</p>
        </div>
      </div>
    </AdminCard>
  </div>

  <AdminCard class="mt-6" padding="lg">
    <template #header>
      <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <h2 class="text-base font-semibold text-slate-900">Course list</h2>
          <p class="mt-1 text-sm text-slate-500">BS Computer Science · 2025–2026</p>
        </div>
        <div class="flex flex-wrap items-end gap-3">
          <AdminFormField label="Year level" type="select" class="min-w-[140px]">
            <option selected>1st Year</option>
          </AdminFormField>
          <AdminFormField label="Semester" type="select" class="min-w-[140px]">
            <option selected>1st Semester</option>
          </AdminFormField>
          <AdminButton variant="primary-sm" class="mb-0.5">Duplicate semesters</AdminButton>
        </div>
      </div>
    </template>
    <AdminCourseTable :courses="courses" />
  </AdminCard>
</template>
