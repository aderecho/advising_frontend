<script setup lang="ts">
definePageMeta({ layout: 'app' })

const { publishedPrograms, curriculumYears } = useAdminMockData()

const curriculumYear = ref('2026-2027')
</script>

<template>
  <AdminPageHeader
    title="Publish curriculum"
    description="Review and publish approved curriculum to make it available system-wide."
  />

  <div class="grid gap-6 lg:grid-cols-3">
    <AdminCard
      class="lg:col-span-2"
      title="Select program to publish"
      description="Choose the program and term before publishing."
    >
      <div class="grid gap-5 sm:grid-cols-2">
        <AdminFormField label="Program" type="select">
          <option value="">Select program</option>
          <option selected>BS Information Technology</option>
        </AdminFormField>
        <AdminFormField v-model="curriculumYear" label="Curriculum year" type="select">
          <option value="">Select curriculum year</option>
          <option v-for="year in curriculumYears" :key="year.value" :value="year.value">
            {{ year.label }}
          </option>
        </AdminFormField>
        <AdminFormField label="Effective term" type="select" class="sm:col-span-2">
          <option selected>1st Semester, AY 2026–2027</option>
        </AdminFormField>
      </div>

      <div class="mt-6 flex gap-3 rounded-xl border border-up-yellow/30 bg-up-yellow/10 px-4 py-3.5">
        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-up-yellow/30 text-up-yellow-dark">
          <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
        </span>
        <p class="text-sm leading-relaxed text-up-maroon">
          Publishing will make this curriculum visible to advisers, students, and OUR staff.
        </p>
      </div>

      <div class="mt-8 flex flex-wrap gap-3 border-t border-slate-100 pt-6">
        <AdminButton>Publish curriculum</AdminButton>
        <AdminButton variant="secondary">Cancel</AdminButton>
      </div>
    </AdminCard>

    <AdminCard padding="sm" title="Publication status">
      <ul class="space-y-3">
        <li
          v-for="item in publishedPrograms"
          :key="item.code"
          class="rounded-xl border border-slate-100 bg-slate-50/50 p-4 transition hover:border-slate-200 hover:bg-white"
        >
          <div class="flex items-start justify-between gap-2">
            <div>
              <p class="font-semibold text-slate-900">{{ item.program }}</p>
              <p class="mt-0.5 text-xs text-slate-500">{{ item.code }} · {{ item.year }}</p>
            </div>
            <span
              class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold"
              :class="item.status === 'Published' ? 'bg-up-green/10 text-up-green' : 'bg-slate-200 text-slate-600'"
            >
              {{ item.status }}
            </span>
          </div>
          <p class="mt-2 text-xs text-slate-400">Last updated: {{ item.date }}</p>
        </li>
      </ul>
    </AdminCard>
  </div>
</template>
