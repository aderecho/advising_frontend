export interface CourseRow {
  no: number
  code: string
  title: string
  units: number
  type: string
  prerequisite: string
}

export interface SemesterBlock {
  title: string
  courses: CourseRow[]
}

export interface SelectOption {
  value: string
  label: string
}

const curriculumYears: SelectOption[] = [
  { value: '2023-2024', label: '2023 – 2024' },
  { value: '2024-2025', label: '2024 – 2025' },
  { value: '2025-2026', label: '2025 – 2026' },
  { value: '2026-2027', label: '2026 – 2027' },
  { value: '2027-2028', label: '2027 – 2028' },
]

const departmentsColleges: SelectOption[] = [
  { value: 'ccad', label: 'College of Communication, Art and Design' },
  { value: 'cos', label: 'College of Science' },
  { value: 'som', label: 'School of Management' },
]

const programDurations: SelectOption[] = [
  { value: '2-years', label: '2 years' },
  { value: '4-years', label: '4 years' },
  { value: '5-years', label: '5 years' },
]

export function useAdminMockData() {
  const courses: CourseRow[] = [
    { no: 1, code: 'IT 101', title: 'Introduction to Computing', units: 3, type: 'LEC', prerequisite: 'None' },
    { no: 2, code: 'MATH 101', title: 'College Algebra', units: 3, type: 'LEC', prerequisite: 'None' },
    { no: 3, code: 'ENG 101', title: 'Communication Skills 1', units: 3, type: 'LEC', prerequisite: 'CMSC 12' },
    { no: 4, code: 'CMSC 11', title: 'Foundation of Computer Science', units: 3, type: 'LEC', prerequisite: 'None' },
    { no: 5, code: 'ETHICS 1', title: 'Ethics and Moral Reasoning', units: 3, type: 'LEC', prerequisite: 'None' },
  ]

  const semesters: SemesterBlock[] = [
    {
      title: '1st Year – 1st Semester',
      courses: courses,
    },
    {
      title: '1st Year – 2nd Semester',
      courses: [
        { no: 1, code: 'IT 102', title: 'Computer Programming 1', units: 3, type: 'LEC', prerequisite: 'IT 101' },
        { no: 2, code: 'MATH 102', title: 'Trigonometry', units: 3, type: 'LEC', prerequisite: 'MATH 101' },
        { no: 3, code: 'ENG 102', title: 'Communication Skills 2', units: 3, type: 'LEC', prerequisite: 'ENG 101' },
        { no: 4, code: 'PHYS 101', title: 'General Physics', units: 3, type: 'LEC', prerequisite: 'None' },
      ],
    },
    {
      title: '2nd Year – 1st Semester',
      courses: [
        { no: 1, code: 'IT 201', title: 'Data Structures', units: 3, type: 'LEC', prerequisite: 'IT 102' },
        { no: 2, code: 'IT 202', title: 'Database Systems', units: 3, type: 'LEC', prerequisite: 'IT 101' },
        { no: 3, code: 'STAT 201', title: 'Statistics', units: 3, type: 'LEC', prerequisite: 'MATH 101' },
      ],
    },
    {
      title: '2nd Year – 2nd Semester',
      courses: [
        { no: 1, code: 'IT 203', title: 'Web Development', units: 3, type: 'LEC', prerequisite: 'IT 201' },
        { no: 2, code: 'IT 204', title: 'Networking Fundamentals', units: 3, type: 'LEC', prerequisite: 'IT 101' },
      ],
    },
  ]

  const summaryItems = [
    ['Program', 'BS Information Technology'],
    ['Program code', 'BSIT'],
    ['Curriculum year', '2026 – 2027'],
    ['Active term', '1st Semester'],
    ['Department', 'College of Science'],
    ['Duration', '4 years'],
  ] as const

  const publishedPrograms = [
    { program: 'BS Computer Science', code: 'BSCS', year: '2025 – 2026', status: 'Published', date: 'Jun 10, 2026' },
    { program: 'BS Information Technology', code: 'BSIT', year: '2026 – 2027', status: 'Draft', date: 'Jun 14, 2026' },
  ]

  return {
    courses,
    semesters,
    summaryItems,
    publishedPrograms,
    curriculumYears,
    departmentsColleges,
    programDurations,
  }
}
