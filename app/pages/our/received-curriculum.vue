<script setup lang="ts">
import { ourStatusVariant } from '~/composables/useOurMockData'

definePageMeta({ layout: 'app' })

const { receivedCurricula } = useOurMockData()
const { courses } = useAdminMockData()

const selectedCurriculum = ref<any>(null)

const startReview = (curriculum: any) => {
  selectedCurriculum.value = curriculum
  window.scrollTo({ top: 0, behavior: 'smooth' })
}

const exitReview = () => {
  selectedCurriculum.value = null
}
</script>

<template>
  <OurPageShell>
    <div v-if="!selectedCurriculum">
      <div class="mb-6">
        <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Received Curriculum</h2>
        <p class="mt-1 text-sm text-slate-600">Curricula submitted by colleges for OUR review</p>
      </div>

      <div class="overflow-hidden rounded-lg border border-slate-200">
        <div class="overflow-x-auto">
          <table class="w-full min-w-[720px] text-left text-sm">
            <thead>
              <tr class="bg-up-green text-xs font-semibold uppercase tracking-wide text-white">
                <th class="px-4 py-3">Program</th>
                <th class="px-4 py-3">Curriculum Year</th>
                <th class="px-4 py-3">Department</th>
                <th class="px-4 py-3">Received Date</th>
                <th class="px-4 py-3">Submitted By</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
              <tr v-for="row in receivedCurricula" :key="row.program + row.curriculumYear" class="hover:bg-slate-50/80">
                <td class="px-4 py-3 font-medium text-slate-800">{{ row.program }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.curriculumYear }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.department }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.receivedDate }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.submittedBy }}</td>
                <td class="px-4 py-3 text-center">
                  <OurStatusBadge :label="row.status" :variant="ourStatusVariant(row.status)" />
                </td>
                <td class="px-4 py-3 text-center">
                  <button type="button" @click="startReview(row)" class="rounded-lg bg-up-maroon px-4 py-1.5 text-xs font-semibold text-white hover:bg-up-maroon-dark">
                    Review
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Review UI -->
    <div v-else class="space-y-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div>
            <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Reviewing Curriculum</h2>
            <p class="mt-1 text-sm text-slate-600">{{ selectedCurriculum.program }} ({{ selectedCurriculum.curriculumYear }})</p>
          </div>
        </div>
        <div class="flex gap-3">
          <button @click="exitReview" class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
            Reject & Return
          </button>
          <button @click="exitReview" class="rounded-lg bg-up-green px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#095D42]">
            Approve & Publish
          </button>
        </div>
      </div>

      <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-1">
          <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
            <h3 class="font-semibold text-slate-900">Curriculum Details</h3>
            <div class="mt-4 space-y-4 text-sm">
              <div>
                <p class="text-slate-500">Department</p>
                <p class="font-medium text-slate-800">{{ selectedCurriculum.department }}</p>
              </div>
              <div>
                <p class="text-slate-500">Submitted By</p>
                <p class="font-medium text-slate-800">{{ selectedCurriculum.submittedBy }}</p>
              </div>
              <div>
                <p class="text-slate-500">Received Date</p>
                <p class="font-medium text-slate-800">{{ selectedCurriculum.receivedDate }}</p>
              </div>
              <div>
                <p class="text-slate-500">Status</p>
                <div class="mt-1">
                  <OurStatusBadge :label="selectedCurriculum.status" :variant="ourStatusVariant(selectedCurriculum.status)" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="lg:col-span-2">
          <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
              <h3 class="font-semibold text-slate-900">Course List Preview</h3>
              <span class="text-sm text-slate-500">1st Year, 1st Semester</span>
            </div>
            <!-- Reusing the admin course table but it has edit/delete actions which we might not want to show, 
                 but it requires @edit and @delete props. We can just pass empty functions or not pass them if not required. -->
            <AdminCourseTable :courses="courses" />
          </div>
        </div>
      </div>
    </div>
  </OurPageShell>
</template>
