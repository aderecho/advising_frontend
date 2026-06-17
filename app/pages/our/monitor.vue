<script setup lang="ts">
import { ourStatusVariant } from '~/composables/useOurMockData'

definePageMeta({ layout: 'app' })

const route = useRoute()
const router = useRouter()

const {
  stats,
  curriculumRows,
  classRows,
  advisers,
  departments,
} = useOurMockData()

const tabs = [
  { id: 'curriculum', label: 'Monitor Curriculum' },
  { id: 'classes', label: 'Monitor All Classes' },
  { id: 'adviser', label: 'Manage Adviser Access' },
]

const activeTab = computed({
  get: () => (route.query.tab as string) || 'curriculum',
  set: (value: string) => router.replace({ query: { tab: value } }),
})

const departmentFilter = ref('')
const classSearch = ref('')
const programFilter = ref('')
const statusFilter = ref('')
const adviserSearch = ref('')
const showAddModal = ref(false)

const adviserForm = reactive({
  firstName: '',
  middleName: '',
  lastName: '',
  department: '',
  assignedSections: '',
  accessLevel: '',
  status: 'Active',
})

const localAdvisers = ref([...advisers])

const filteredClasses = computed(() => {
  const q = classSearch.value.toLowerCase()
  return classRows.filter((row) => {
    const matchesSearch = !q || row.section.toLowerCase().includes(q) || row.courseCode.toLowerCase().includes(q)
    const matchesProgram = !programFilter.value || row.section.toLowerCase().includes(programFilter.value)
    const matchesStatus = !statusFilter.value
      || (statusFilter.value === 'aligned' && row.alignment === 'Aligned')
      || (statusFilter.value === 'misaligned' && row.alignment === 'Misaligned')
    return matchesSearch && matchesProgram && matchesStatus
  })
})

const filteredAdvisers = computed(() => {
  const q = adviserSearch.value.toLowerCase()
  return localAdvisers.value.filter(row => !q || row.name.toLowerCase().includes(q))
})

function submitAdviser() {
  localAdvisers.value.push({
    id: Date.now(),
    name: `Dr. ${adviserForm.firstName} ${adviserForm.lastName}`.trim(),
    department: adviserForm.department || 'BSCS',
    assignedSections: adviserForm.assignedSections || '—',
    accessLevel: adviserForm.accessLevel || 'View Only',
    accessEnabled: adviserForm.status === 'Active',
    status: adviserForm.status as 'Active' | 'Pending' | 'Disabled',
  })
  showAddModal.value = false
  Object.assign(adviserForm, {
    firstName: '',
    middleName: '',
    lastName: '',
    department: '',
    assignedSections: '',
    accessLevel: '',
    status: 'Active',
  })
}
</script>

<template>
  <OurPageShell>
    <div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
      <OurStatCard label="Total Curriculum" :value="stats.totalCurriculum" icon="calendar" />
      <OurStatCard label="Published" :value="stats.published" icon="upload" />
      <OurStatCard label="Draft / Pending" :value="stats.draftPending" icon="clock" />
      <OurStatCard label="Archived" :value="stats.archived" icon="archive" />
    </div>

    <OurTabs v-model="activeTab" :tabs="tabs" class="mb-6" />

    <!-- Monitor Curriculum -->
    <div v-if="activeTab === 'curriculum'" class="space-y-4">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Monitor Curriculum</h2>
        <select
          v-model="departmentFilter"
          class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10"
        >
          <option v-for="dept in departments" :key="dept.value" :value="dept.value">
            {{ dept.label }}
          </option>
        </select>
      </div>

      <div class="overflow-hidden rounded-lg border border-slate-200">
        <div class="overflow-x-auto">
          <table class="w-full min-w-[960px] text-left text-sm">
            <thead>
              <tr class="bg-up-green text-xs font-semibold uppercase tracking-wide text-white">
                <th class="px-4 py-3">Program</th>
                <th class="px-4 py-3">Curriculum Year</th>
                <th class="px-4 py-3">Department</th>
                <th class="px-4 py-3">Duration</th>
                <th class="px-4 py-3 text-center">Total Courses</th>
                <th class="px-4 py-3 text-center">Total Units</th>
                <th class="px-4 py-3 text-center">Students Enrolled</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
              <tr v-for="row in curriculumRows" :key="row.program" class="hover:bg-slate-50/80">
                <td class="px-4 py-3 font-medium text-slate-800">{{ row.program }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.curriculumYear }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.department }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.duration }}</td>
                <td class="px-4 py-3 text-center text-slate-700">{{ row.totalCourses }}</td>
                <td class="px-4 py-3 text-center text-slate-700">{{ row.totalUnits }}</td>
                <td class="px-4 py-3 text-center text-slate-700">{{ row.studentsEnrolled }}</td>
                <td class="px-4 py-3 text-center">
                  <OurStatusBadge :label="row.status" :variant="ourStatusVariant(row.status)" />
                </td>
                <td class="px-4 py-3">
                  <div class="flex flex-wrap justify-center gap-2">
                    <button type="button" class="rounded-lg bg-slate-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-600">
                      View
                    </button>
                    <button type="button" class="rounded-lg bg-up-maroon px-3 py-1.5 text-xs font-semibold text-white hover:bg-up-maroon-dark">
                      Review
                    </button>
                    <button type="button" class="rounded-lg bg-sky-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-sky-700">
                      Validate
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Monitor All Classes -->
    <div v-else-if="activeTab === 'classes'" class="space-y-4">
      <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Active Class Offerings</h2>

      <div class="flex flex-wrap gap-3">
        <input
          v-model="classSearch"
          type="search"
          placeholder="Search section or code..."
          class="min-w-[200px] flex-1 rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10"
        >
        <select
          v-model="programFilter"
          class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10"
        >
          <option value="">Select Programs</option>
          <option value="bscs">BSCS</option>
          <option value="bsit">BSIT</option>
          <option value="bste">BSTE</option>
        </select>
        <select
          v-model="statusFilter"
          class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10"
        >
          <option value="">Select Status</option>
          <option value="aligned">Aligned</option>
          <option value="misaligned">Misaligned</option>
        </select>
      </div>

      <div class="overflow-hidden rounded-lg border border-slate-200">
        <div class="overflow-x-auto">
          <table class="w-full min-w-[960px] text-left text-sm">
            <thead>
              <tr class="bg-up-green text-xs font-semibold uppercase tracking-wide text-white">
                <th class="px-4 py-3">Section</th>
                <th class="px-4 py-3">Course Code</th>
                <th class="px-4 py-3">Course Title</th>
                <th class="px-4 py-3 text-center">Units</th>
                <th class="px-4 py-3">Adviser</th>
                <th class="px-4 py-3 text-center">Enrolled</th>
                <th class="px-4 py-3">Schedule</th>
                <th class="px-4 py-3 text-center">Curriculum</th>
                <th class="px-4 py-3 text-center">Alignment</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
              <tr v-for="row in filteredClasses" :key="row.section + row.courseCode" class="hover:bg-slate-50/80">
                <td class="px-4 py-3 font-medium text-slate-800">{{ row.section }}</td>
                <td class="px-4 py-3 font-semibold text-up-maroon">{{ row.courseCode }}</td>
                <td class="px-4 py-3 text-slate-700">{{ row.courseTitle }}</td>
                <td class="px-4 py-3 text-center text-slate-700">{{ row.units }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.adviser }}</td>
                <td class="px-4 py-3 text-center text-slate-700">{{ row.enrolled }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.schedule }}</td>
                <td class="px-4 py-3 text-center text-slate-700">{{ row.curriculum }}</td>
                <td class="px-4 py-3 text-center">
                  <OurStatusBadge :label="row.alignment" :variant="ourStatusVariant(row.alignment)" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="flex flex-wrap items-center justify-between gap-2 text-xs text-slate-500">
        <p>Showing {{ filteredClasses.length }} of {{ classRows.length }} classes</p>
        <p class="font-medium text-red-600">2 flagged for review</p>
      </div>
    </div>

    <!-- Manage Adviser Access -->
    <div v-else class="space-y-4">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-sm font-bold tracking-wide text-slate-900 uppercase">Manage Adviser Access</h2>
        <button
          type="button"
          class="rounded-lg bg-up-green px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-up-green-dark"
          @click="showAddModal = true"
        >
          Add Adviser
        </button>
      </div>

      <div class="relative">
        <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input
          v-model="adviserSearch"
          type="search"
          placeholder="Search adviser name"
          class="w-full rounded-lg border border-slate-200 py-2.5 pr-3 pl-10 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10"
        >
      </div>

      <div class="overflow-hidden rounded-lg border border-slate-200">
        <div class="overflow-x-auto">
          <table class="w-full min-w-[880px] text-left text-sm">
            <thead>
              <tr class="bg-up-green text-xs font-semibold uppercase tracking-wide text-white">
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Department</th>
                <th class="px-4 py-3">Assigned Sections</th>
                <th class="px-4 py-3">Access Level</th>
                <th class="px-4 py-3 text-center">Access</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="px-4 py-3 text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
              <tr v-for="row in filteredAdvisers" :key="row.id" class="hover:bg-slate-50/80">
                <td class="px-4 py-3 font-medium text-slate-800">{{ row.name }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.department }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.assignedSections }}</td>
                <td class="px-4 py-3 text-slate-600">{{ row.accessLevel }}</td>
                <td class="px-4 py-3">
                  <div class="flex items-center justify-center gap-2">
                    <OurToggle v-model="row.accessEnabled" />
                    <span class="text-xs text-slate-500">{{ row.accessEnabled ? 'Enabled' : 'Disabled' }}</span>
                  </div>
                </td>
                <td class="px-4 py-3 text-center">
                  <OurStatusBadge :label="row.status" :variant="ourStatusVariant(row.status)" />
                </td>
                <td class="px-4 py-3 text-center">
                  <button type="button" class="rounded-lg bg-up-maroon px-4 py-1.5 text-xs font-semibold text-white hover:bg-up-maroon-dark">
                    Edit
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <OurModal :open="showAddModal" title="Adviser Information" @close="showAddModal = false">
      <form class="space-y-4" @submit.prevent="submitAdviser">
        <div class="grid gap-4 sm:grid-cols-3">
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">First Name</label>
            <input v-model="adviserForm.firstName" type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">Middle Name</label>
            <input v-model="adviserForm.middleName" type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">Last Name</label>
            <input v-model="adviserForm.lastName" type="text" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
          </div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">Department</label>
            <select v-model="adviserForm.department" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
              <option value="">Select department</option>
              <option value="BSCS">BSCS</option>
              <option value="BSIT">BSIT</option>
              <option value="BSTE">BSTE</option>
            </select>
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">Assigned Sections</label>
            <input v-model="adviserForm.assignedSections" type="text" placeholder="e.g. 3A, 4B" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">Access Level</label>
            <select v-model="adviserForm.accessLevel" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
              <option value="">Select access level</option>
              <option value="View Only">View Only</option>
              <option value="Full Advisement">Full Advisement</option>
            </select>
          </div>
          <div>
            <label class="mb-1.5 block text-xs font-medium text-slate-600">Status</label>
            <select v-model="adviserForm.status" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-up-maroon/40 focus:ring-2 focus:ring-up-maroon/10">
              <option value="Active">Active</option>
              <option value="Pending">Pending</option>
              <option value="Disabled">Disabled</option>
            </select>
          </div>
        </div>
        <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
          <button type="button" class="rounded-lg bg-slate-500 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-600" @click="showAddModal = false">
            Cancel
          </button>
          <button type="submit" class="rounded-lg bg-up-maroon px-6 py-2.5 text-sm font-semibold text-white hover:bg-up-maroon-dark">
            Submit
          </button>
        </div>
      </form>
    </OurModal>
  </OurPageShell>
</template>
