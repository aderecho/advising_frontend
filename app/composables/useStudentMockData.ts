export type StudentCourseStatus = 'Passed' | 'Incomplete' | 'Enrolled'

export interface StudentCourseRow {
  code: string
  title: string
  units: number
  grade: string
  aySemTaken: string
  prerequisite: string
  status: StudentCourseStatus
  remarks: string
}

export interface StudentSemester {
  title: string
  academicYear: string
  semesterGwa: string
  scholasticStanding: string
  courses: StudentCourseRow[]
  isCurrent?: boolean
  subtitle?: string
}

export interface ProgressCategory {
  label: string
  required: number
  taken: number
  percentage: number
}

export interface PlanMetric {
  label: string
  value: string
  accent: 'green' | 'red' | 'orange' | 'blue'
}

export interface CategoryProgress {
  label: string
  taken: number
  required: number
  color: string
}

export interface RecommendedCourse {
  code: string
  title: string
  units: number
  note?: string
}

export interface WarningFlag {
  message: string
}

export interface GwaTrendPoint {
  label: string
  value: number
}

export interface GradeDistribution {
  range: string
  count: number
  color: string
}

export function useStudentMockData() {
  const profile = {
    name: 'GRACHELLE MAE ALOYAN CARMELOTES',
    studentId: '202604720',
    program: 'BS Computer Science',
    yearSection: '1-A',
    gwa: '2.8500',
    latinHonor: '----',
    scholasticStanding: 'Good Standing',
    enrolled: true,
    progressPercent: 26.45,
    unitsCompleted: 51,
    unitsRequired: 107,
    estimatedGraduation: '2027',
  }

  const programCourses: ProgressCategory[] = [
    { label: 'GE', required: 36, taken: 13, percentage: 36.11 },
    { label: 'Foundation', required: 18, taken: 10, percentage: 55.56 },
    { label: 'Major', required: 40, taken: 10, percentage: 25 },
    { label: 'Mandated', required: 6, taken: 6, percentage: 100 },
    { label: 'Elective', required: 15, taken: 7, percentage: 46.67 },
    { label: 'Free Elective', required: 4, taken: 3, percentage: 75 },
  ]

  const specialCourses: ProgressCategory[] = [
    { label: 'Philippine Studies', required: 3, taken: 0, percentage: 0 },
    { label: 'SP Classes', required: 3, taken: 2, percentage: 66.67 },
  ]

  const checklistSemesters: StudentSemester[] = [
    {
      title: '1st Year — 1st Semester',
      academicYear: 'AY 2025-2026',
      semesterGwa: '2.8500',
      scholasticStanding: 'Good Standing',
      courses: [
        { code: 'CMSC 11', title: 'Introduction to Computing', units: 3, grade: '1.50', aySemTaken: '1st Sem, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'MATH 53', title: 'Elementary Analysis 1', units: 3, grade: '2.00', aySemTaken: '1st Sem, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'PHYS 71', title: 'Elementary Physics', units: 3, grade: '2.25', aySemTaken: '1st Sem, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
      ],
    },
    {
      title: '1st Year — 2nd Semester',
      academicYear: 'AY 2025-2026',
      semesterGwa: '2.0500',
      scholasticStanding: 'Good Standing',
      courses: [
        { code: 'CMSC 12', title: 'Foundations of Computer Science', units: 3, grade: '1.75', aySemTaken: '2nd Sem, 2025-2026', prerequisite: 'CMSC 11', status: 'Passed', remarks: '' },
        { code: 'NSTP 2', title: 'National Service Training Program 2', units: 3, grade: 'INC', aySemTaken: '2nd Sem, 2025-2026', prerequisite: 'NSTP 1', status: 'Incomplete', remarks: '' },
      ],
    },
    {
      title: '2nd Year — 1st Semester',
      academicYear: 'AY 2025-2026',
      semesterGwa: '2.4500',
      scholasticStanding: 'Good Standing',
      courses: [
        { code: 'CMSC 123', title: 'Data Structures', units: 3, grade: '2.00', aySemTaken: '1st Sem, 2025-2026', prerequisite: 'CMSC 12', status: 'Passed', remarks: '' },
        { code: 'MATH 54', title: 'Elementary Analysis 2', units: 3, grade: '2.50', aySemTaken: '1st Sem, 2025-2026', prerequisite: 'MATH 53', status: 'Passed', remarks: '' },
      ],
    },
    {
      title: '3rd Year — 1st Semester',
      academicYear: 'AY 2025-2026',
      semesterGwa: '2.7500',
      scholasticStanding: 'Good Standing',
      courses: [
        { code: 'CMSC 132', title: 'Operating Systems', units: 3, grade: '2.75', aySemTaken: '1st Sem, 2025-2026', prerequisite: 'CMSC 123', status: 'Passed', remarks: '' },
        { code: 'CMSC 141', title: 'Programming Languages', units: 3, grade: '2.50', aySemTaken: '1st Sem, 2025-2026', prerequisite: 'CMSC 123', status: 'Passed', remarks: '' },
      ],
    },
    {
      title: '3rd Year — 2nd Semester',
      academicYear: 'AY 2025-2026 — In Progress',
      semesterGwa: '—',
      scholasticStanding: 'In Progress',
      isCurrent: true,
      subtitle: 'Current semester',
      courses: [
        { code: 'CMSC 161', title: 'Design & Analysis of Algorithms', units: 3, grade: '—', aySemTaken: '2nd Sem, 2025-2026', prerequisite: 'CMSC 123', status: 'Enrolled', remarks: '' },
        { code: 'CMSC 170', title: 'Software Engineering', units: 3, grade: '—', aySemTaken: '2nd Sem, 2025-2026', prerequisite: 'CMSC 132', status: 'Enrolled', remarks: '' },
        { code: 'PHYS 81L', title: 'Physics Laboratory', units: 1, grade: '—', aySemTaken: '2nd Sem, 2025-2026', prerequisite: 'PHYS 72', status: 'Enrolled', remarks: '' },
      ],
    },
  ]

  const planMetrics: PlanMetric[] = [
    { label: 'Suggested Unit Loads', value: '84', accent: 'green' },
    { label: 'Estimated Graduation', value: '2027', accent: 'red' },
    { label: 'Academic risk', value: 'Low', accent: 'orange' },
    { label: 'Priority courses', value: '5', accent: 'blue' },
  ]

  const categoryProgress: CategoryProgress[] = [
    { label: 'General Education', taken: 13, required: 36, color: 'bg-up-maroon' },
    { label: 'Major Subjects', taken: 10, required: 40, color: 'bg-up-green' },
    { label: 'Electives', taken: 7, required: 15, color: 'bg-sky-600' },
    { label: 'NSTP', taken: 6, required: 6, color: 'bg-amber-500' },
    { label: 'Free Electives', taken: 3, required: 4, color: 'bg-orange-500' },
  ]

  const recommendedSemesters = [
    {
      title: '4th Year — 1st Sem',
      academicYear: 'AY 2026-2027',
      courses: [
        { code: 'CMSC 190', title: 'Undergraduate Thesis 1', units: 3, note: 'Priority' },
        { code: 'CMSC 199', title: 'Special Topics in CS', units: 3, note: 'Priority' },
        { code: 'CMSC 165', title: 'Computer Networks', units: 3 },
        { code: 'CMSC 172', title: 'Information Management', units: 3 },
      ] as RecommendedCourse[],
    },
    {
      title: '4th Year — 2nd Sem',
      academicYear: 'AY 2026-2027',
      courses: [
        { code: 'CMSC 191', title: 'Undergraduate Thesis 2', units: 3, note: 'Priority' },
        { code: 'CMSC 198', title: 'Artificial Intelligence', units: 3 },
        { code: 'CMSC 195', title: 'Practicum', units: 3, note: 'Priority' },
      ] as RecommendedCourse[],
    },
  ]

  const warnings: WarningFlag[] = [
    { message: 'INC — PHYSICS 81L (Pending resolution)' },
  ]

  const gwaTrend: GwaTrendPoint[] = [
    { label: '1st Yr 1st', value: 1.85 },
    { label: '1st Yr 2nd', value: 2.30 },
    { label: '2nd Yr 1st', value: 2.45 },
    { label: '2nd Yr 2nd', value: 2.60 },
    { label: '3rd Yr 1st', value: 2.75 },
    { label: '3rd Yr 2nd', value: 2.85 },
  ]

  const gradeDistribution: GradeDistribution[] = [
    { range: '1.00–1.49', count: 2, color: 'bg-up-green' },
    { range: '1.50–1.99', count: 4, color: 'bg-sky-500' },
    { range: '2.00–2.49', count: 6, color: 'bg-slate-400' },
    { range: '2.50–2.99', count: 8, color: 'bg-amber-500' },
    { range: '3.00–4.00', count: 10, color: 'bg-red-500' },
  ]

  return {
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
  }
}

export function studentStatusVariant(status: StudentCourseStatus): 'passed' | 'incomplete' | 'enrolled' {
  const map: Record<StudentCourseStatus, 'passed' | 'incomplete' | 'enrolled'> = {
    Passed: 'passed',
    Incomplete: 'incomplete',
    Enrolled: 'enrolled',
  }
  return map[status]
}
