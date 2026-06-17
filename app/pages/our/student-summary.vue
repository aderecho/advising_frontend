<script setup lang="ts">
definePageMeta({ layout: 'app' })

const { catalogSemesters, studentSummary } = useOurMockData()

const studentId = ref('202604720')
const searched = ref(false)
const activeTab = ref('checklist')

const tabs = [
  { id: 'checklist', label: 'Curriculum Checklist' },
  { id: 'plan', label: 'Recommended Plan' },
  { id: 'grades', label: 'Grades & GWA' },
]

const progressOffset = computed(() => {
  const circumference = 2 * Math.PI * 54
  return circumference - (studentSummary.progressPercent / 100) * circumference
})

function searchStudent() {
  searched.value = studentId.value.trim().length > 0
}
</script>

<template>
  <OurPageShell>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
      <div class="flex flex-wrap items-end gap-3">
        <div>
          <label class="mb-1.5 block text-xs font-medium text-slate-600">Student ID</label>
          <input
            v-model="studentId"
            type="text"
            placeholder="Enter student ID"
            class="w-48 rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10"
          >
        </div>
        <button
          type="button"
          class="rounded-lg bg-up-green px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-up-green-dark"
          @click="searchStudent"
        >
          Search
        </button>
      </div>
      <div class="flex gap-2">
        <button type="button" class="rounded-lg bg-up-green px-5 py-2 text-sm font-semibold text-white hover:bg-up-green-dark">
          Print
        </button>
        <button type="button" class="rounded-lg bg-up-green px-5 py-2 text-sm font-semibold text-white hover:bg-up-green-dark">
          Export
        </button>
      </div>
    </div>

    <template v-if="searched">
      <div class="mb-6 grid gap-6 lg:grid-cols-2">
        <!-- Student info card -->
        <div class="relative overflow-hidden rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
          <span
            v-if="studentSummary.enrolled"
            class="absolute top-4 right-4 rounded-full bg-up-maroon px-3 py-1 text-[10px] font-bold tracking-wide text-white uppercase"
          >
            Enrolled
          </span>

          <div class="flex gap-4">
            <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-up-maroon/10 text-2xl font-bold text-up-maroon">
              G
            </div>
            <div class="min-w-0 space-y-2">
              <h3 class="text-sm font-bold text-slate-900 uppercase">{{ studentSummary.name }}</h3>
              <div class="grid gap-1 text-xs text-slate-600 sm:grid-cols-2">
                <p><span class="font-medium text-slate-500">Student ID:</span> {{ studentSummary.studentId }}</p>
                <p><span class="font-medium text-slate-500">Program:</span> {{ studentSummary.program }}</p>
                <p><span class="font-medium text-slate-500">Year / Section:</span> {{ studentSummary.yearSection }}</p>
                <p>
                  <span class="font-medium text-slate-500">GWA:</span>
                  <span class="font-semibold text-up-maroon">{{ studentSummary.gwa }}</span>
                </p>
                <p><span class="font-medium text-slate-500">Latin Honor:</span> {{ studentSummary.latinHonor }}</p>
                <p>
                  <span class="font-medium text-slate-500">Scholastic Standing:</span>
                  <span class="font-semibold text-up-green">{{ studentSummary.scholasticStanding }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Progress summary -->
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
          <h3 class="mb-4 text-sm font-bold tracking-wide text-slate-900 uppercase">Progress Summary</h3>
          <div class="flex flex-wrap items-start gap-6">
            <div class="relative mx-auto h-32 w-32 shrink-0 sm:mx-0">
              <svg class="h-32 w-32 -rotate-90" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="54" fill="none" stroke="#e2e8f0" stroke-width="10" />
                <circle
                  cx="60"
                  cy="60"
                  r="54"
                  fill="none"
                  stroke="#00573f"
                  stroke-width="10"
                  stroke-linecap="round"
                  :stroke-dasharray="`${2 * Math.PI * 54}`"
                  :stroke-dashoffset="progressOffset"
                />
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-xl font-bold text-slate-900">{{ studentSummary.progressPercent }}%</span>
              </div>
            </div>

            <div class="min-w-0 flex-1 space-y-4">
              <div>
                <p class="mb-2 text-xs font-semibold text-slate-500 uppercase">Program Courses</p>
                <div class="overflow-x-auto">
                  <table class="w-full text-xs">
                    <thead>
                      <tr class="border-b border-slate-200 text-slate-500">
                        <th class="py-1 text-left font-medium">Category</th>
                        <th class="py-1 text-center font-medium">Required</th>
                        <th class="py-1 text-center font-medium">Taken</th>
                        <th class="py-1 text-center font-medium">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cat in studentSummary.programCourses" :key="cat.label" class="border-b border-slate-100">
                        <td class="py-1.5 text-slate-700">{{ cat.label }}</td>
                        <td class="py-1.5 text-center text-slate-600">{{ cat.required }}</td>
                        <td class="py-1.5 text-center text-slate-600">{{ cat.taken }}</td>
                        <td class="py-1.5 text-center font-medium text-up-green">{{ cat.percentage }}%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div>
                <p class="mb-2 text-xs font-semibold text-slate-500 uppercase">Special Courses</p>
                <div class="overflow-x-auto">
                  <table class="w-full text-xs">
                    <thead>
                      <tr class="border-b border-slate-200 text-slate-500">
                        <th class="py-1 text-left font-medium">Category</th>
                        <th class="py-1 text-center font-medium">Required</th>
                        <th class="py-1 text-center font-medium">Taken</th>
                        <th class="py-1 text-center font-medium">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cat in studentSummary.specialCourses" :key="cat.label" class="border-b border-slate-100">
                        <td class="py-1.5 text-slate-700">{{ cat.label }}</td>
                        <td class="py-1.5 text-center text-slate-600">{{ cat.required }}</td>
                        <td class="py-1.5 text-center text-slate-600">{{ cat.taken }}</td>
                        <td class="py-1.5 text-center font-medium text-up-green">{{ cat.percentage }}%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[var(--shadow-card)]">
        <div class="border-b border-slate-200 px-5 py-4">
          <OurTabs v-model="activeTab" :tabs="tabs" />
        </div>

        <div class="p-5">
          <div v-if="activeTab === 'checklist'" class="grid gap-6 xl:grid-cols-2">
            <OurCatalogTable
              v-for="semester in catalogSemesters"
              :key="semester.title"
              :semester="semester"
            />
          </div>

          <div v-else-if="activeTab === 'plan'" class="rounded-xl border border-slate-200 bg-slate-50 p-8 text-center text-sm text-slate-500">
            Recommended plan will be displayed here once connected to the backend.
          </div>

          <div v-else class="rounded-xl border border-slate-200 bg-white p-6">
            <div class="grid gap-4 sm:grid-cols-3">
              <div class="rounded-lg bg-slate-50 p-4 text-center">
                <p class="text-xs text-slate-500">Overall GWA</p>
                <p class="text-2xl font-bold text-up-maroon">{{ studentSummary.gwa }}</p>
              </div>
              <div class="rounded-lg bg-slate-50 p-4 text-center">
                <p class="text-xs text-slate-500">Units Completed</p>
                <p class="text-2xl font-bold text-slate-900">32</p>
              </div>
              <div class="rounded-lg bg-slate-50 p-4 text-center">
                <p class="text-xs text-slate-500">Scholastic Standing</p>
                <p class="text-lg font-bold text-up-green">{{ studentSummary.scholasticStanding }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>

    <div v-else class="rounded-xl border border-dashed border-slate-300 bg-slate-50 py-16 text-center">
      <p class="text-sm text-slate-500">Enter a student ID and click Search to view the academic summary.</p>
    </div>
  </OurPageShell>
</template>
