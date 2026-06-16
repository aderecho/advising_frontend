<script setup lang="ts">
import { ourStatusVariant } from '~/composables/useOurMockData'

definePageMeta({ layout: 'app' })

const { receivedCurricula } = useOurMockData()
</script>

<template>
  <OurPageShell>
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
                <button type="button" class="rounded-lg bg-up-maroon px-4 py-1.5 text-xs font-semibold text-white hover:bg-up-maroon-dark">
                  Review
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </OurPageShell>
</template>
