export type OurStatusVariant =
  | 'passed'
  | 'incomplete'
  | 'published'
  | 'draft'
  | 'review'
  | 'archived'
  | 'aligned'
  | 'misaligned'
  | 'active'
  | 'pending'
  | 'disabled'
  | 'enrolled'

export interface CatalogCourseRow {
  code: string
  title: string
  units: number
  grade: string
  aySemTaken: string
  prerequisite: string
  status: 'Passed' | 'Incomplete'
  remarks: string
}

export interface CatalogSemester {
  title: string
  academicYear: string
  courses: CatalogCourseRow[]
  semesterGwa: string
  scholasticStanding: string
}

export interface CurriculumMonitorRow {
  program: string
  curriculumYear: string
  department: string
  duration: string
  totalCourses: number
  totalUnits: number
  studentsEnrolled: number
  status: 'Published' | 'Draft' | 'Under Review' | 'Archived'
}

export interface ClassMonitorRow {
  section: string
  courseCode: string
  courseTitle: string
  units: number
  adviser: string
  enrolled: number
  schedule: string
  curriculum: number
  alignment: 'Aligned' | 'Misaligned'
}

export interface AdviserRow {
  id: number
  name: string
  department: string
  assignedSections: string
  accessLevel: string
  accessEnabled: boolean
  status: 'Active' | 'Pending' | 'Disabled'
}

export interface ReceivedCurriculumRow {
  program: string
  curriculumYear: string
  department: string
  receivedDate: string
  submittedBy: string
  status: 'Received' | 'Under Review' | 'Validated' | 'Draft'
}

export interface ProgressCategory {
  label: string
  required: number
  taken: number
  percentage: number
}

export interface StudentSummary {
  name: string
  studentId: string
  program: string
  yearSection: string
  gwa: string
  latinHonor: string
  scholasticStanding: string
  enrolled: boolean
  progressPercent: number
  programCourses: ProgressCategory[]
  specialCourses: ProgressCategory[]
}

export function useOurMockData() {
  const stats = {
    totalCurriculum: 12,
    published: 9,
    draftPending: 3,
    archived: 4,
  }

  const catalogSemesters: CatalogSemester[] = [
    {
      title: '1st Year – 1st Semester',
      academicYear: 'AY 2025-2026',
      semesterGwa: '2.8500',
      scholasticStanding: 'Good Standing',
      courses: [
        { code: 'CMSC 11', title: 'Introduction to Computing', units: 3, grade: '1.50', aySemTaken: '1st Semester, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'MATH 53', title: 'Elementary Analysis 1', units: 3, grade: '2.00', aySemTaken: '1st Semester, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'PHYS 71', title: 'Elementary Physics', units: 3, grade: '2.25', aySemTaken: '1st Semester, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'ENG 1', title: 'Communication Skills', units: 3, grade: '1.75', aySemTaken: '1st Semester, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'PE 1', title: 'Physical Education 1', units: 2, grade: '1.25', aySemTaken: '1st Semester, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
        { code: 'NSTP 1', title: 'National Service Training Program 1', units: 3, grade: '1.50', aySemTaken: '1st Semester, 2025-2026', prerequisite: '', status: 'Passed', remarks: '' },
      ],
    },
    {
      title: '1st Year – 2nd Semester',
      academicYear: 'AY 2025-2026',
      semesterGwa: '2.0500',
      scholasticStanding: 'Good Standing',
      courses: [
        { code: 'CMSC 12', title: 'Foundations of Computer Science', units: 3, grade: '1.75', aySemTaken: '2nd Semester, 2025-2026', prerequisite: 'CMSC 11', status: 'Passed', remarks: '' },
        { code: 'MATH 54', title: 'Elementary Analysis 2', units: 3, grade: '2.00', aySemTaken: '2nd Semester, 2025-2026', prerequisite: 'MATH 53', status: 'Passed', remarks: '' },
        { code: 'PHYS 72', title: 'Elementary Physics 2', units: 3, grade: '2.50', aySemTaken: '2nd Semester, 2025-2026', prerequisite: 'PHYS 71', status: 'Passed', remarks: '' },
        { code: 'ENG 2', title: 'Communication Skills 2', units: 3, grade: '1.50', aySemTaken: '2nd Semester, 2025-2026', prerequisite: 'ENG 1', status: 'Passed', remarks: '' },
        { code: 'PE 2', title: 'Physical Education 2', units: 2, grade: '1.00', aySemTaken: '2nd Semester, 2025-2026', prerequisite: 'PE 1', status: 'Passed', remarks: '' },
        { code: 'NSTP 2', title: 'National Service Training Program 2', units: 3, grade: 'INC', aySemTaken: '2nd Semester, 2025-2026', prerequisite: 'NSTP 1', status: 'Incomplete', remarks: '' },
      ],
    },
  ]

  const curriculumRows: CurriculumMonitorRow[] = [
    { program: 'BS Computer Science', curriculumYear: '2025 – 2026', department: 'BSCS', duration: '4 yrs', totalCourses: 48, totalUnits: 171, studentsEnrolled: 342, status: 'Published' },
    { program: 'BS Information Technology', curriculumYear: '2025 – 2026', department: 'BSIT', duration: '4 yrs', totalCourses: 45, totalUnits: 168, studentsEnrolled: 289, status: 'Published' },
    { program: 'BS Teacher Education', curriculumYear: '2024 – 2025', department: 'BSTE', duration: '4 yrs', totalCourses: 42, totalUnits: 156, studentsEnrolled: 198, status: 'Draft' },
    { program: 'BS Biology', curriculumYear: '2025 – 2026', department: 'BSBIO', duration: '4 yrs', totalCourses: 46, totalUnits: 165, studentsEnrolled: 155, status: 'Under Review' },
    { program: 'BS Mathematics', curriculumYear: '2023 – 2024', department: 'BSMATH', duration: '4 yrs', totalCourses: 44, totalUnits: 160, studentsEnrolled: 120, status: 'Archived' },
  ]

  const classRows: ClassMonitorRow[] = [
    { section: 'BSCS 3A', courseCode: 'CMSC 132', courseTitle: 'Operating Systems', units: 3, adviser: 'Dr. Santos', enrolled: 49, schedule: 'MWF 9:00–10:00', curriculum: 168, alignment: 'Aligned' },
    { section: 'BSCS 3B', courseCode: 'CMSC 141', courseTitle: 'Programming Languages', units: 3, adviser: 'Prof. Reyes', enrolled: 44, schedule: 'TTh 1:00–2:30', curriculum: 168, alignment: 'Aligned' },
    { section: 'BSIT 2A', courseCode: 'IT 204', courseTitle: 'Data Structures', units: 3, adviser: 'Dr. Cruz', enrolled: 38, schedule: 'MWF 10:00–11:00', curriculum: 155, alignment: 'Misaligned' },
    { section: 'BSIT 2B', courseCode: 'IT 205', courseTitle: 'Web Development', units: 3, adviser: 'Prof. Lim', enrolled: 41, schedule: 'TTh 9:00–10:30', curriculum: 155, alignment: 'Aligned' },
    { section: 'BSCS 4A', courseCode: 'CMSC 199', courseTitle: 'Undergraduate Thesis', units: 3, adviser: 'Dr. Garcia', enrolled: 28, schedule: 'By arrangement', curriculum: 168, alignment: 'Misaligned' },
    { section: 'BSTE 3A', courseCode: 'EDUC 301', courseTitle: 'Teaching Methods', units: 3, adviser: 'Prof. Tan', enrolled: 35, schedule: 'MWF 2:00–3:00', curriculum: 156, alignment: 'Aligned' },
  ]

  const advisers: AdviserRow[] = [
    { id: 1, name: 'Dr. Maria Santos', department: 'BSCS', assignedSections: '3A, 4B', accessLevel: 'Full Advisement', accessEnabled: true, status: 'Active' },
    { id: 2, name: 'Prof. Jose Reyes', department: 'BSIT', assignedSections: '2A, 2B', accessLevel: 'View Only', accessEnabled: true, status: 'Active' },
    { id: 3, name: 'Dr. Ana Cruz', department: 'BSCS', assignedSections: '1A', accessLevel: 'Full Advisement', accessEnabled: false, status: 'Disabled' },
    { id: 4, name: 'Prof. Miguel Lim', department: 'BSTE', assignedSections: '3A', accessLevel: 'Full Advisement', accessEnabled: true, status: 'Pending' },
    { id: 5, name: 'Dr. Elena Garcia', department: 'BSCS', assignedSections: '4A', accessLevel: 'View Only', accessEnabled: true, status: 'Active' },
  ]

  const receivedCurricula: ReceivedCurriculumRow[] = [
    { program: 'BS Computer Science', curriculumYear: '2025 – 2026', department: 'BSCS', receivedDate: 'Jun 10, 2026', submittedBy: 'College of Science', status: 'Validated' },
    { program: 'BS Information Technology', curriculumYear: '2026 – 2027', department: 'BSIT', receivedDate: 'Jun 12, 2026', submittedBy: 'College of Science', status: 'Under Review' },
    { program: 'BS Teacher Education', curriculumYear: '2025 – 2026', department: 'BSTE', receivedDate: 'Jun 14, 2026', submittedBy: 'College of Education', status: 'Draft' },
  ]

  const studentSummary: StudentSummary = {
    name: 'GRACHELLE MAE ALOYAN CARMELOTES',
    studentId: '202604720',
    program: 'BS Computer Science',
    yearSection: '1-A',
    gwa: '2.8500',
    latinHonor: 'None',
    scholasticStanding: 'Good Standing',
    enrolled: true,
    progressPercent: 26.45,
    programCourses: [
      { label: 'GE', required: 24, taken: 9, percentage: 37.5 },
      { label: 'Foundation', required: 18, taken: 6, percentage: 33.33 },
      { label: 'Major', required: 60, taken: 12, percentage: 20 },
      { label: 'Electives', required: 12, taken: 0, percentage: 0 },
      { label: 'PE & NSTP', required: 8, taken: 5, percentage: 62.5 },
    ],
    specialCourses: [
      { label: 'Thesis', required: 6, taken: 0, percentage: 0 },
      { label: 'Practicum', required: 6, taken: 0, percentage: 0 },
    ],
  }

  const departments = [
    { value: '', label: 'Select Departments' },
    { value: 'bscs', label: 'BSCS' },
    { value: 'bsit', label: 'BSIT' },
    { value: 'bste', label: 'BSTE' },
  ]

  return {
    stats,
    catalogSemesters,
    curriculumRows,
    classRows,
    advisers,
    receivedCurricula,
    studentSummary,
    departments,
  }
}

export function ourStatusVariant(status: string): OurStatusVariant {
  const map: Record<string, OurStatusVariant> = {
    Passed: 'passed',
    Incomplete: 'incomplete',
    Published: 'published',
    Draft: 'draft',
    'Under Review': 'review',
    Archived: 'archived',
    Aligned: 'aligned',
    Misaligned: 'misaligned',
    Active: 'active',
    Pending: 'pending',
    Disabled: 'disabled',
    Received: 'review',
    Validated: 'published',
  }
  return map[status] ?? 'draft'
}
