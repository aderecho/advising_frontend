<script setup lang="ts">
import { storeToRefs } from 'pinia'

definePageMeta({ layout: 'app' })

const { courses, summaryItems } = useAdminMockData()

const curriculumStore = useCurriculumStore()
const { curriculumYears, colleges, programs, loading } = storeToRefs(curriculumStore)

onMounted(() => {
  curriculumStore.fetchInitialData()
})

const programId = ref('')
const curriculumYearId = ref('')
const departmentId = ref('')
const programDuration = ref('')

const uniqueDurations = computed(() => {
  const durations = programs.value.map(p => p.duration_years).filter(Boolean)
  return [...new Set(durations)].sort()
})

// Auto-populate duration if a program is selected
watch(programId, (newId) => {
  const selectedProgram = programs.value.find(p => String(p.id) === String(newId))
  if (selectedProgram && selectedProgram.duration_years) {
    programDuration.value = String(selectedProgram.duration_years)
  }
})

// Course form state
const courseCode = ref('')
const courseTitle = ref('')
const courseUnits = ref('')
const coursePrerequisite = ref('')
const courseSemester = ref('')

const config = useRuntimeConfig()
const apiUrl = (config.public.apiUrl || config.public.apiBase || '/api') as string

// Watch courseCode and fetch details
let timeoutId: any = null
watch(courseCode, (newCode) => {
  if (timeoutId) clearTimeout(timeoutId)
  
  if (!newCode || newCode.length < 3) return
  
  timeoutId = setTimeout(async () => {
    try {
      const response: any = await $fetch(`${apiUrl}/courses/${encodeURIComponent(newCode)}`)
      if (response && !response.error) {
        courseTitle.value = response.title || ''
        courseUnits.value = response.units || ''
        coursePrerequisite.value = response.prerequisite || ''
        courseSemester.value = response.semester || ''
      }
    } catch (e) {
      // Ignore errors for not found
    }
  }, 500)
})

const isCourseSaved = ref(false)

const saveCourse = () => {
  // In a real app this would add the course to a list/store
  isCourseSaved.value = true
}

const isEditing = ref(false)

const resetForm = () => {
  courseCode.value = ''
  courseTitle.value = ''
  courseUnits.value = ''
  coursePrerequisite.value = ''
  courseSemester.value = ''
}

const cancelEdit = () => {
  isEditing.value = false
  resetForm()
}

const showDeleteModal = ref(false)
const courseToDelete = ref<any>(null)

const confirmDelete = (course: any) => {
  courseToDelete.value = course
  showDeleteModal.value = true
}

const deleteCourse = () => {
  if (courseToDelete.value) {
    const index = courses.findIndex(c => c.no === courseToDelete.value.no)
    if (index > -1) {
      courses.splice(index, 1)
    }
  }
  showDeleteModal.value = false
  courseToDelete.value = null
}

const editCourse = (course: any) => {
  courseCode.value = course.code
  courseTitle.value = course.title
  courseUnits.value = String(course.units)
  coursePrerequisite.value = course.prerequisite
  isEditing.value = true
  // Scroll to form or highlight it?
  window.scrollTo({ top: 0, behavior: 'smooth' })
}
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
          <AdminFormField v-model="programId" label="Program" type="select" class="sm:col-span-2" :disabled="loading">
            <option value="">{{ loading ? 'Loading programs...' : (programs.length ? 'Select program' : 'No programs available') }}</option>
            <option v-for="program in programs" :key="program.id" :value="program.id">
              {{ program.code }} - {{ program.name }}
            </option>
          </AdminFormField>
          
          <AdminFormField v-model="curriculumYearId" label="Curriculum year" type="select" :disabled="loading">
            <option value="">{{ loading ? 'Loading years...' : (curriculumYears.length ? 'Select curriculum year' : 'No years available') }}</option>
            <option v-for="year in curriculumYears" :key="year.id" :value="year.id">
              {{ year.year }}
            </option>
          </AdminFormField>
          
          <AdminFormField v-model="departmentId" label="Department / college" type="select" :disabled="loading">
            <option value="">{{ loading ? 'Loading departments...' : (colleges.length ? 'Select department or college' : 'No departments available') }}</option>
            <option v-for="college in colleges" :key="college.id" :value="college.id">
              {{ college.name }}
            </option>
          </AdminFormField>
          
          <AdminFormField v-model="programDuration" label="Program duration" type="select" :disabled="loading">
            <option value="">{{ loading ? 'Loading durations...' : (uniqueDurations.length ? 'Select program duration' : 'No durations available') }}</option>
            <option v-for="duration in uniqueDurations" :key="duration" :value="duration">
              {{ duration }} years
            </option>
          </AdminFormField>
        </div>
      </AdminCard>

      <AdminCard
        :title="isEditing ? 'Edit course' : 'Add course'"
        :description="isEditing ? 'Update course details for the curriculum.' : 'Enter course details and save to the curriculum.'"
      >
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-6">
          <AdminFormField v-model="courseCode" label="Course code" placeholder="e.g. IT 101" class="lg:col-span-2" />
          <AdminFormField v-model="courseTitle" label="Course title" placeholder="Enter course title" class="lg:col-span-3" />
          <AdminFormField v-model="courseUnits" label="Units" placeholder="3" class="lg:col-span-1" />
          <AdminFormField v-model="coursePrerequisite" label="Pre-requisite" placeholder="None" class="lg:col-span-3" />
          <AdminFormField v-model="courseSemester" label="Semester" placeholder="1st Semester" class="lg:col-span-3" />
        </div>
        <div class="mt-8 flex flex-wrap gap-3 border-t border-slate-100 pt-6">
          <AdminButton v-if="!isEditing" @click="saveCourse">Save course</AdminButton>
          <AdminButton v-else @click="saveCourse">Update course</AdminButton>
          <button v-if="!isEditing" @click="resetForm" class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Reset form</button>
          <button v-else @click="cancelEdit" class="rounded-xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Cancel edit</button>
        </div>
      </AdminCard>
    </div>

    <AdminCard v-if="isCourseSaved" padding="sm" class="h-fit xl:sticky xl:top-24">
      <template #header>
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-base font-semibold text-white">Curriculum summary</h2>
            <p class="mt-0.5 text-xs text-white/80">Live preview of your draft</p>
          </div>
          <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white">
            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-white" />
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
          <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg text-up-maroon">
            <!-- Program: Document icon -->
            <svg v-if="label === 'Program'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <!-- Program code: Code icon -->
            <svg v-else-if="label === 'Program code'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
            <!-- Curriculum year: Calendar icon -->
            <svg v-else-if="label === 'Curriculum year'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <!-- Active term: Clock icon -->
            <svg v-else-if="label === 'Active term'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <!-- Department: Building icon -->
            <svg v-else-if="label === 'Department'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <!-- Duration: Hourglass icon -->
            <svg v-else-if="label === 'Duration'" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <!-- Fallback icon -->
            <svg v-else class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </span>
          <div class="min-w-0">
            <p class="text-xs font-medium text-slate-500">{{ label }}</p>
            <p class="truncate font-medium text-slate-900">{{ value }}</p>
          </div>
        </li>
      </ul>

      <div class="mt-6 grid grid-cols-2 gap-3">
        <div class="rounded-xl border border-slate-200 bg-slate-100 px-3 py-4 text-center">
          <p class="text-xs font-medium text-slate-500">Courses added</p>
          <p class="mt-1 text-2xl font-semibold text-up-maroon">2</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-slate-100 px-3 py-4 text-center">
          <p class="text-xs font-medium text-slate-500">Total units</p>
          <p class="mt-1 text-2xl font-semibold text-up-green">6</p>
        </div>
      </div>
    </AdminCard>
  </div>

  <AdminCard v-if="isCourseSaved" class="mt-6" padding="lg">
    <template #header>
      <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <h2 class="text-base font-semibold text-white">Course list</h2>
          <p class="mt-0.5 text-xs text-white/80">BS Computer Science · 2025–2026</p>
        </div>
        <div class="flex flex-wrap items-end gap-3">
          <AdminFormField label="Year level" type="select" class="min-w-[140px]" labelClass="text-white">
            <option selected>1st Year</option>
          </AdminFormField>
          <AdminFormField label="Semester" type="select" class="min-w-[140px]" labelClass="text-white">
            <option selected>1st Semester</option>
          </AdminFormField>
          <AdminButton variant="primary-sm" class="mb-0.5">Duplicate semesters</AdminButton>
        </div>
      </div>
    </template>
    <AdminCourseTable :courses="courses" @edit="editCourse" @delete="confirmDelete" />
  </AdminCard>

  <Teleport to="body">
    <div
      v-if="showDeleteModal"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4"
      @click.self="showDeleteModal = false"
    >
      <div class="relative w-full max-w-md overflow-hidden rounded-xl bg-white p-8 shadow-xl">
        <button
          type="button"
          class="absolute top-4 right-4 rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
          aria-label="Close"
          @click="showDeleteModal = false"
        >
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

        <div class="flex flex-col items-center text-center">
          <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-up-maroon/10 text-up-maroon">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </div>

          <p class="text-lg font-semibold text-slate-900">Remove Course?</p>
          <p class="mt-2 text-sm text-slate-500">
            Are you sure you want to remove <span class="font-bold">{{ courseToDelete?.code }}</span> from this curriculum?
          </p>

          <div class="mt-8 flex justify-center gap-4">
            <button
              type="button"
              class="min-w-[7rem] rounded-lg bg-slate-500 px-8 py-3 text-base font-semibold text-white transition hover:bg-slate-600"
              @click="showDeleteModal = false"
            >
              Cancel
            </button>
            <button
              type="button"
              class="min-w-[7rem] rounded-lg bg-up-maroon px-8 py-3 text-base font-semibold text-white transition hover:bg-up-maroon-dark"
              @click="deleteCourse"
            >
              Remove
            </button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>
