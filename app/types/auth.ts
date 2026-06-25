export type UserRole = 'admin' | 'our' | 'adviser' | 'student' | 'evaluator'

export interface User {
  id: number
  name: string
  email: string
  role: UserRole
}

export const roleDashboardRoutes: Record<UserRole, string> = {
  admin: '/admin/curriculum-builder',
  our: '/our/course-catalog',
  adviser: '/adviser/assigned-classes',
  student: '/student/dashboard',
  evaluator: '/evaluator/dashboard',
}

export const roleLabels: Record<UserRole, string> = {
  admin: 'Administrator',
  our: 'OUR Staff',
  adviser: 'Adviser',
  student: 'Student',
  evaluator: 'Evaluator',
}
