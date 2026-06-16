<script setup lang="ts">
definePageMeta({ layout: 'app' })

const {
  profile,
  programCourses,
  specialCourses,
  checklistSemesters,
  planMetrics,
  categoryProgress,
  recommendedSemesters,
  warnings,
  gwaTrend,
  gradeDistribution,
} = useStudentMockData()

const activeTab = ref('checklist')

const tabs = [
  { id: 'checklist', label: 'Curriculum Checklist' },
  { id: 'plan', label: 'Recommended Plan' },
  { id: 'grades', label: 'Grades & GWA' },
]

const progressOffset = computed(() => {
  const circumference = 2 * Math.PI * 54
  return circumference - (profile.progressPercent / 100) * circumference
})

const metricAccent: Record<string, string> = {
  green: 'border-l-up-green',
  red: 'border-l-red-500',
  orange: 'border-l-amber-500',
  blue: 'border-l-sky-500',
}

const maxGradeCount = computed(() => Math.max(...gradeDistribution.map(g => g.count)))

const trendPoints = computed(() => {
  const w = 400
  const h = 160
  const pad = 24
  const min = 1.5
  const max = 3.0
  return gwaTrend.map((point, i) => {
    const x = pad + (i / (gwaTrend.length - 1)) * (w - pad * 2)
    const y = pad + ((max - point.value) / (max - min)) * (h - pad * 2)
    return { x, y, ...point }
  })
})

const trendLine = computed(() => trendPoints.value.map(p => `${p.x},${p.y}`).join(' '))
const trendArea = computed(() => {
  const pts = trendPoints.value
  if (!pts.length) return ''
  const base = 160 - 24
  return `${pts[0].x},${base} ${trendLine.value} ${pts[pts.length - 1].x},${base}`
})
</script>

<template>
  <OurPageShell>
    <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
      <div class="flex flex-wrap items-end gap-3">
        <div>
          <label class="mb-1.5 block text-xs font-medium text-slate-600">Student ID</label>
          <input
            :value="profile.studentId"
            type="text"
            readonly
            class="w-48 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-800"
          >
        </div>
        <button type="button" class="rounded-lg bg-up-green px-6 py-2 text-sm font-semibold uppercase text-white shadow-sm hover:bg-up-green-dark">
          Search
        </button>
      </div>
      <div class="flex gap-2">
        <button type="button" class="rounded-lg bg-up-green px-5 py-2 text-sm font-semibold uppercase text-white hover:bg-up-green-dark">
          Print
        </button>
        <button type="button" class="rounded-lg bg-up-green px-5 py-2 text-sm font-semibold uppercase text-white hover:bg-up-green-dark">
          Export
        </button>
      </div>
    </div>

    <div class="mb-6 grid gap-6 lg:grid-cols-2">
      <!-- Student Information -->
      <div class="relative rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
        <div class="mb-4 flex items-center justify-between">
          <h3 class="text-xs font-bold tracking-wide text-slate-500 uppercase">Student Information</h3>
          <span
            v-if="profile.enrolled"
            class="rounded-full bg-up-maroon px-3 py-1 text-[10px] font-bold tracking-wide text-white uppercase"
          >
            Enrolled
          </span>
        </div>

        <div class="flex gap-4">
          <div class="h-24 w-24 shrink-0 overflow-hidden rounded-lg border-2 border-up-maroon bg-up-maroon/5">
            <div class="flex h-full w-full items-center justify-center text-2xl font-bold text-up-maroon">
              G
            </div>
          </div>
          <div class="min-w-0 flex-1 space-y-2 text-xs text-slate-600">
            <p class="text-sm font-bold text-slate-900 uppercase">{{ profile.name }}</p>
            <p><span class="text-slate-400">Student ID:</span> {{ profile.studentId }}</p>
            <p><span class="text-slate-400">Program:</span> {{ profile.program }}</p>
            <p><span class="text-slate-400">Year Level &amp; Section:</span> {{ profile.yearSection }}</p>
            <p class="flex items-center gap-2">
              <span class="text-slate-400">GWA:</span>
              <span class="rounded bg-rose-100 px-2 py-0.5 font-semibold text-up-maroon">{{ profile.gwa }}</span>
            </p>
            <p><span class="text-slate-400">Latin Honor:</span> {{ profile.latinHonor }}</p>
            <p class="flex items-center gap-2">
              <span class="text-slate-400">Scholastic Standing:</span>
              <span class="rounded bg-emerald-100 px-2 py-0.5 font-semibold text-up-green">{{ profile.scholasticStanding }}</span>
            </p>
          </div>
        </div>
      </div>

      <!-- Progress Summary -->
      <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
        <h3 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">Progress Summary</h3>
        <div class="flex flex-wrap items-start gap-5">
          <div class="relative mx-auto h-28 w-28 shrink-0 sm:mx-0">
            <svg class="h-28 w-28 -rotate-90" viewBox="0 0 120 120">
              <circle cx="60" cy="60" r="54" fill="none" stroke="#e2e8f0" stroke-width="10" />
              <circle
                cx="60" cy="60" r="54" fill="none" stroke="#8a1538" stroke-width="10"
                stroke-linecap="round"
                :stroke-dasharray="`${2 * Math.PI * 54}`"
                :stroke-dashoffset="progressOffset"
              />
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
              <span class="text-lg font-bold text-up-maroon">{{ profile.progressPercent }}%</span>
            </div>
          </div>

          <div class="min-w-0 flex-1 space-y-3">
            <div class="overflow-x-auto rounded border border-slate-200">
              <table class="w-full border-collapse text-[11px]">
                <thead>
                  <tr class="bg-up-green text-white">
                    <th class="border border-slate-200 px-2 py-1.5 text-left font-semibold">Program Courses</th>
                    <th class="border border-slate-200 px-2 py-1.5 text-center font-semibold">Required</th>
                    <th class="border border-slate-200 px-2 py-1.5 text-center font-semibold">Taken</th>
                    <th class="border border-slate-200 px-2 py-1.5 text-center font-semibold">Percentage</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cat in programCourses" :key="cat.label">
                    <td class="border border-slate-200 px-2 py-1.5 text-slate-700">{{ cat.label }}</td>
                    <td class="border border-slate-200 px-2 py-1.5 text-center text-slate-600">{{ cat.required }}</td>
                    <td class="border border-slate-200 px-2 py-1.5 text-center text-slate-600">{{ cat.taken }}</td>
                    <td class="border border-slate-200 px-2 py-1.5 text-center font-medium text-up-green">{{ cat.percentage }}%</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="overflow-x-auto rounded border border-slate-200">
              <table class="w-full border-collapse text-[11px]">
                <thead>
                  <tr class="bg-up-maroon text-white">
                    <th class="border border-slate-200 px-2 py-1.5 text-left font-semibold">Special Courses</th>
                    <th class="border border-slate-200 px-2 py-1.5 text-center font-semibold">Required</th>
                    <th class="border border-slate-200 px-2 py-1.5 text-center font-semibold">Taken</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cat in specialCourses" :key="cat.label">
                    <td class="border border-slate-200 px-2 py-1.5 text-slate-700">{{ cat.label }}</td>
                    <td class="border border-slate-200 px-2 py-1.5 text-center text-slate-600">{{ cat.required }}</td>
                    <td class="border border-slate-200 px-2 py-1.5 text-center text-slate-600">{{ cat.taken }}</td>
                  </tr>
                </tbody>
              </table>
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
        <!-- Curriculum Checklist -->
        <div v-if="activeTab === 'checklist'" class="grid gap-6 xl:grid-cols-2">
      <StudentSemesterTable
        v-for="semester in checklistSemesters"
        :key="semester.title"
        :semester="semester"
      />
    </div>

    <!-- Recommended Plan -->
    <div v-else-if="activeTab === 'plan'" class="space-y-6">
      <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div
          v-for="metric in planMetrics"
          :key="metric.label"
          class="rounded-xl border border-slate-200 border-l-4 bg-white p-4 shadow-[var(--shadow-card)]"
          :class="metricAccent[metric.accent]"
        >
          <p class="text-xs text-slate-500">{{ metric.label }}</p>
          <p class="mt-1 text-2xl font-bold text-slate-900">{{ metric.value }}</p>
        </div>
      </div>

      <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
          <h4 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">Graduation Progress</h4>
          <div class="flex items-center gap-6">
            <div class="relative h-28 w-28 shrink-0">
              <svg class="h-28 w-28 -rotate-90" viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="54" fill="none" stroke="#e2e8f0" stroke-width="10" />
                <circle
                  cx="60" cy="60" r="54" fill="none" stroke="#8a1538" stroke-width="10"
                  stroke-linecap="round"
                  :stroke-dasharray="`${2 * Math.PI * 54}`"
                  :stroke-dashoffset="progressOffset"
                />
              </svg>
              <div class="absolute inset-0 flex items-center justify-center text-sm font-bold text-up-maroon">
                {{ profile.progressPercent }}%
              </div>
            </div>
            <div class="rounded-lg bg-up-maroon px-4 py-3 text-white">
              <p class="text-lg font-bold">{{ profile.unitsCompleted }} of {{ profile.unitsRequired }} units</p>
              <p class="mt-1 text-sm text-white/80">Est. graduation: {{ profile.estimatedGraduation }}</p>
            </div>
          </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
          <h4 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">Progress by Category</h4>
          <div class="space-y-3">
            <div v-for="cat in categoryProgress" :key="cat.label">
              <div class="mb-1 flex justify-between text-xs">
                <span class="font-medium text-slate-700">{{ cat.label }}</span>
                <span class="text-slate-500">{{ cat.taken }} / {{ cat.required }} units</span>
              </div>
              <div class="h-2 overflow-hidden rounded-full bg-slate-100">
                <div
                  class="h-full rounded-full transition-all"
                  :class="cat.color"
                  :style="{ width: `${Math.min(100, (cat.taken / cat.required) * 100)}%` }"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div>
        <h4 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">Recommended Course Plan</h4>
        <div class="grid gap-6 xl:grid-cols-2">
          <div
            v-for="sem in recommendedSemesters"
            :key="sem.title"
            class="overflow-hidden rounded-lg border border-slate-200"
          >
            <div class="flex items-center justify-between bg-up-green px-4 py-2.5 text-sm font-semibold text-white">
              <span>{{ sem.title }}</span>
              <span class="text-xs text-white/90">{{ sem.academicYear }}</span>
            </div>
            <table class="w-full text-xs">
              <thead>
                <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-semibold uppercase text-slate-600">
                  <th class="px-3 py-2 text-left">Code</th>
                  <th class="px-3 py-2 text-left">Course Title</th>
                  <th class="px-3 py-2 text-center">Units</th>
                  <th class="px-3 py-2 text-left">Note</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr v-for="course in sem.courses" :key="course.code">
                  <td class="px-3 py-2 font-semibold text-up-maroon">{{ course.code }}</td>
                  <td class="px-3 py-2 text-slate-700">{{ course.title }}</td>
                  <td class="px-3 py-2 text-center text-slate-700">{{ course.units }}</td>
                  <td class="px-3 py-2">
                    <span
                      v-if="course.note"
                      class="rounded-full bg-sky-100 px-2 py-0.5 text-[10px] font-semibold text-sky-700"
                    >
                      {{ course.note }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div v-if="warnings.length">
        <h4 class="mb-3 text-xs font-bold tracking-wide text-slate-500 uppercase">Warnings &amp; Flags</h4>
        <div
          v-for="(warning, i) in warnings"
          :key="i"
          class="flex flex-wrap items-center justify-between gap-3 rounded-lg border border-red-200 bg-red-50 px-4 py-3"
        >
          <div>
            <p class="text-sm font-semibold text-slate-800">{{ profile.name }}</p>
            <p class="text-xs text-red-600">{{ profile.studentId }} — {{ warning.message }}</p>
          </div>
          <button type="button" class="rounded-lg bg-up-maroon px-4 py-1.5 text-xs font-semibold text-white hover:bg-up-maroon-dark">
            Review
          </button>
        </div>
      </div>
    </div>

    <!-- Grades & GWA -->
    <div v-else class="space-y-6">
      <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-slate-200 border-l-4 border-l-up-maroon bg-white p-4 shadow-[var(--shadow-card)]">
          <p class="text-xs text-slate-500">Current GWA</p>
          <p class="mt-1 text-2xl font-bold text-up-maroon">{{ profile.gwa }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 border-l-4 border-l-up-green bg-white p-4 shadow-[var(--shadow-card)]">
          <p class="text-xs text-slate-500">Academic status</p>
          <p class="mt-1 text-lg font-bold text-up-green">{{ profile.scholasticStanding }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 border-l-4 border-l-red-500 bg-white p-4 shadow-[var(--shadow-card)]">
          <p class="text-xs text-slate-500">INC subjects</p>
          <p class="mt-1 text-lg font-bold text-red-600">PHYSICS 81L</p>
        </div>
        <div class="rounded-xl border border-slate-200 border-l-4 border-l-sky-500 bg-white p-4 shadow-[var(--shadow-card)]">
          <p class="text-xs text-slate-500">Failed subjects</p>
          <p class="mt-1 text-2xl font-bold text-sky-600">0</p>
        </div>
      </div>

      <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
          <h4 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">GWA Trend — Semester by Semester</h4>
          <svg viewBox="0 0 400 160" class="w-full">
            <polygon :points="trendArea" fill="#8a153820" />
            <polyline
              :points="trendLine"
              fill="none"
              stroke="#8a1538"
              stroke-width="2.5"
              stroke-linejoin="round"
              stroke-linecap="round"
            />
            <circle
              v-for="(pt, i) in trendPoints"
              :key="i"
              :cx="pt.x"
              :cy="pt.y"
              r="4"
              fill="#8a1538"
            />
            <text
              v-for="(pt, i) in trendPoints"
              :key="`label-${i}`"
              :x="pt.x"
              :y="150"
              text-anchor="middle"
              class="fill-slate-500 text-[9px]"
            >
              {{ pt.label }}
            </text>
          </svg>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
          <h4 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">Grade Distribution</h4>
          <div class="flex items-end justify-between gap-2" style="height: 160px">
            <div
              v-for="grade in gradeDistribution"
              :key="grade.range"
              class="flex flex-1 flex-col items-center gap-1"
            >
              <div
                class="w-full rounded-t-md transition-all"
                :class="grade.color"
                :style="{ height: `${(grade.count / maxGradeCount) * 120}px` }"
              />
              <span class="text-center text-[9px] text-slate-500">{{ grade.range }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-[var(--shadow-card)]">
        <h4 class="mb-4 text-xs font-bold tracking-wide text-slate-500 uppercase">Academic Standing</h4>
        <div class="mb-4 flex flex-wrap gap-3">
          <span class="rounded bg-emerald-100 px-3 py-1 text-xs font-medium text-up-green">Good (GWA ≥ 2.00)</span>
          <span class="rounded bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">Conditional (GWA 2.00–3.00)</span>
          <span class="rounded bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">Probation (GWA &gt; 3.00)</span>
          <span class="rounded bg-sky-100 px-3 py-1 text-xs font-medium text-sky-700">Dean's List (GWA ≤ 1.75)</span>
        </div>
        <p class="mb-4 text-sm text-slate-600">
          Dean's List qualification requires GWA ≤ 1.75 with no INC or failed subjects.
          <span class="font-medium text-slate-800">Current GWA: {{ profile.gwa }} — not yet qualified.</span>
        </p>
        <div class="grid gap-4 sm:grid-cols-2">
          <div class="rounded-lg bg-amber-50 px-4 py-6 text-center">
            <p class="text-sm font-semibold text-amber-800">Low Academic risk</p>
          </div>
          <div class="rounded-lg bg-amber-50 px-4 py-6 text-center">
            <p class="text-sm font-semibold text-amber-800">Low Delayed grad. risk</p>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
  </OurPageShell>
</template>
