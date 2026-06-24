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
  <OurPageShell title="">
    <div class="mb-3 flex flex-wrap items-center justify-between gap-4 rounded-xl border border-slate-200 bg-white px-5 py-3 shadow-sm">
      <div class="flex items-center gap-4">
        <label class="text-sm font-bold text-slate-700">Student ID</label>
        <input
          v-model="studentId"
          type="text"
          class="w-64 rounded-md border border-slate-300 px-3 py-1.5 text-sm outline-none focus:border-up-green focus:ring-1 focus:ring-up-green"
        >
        <button
          type="button"
          class="rounded-full bg-[#115E41] px-6 py-1.5 text-xs font-bold tracking-wide text-white transition hover:bg-[#0d4a33]"
          @click="searchStudent"
        >
          SEARCH
        </button>
      </div>
      <div class="flex items-center gap-3">
        <button type="button" class="rounded-full bg-[#115E41] px-6 py-1.5 text-xs font-bold tracking-wide text-white transition hover:bg-[#0d4a33]">
          PRINT
        </button>
        <button type="button" class="rounded-full bg-[#115E41] px-6 py-1.5 text-xs font-bold tracking-wide text-white transition hover:bg-[#0d4a33]">
          EXPORT
        </button>
      </div>
    </div>

    <template v-if="searched">
      <div class="mb-3 grid gap-3 lg:grid-cols-2">
        <!-- Student info card -->
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[var(--shadow-card)]">
          <div class="border-b border-up-maroon bg-up-maroon px-5 py-3">
            <h3 class="text-xs font-bold tracking-wide text-white uppercase">Student Information</h3>
          </div>
          <div class="relative flex flex-col gap-3 p-3 pt-12 sm:flex-row sm:items-start">
            <div v-if="studentSummary.enrolled" class="absolute right-3 top-3">
              <span class="inline-block rounded-full bg-up-maroon px-4 py-1 text-[11px] font-bold tracking-wide text-white uppercase shadow-sm">
                Enrolled
              </span>
            </div>
            <div class="flex flex-col items-center gap-2">
              <div class="shrink-0 rounded-xl border-[3px] border-up-maroon p-[2px]">
                <div class="overflow-hidden rounded-lg">
                  <img src="/student-pic.jpg" class="h-32 w-28 object-cover" alt="Student Photo">
                </div>
              </div>
            </div>

            <div class="min-w-0 flex-1 space-y-3 text-sm text-slate-700">
              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                <span class="w-40 shrink-0 text-slate-500">Name:</span>
                <span class="font-bold text-slate-900 uppercase">{{ studentSummary.name }}</span>
              </div>
              
              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                <span class="w-40 shrink-0 text-slate-500">Student ID:</span>
                <span class="font-medium text-slate-900">{{ studentSummary.studentId }}</span>
              </div>

              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                <span class="w-40 shrink-0 text-slate-500">Program:</span>
                <span class="font-medium text-slate-900">{{ studentSummary.program }}</span>
              </div>

              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span class="w-40 shrink-0 text-slate-500">Year Level & Section:</span>
                <span class="font-medium text-slate-900">{{ studentSummary.yearSection }}</span>
              </div>

              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="w-40 shrink-0 text-slate-500">GWA:</span>
                <span class="rounded bg-pink-200 px-2.5 py-0.5 font-bold text-up-maroon">{{ studentSummary.gwa }}</span>
              </div>

              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                <span class="w-40 shrink-0 text-slate-500">Latin Honor:</span>
                <span class="font-medium text-slate-900">{{ studentSummary.latinHonor }}</span>
              </div>

              <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0 text-up-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                <span class="w-40 shrink-0 text-slate-500">Scholastic Standing:</span>
                <span class="rounded bg-green-200 px-2.5 py-0.5 font-bold text-green-800">{{ studentSummary.scholasticStanding }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[var(--shadow-card)]">
          <div class="border-b border-up-maroon bg-up-maroon px-5 py-3">
            <h3 class="text-xs font-bold tracking-wide text-white uppercase">Progress Summary</h3>
          </div>
          <div class="flex flex-wrap items-start gap-3 p-3">
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
                  <table class="w-full text-xs border border-slate-200">
                    <thead class="bg-up-green text-white">
                      <tr>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-left font-medium">Category</th>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-center font-medium">Required</th>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-center font-medium">Taken</th>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-center font-medium">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cat in studentSummary.programCourses" :key="cat.label" class="border-b border-slate-200">
                        <td class="border-x border-slate-200 py-1.5 px-3 text-slate-700">{{ cat.label }}</td>
                        <td class="border-x border-slate-200 py-1.5 px-3 text-center text-slate-600">{{ cat.required }}</td>
                        <td class="border-x border-slate-200 py-1.5 px-3 text-center text-slate-600">{{ cat.taken }}</td>
                        <td class="border-x border-slate-200 py-1.5 px-3 text-center font-medium text-up-green">{{ cat.percentage }}%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div>
                <p class="mb-2 text-xs font-semibold text-slate-500 uppercase">Special Courses</p>
                <div class="overflow-x-auto">
                  <table class="w-full text-xs border border-slate-200">
                    <thead class="bg-up-green text-white">
                      <tr>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-left font-medium">Category</th>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-center font-medium">Required</th>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-center font-medium">Taken</th>
                        <th class="border-x border-slate-200 py-1.5 px-3 text-center font-medium">%</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cat in studentSummary.specialCourses" :key="cat.label" class="border-b border-slate-200">
                        <td class="border-x border-slate-200 py-1.5 px-3 text-slate-700">{{ cat.label }}</td>
                        <td class="border-x border-slate-200 py-1.5 px-3 text-center text-slate-600">{{ cat.required }}</td>
                        <td class="border-x border-slate-200 py-1.5 px-3 text-center text-slate-600">{{ cat.taken }}</td>
                        <td class="border-x border-slate-200 py-1.5 px-3 text-center font-medium text-up-green">{{ cat.percentage }}%</td>
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

        <div class="p-3">
          <div v-if="activeTab === 'checklist'" class="grid gap-3 xl:grid-cols-2">
            <OurCatalogTable
              v-for="semester in catalogSemesters"
              :key="semester.title"
              :semester="semester"
            />
          </div>

          <div v-else-if="activeTab === 'plan'" class="space-y-6">
            <!-- Top stats row -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
              <div class="flex flex-col justify-center rounded-xl border border-slate-200 border-l-4 border-l-green-600 bg-white p-4 text-center shadow-sm">
                <p class="text-[10px] font-bold uppercase text-slate-400">Suggested Unit Loads</p>
                <p class="mt-1 text-2xl font-bold text-green-600">84</p>
              </div>
              <div class="flex flex-col justify-center rounded-xl border border-slate-200 border-l-4 border-l-red-600 bg-white p-4 text-center shadow-sm">
                <p class="text-[10px] font-bold uppercase text-slate-400">Estimated Graduation</p>
                <div class="mt-1 flex items-center justify-center gap-2">
                  <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                  <p class="text-2xl font-bold text-red-600">2027</p>
                </div>
              </div>
              <div class="flex flex-col justify-center rounded-xl border border-slate-200 border-l-4 border-l-orange-500 bg-white p-4 text-center shadow-sm">
                <p class="text-[10px] font-bold uppercase text-slate-400">Academic risk</p>
                <div class="mt-1 flex items-center justify-center gap-2">
                  <svg class="h-6 w-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                  <p class="text-2xl font-bold text-orange-500">Low</p>
                </div>
              </div>
              <div class="flex flex-col justify-center rounded-xl border border-slate-200 border-l-4 border-l-blue-600 bg-white p-4 text-center shadow-sm">
                <p class="text-[10px] font-bold uppercase text-slate-400">Priority courses</p>
                <div class="mt-1 flex items-center justify-center gap-2">
                  <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                  <p class="text-2xl font-bold text-blue-600">5</p>
                </div>
              </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1fr_2fr]">
              <!-- Graduation Progress -->
              <div>
                <h4 class="mb-3 text-xs font-bold uppercase tracking-wide text-slate-900">Graduation Progress</h4>
                <div class="flex items-center justify-center gap-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                  <div class="relative h-24 w-24 shrink-0">
                    <svg class="h-24 w-24 -rotate-90" viewBox="0 0 120 120">
                      <circle cx="60" cy="60" r="48" fill="none" stroke="#e2e8f0" stroke-width="12" />
                      <circle cx="60" cy="60" r="48" fill="none" stroke="#7b1113" stroke-width="12" stroke-linecap="round" stroke-dasharray="301" stroke-dashoffset="220" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                      <span class="text-sm font-bold text-up-maroon">26.45%</span>
                    </div>
                  </div>
                  <div class="flex flex-col gap-2">
                    <div class="rounded bg-up-maroon px-3 py-2 text-center text-[10px] text-white">
                      <p class="font-bold">51 of 107 units</p>
                      <p class="text-white/80">Est. graduation: 2027</p>
                    </div>
                    <div class="mt-1 flex items-center justify-center gap-3 text-[10px] text-slate-500">
                      <span class="flex items-center gap-1"><span class="h-2 w-2 rounded-sm bg-up-maroon"></span> Completed</span>
                      <span class="flex items-center gap-1"><span class="h-2 w-2 rounded-sm bg-slate-200"></span> Remaining</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Progress by Category -->
              <div>
                <h4 class="mb-3 text-xs font-bold uppercase tracking-wide text-slate-900">Progress by Category</h4>
                <div class="space-y-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                  <div class="flex items-center gap-4 text-xs font-bold">
                    <span class="w-32 text-slate-700">General Education</span>
                    <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-slate-200">
                      <div class="h-full bg-up-maroon" style="width: 36%"></div>
                    </div>
                    <span class="w-20 text-right font-medium text-slate-500">13 / 36 units</span>
                  </div>
                  <div class="flex items-center gap-4 text-xs font-bold">
                    <span class="w-32 text-slate-700">Major Subjects</span>
                    <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-slate-200">
                      <div class="h-full bg-[#115E41]" style="width: 25%"></div>
                    </div>
                    <span class="w-20 text-right font-medium text-slate-500">10 / 40 units</span>
                  </div>
                  <div class="flex items-center gap-4 text-xs font-bold">
                    <span class="w-32 text-slate-700">Electives</span>
                    <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-slate-200">
                      <div class="h-full bg-blue-600" style="width: 46%"></div>
                    </div>
                    <span class="w-20 text-right font-medium text-slate-500">7 / 15 units</span>
                  </div>
                  <div class="flex items-center gap-4 text-xs font-bold">
                    <span class="w-32 text-slate-700">NSTP</span>
                    <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-slate-200">
                      <div class="h-full bg-orange-500" style="width: 100%"></div>
                    </div>
                    <span class="w-20 text-right font-medium text-slate-500">6 / 6 units</span>
                  </div>
                  <div class="flex items-center gap-4 text-xs font-bold">
                    <span class="w-32 text-slate-700">Free Electives</span>
                    <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-slate-200">
                      <div class="h-full bg-red-600" style="width: 75%"></div>
                    </div>
                    <span class="w-20 text-right font-medium text-slate-500">3 / 4 units</span>
                  </div>
                </div>
              </div>
            </div>
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
