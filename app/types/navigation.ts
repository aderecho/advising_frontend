import type { UserRole } from '~/types/auth'

export interface NavItem {
  label: string
  to: string
  roles: UserRole[]
  icon: string
}

export interface NavSection {
  title: string
  items: NavItem[]
}

export const navSections: NavSection[] = [
  {
    title: 'Curriculum Management',
    items: [
      { label: 'Curriculum Builder', to: '/admin/curriculum-builder', roles: ['admin'], icon: 'builder' },
      { label: 'Prospectus Preview', to: '/admin/prospectus-preview', roles: ['admin'], icon: 'preview' },
      { label: 'Publish Curriculum', to: '/admin/publish-curriculum', roles: ['admin'], icon: 'publish' },
    ],
  },
  {
    title: 'Academic Data',
    items: [
      { label: 'Received Curriculum', to: '/our/received-curriculum', roles: ['our'], icon: 'received' },
      { label: 'Course Catalog', to: '/our/course-catalog', roles: ['our'], icon: 'catalog' },
      { label: 'Monitor Curriculum & Classes', to: '/our/monitor', roles: ['our'], icon: 'monitor' },
    ],
  },
  {
    title: 'Access & Students',
    items: [
      { label: 'Student Academic Summary', to: '/our/student-summary', roles: ['our'], icon: 'students' },
    ],
  },
  {
    title: 'Advisement',
    items: [
      { label: 'Dashboard', to: '/adviser/dashboard', roles: ['adviser'], icon: 'dashboard' },
    ],
  },
  {
    title: 'Academics',
    items: [
      { label: 'Academic Advisement', to: '/student/dashboard', roles: ['student'], icon: 'advisement' },
    ],
  },
  {
    title: 'Evaluation',
    items: [
      { label: 'Dashboard', to: '/evaluator/dashboard', roles: ['evaluator'], icon: 'dashboard' },
    ],
  },
]

export const pageTitles: Record<string, string> = {
  '/admin/curriculum-builder': 'Curriculum Builder',
  '/admin/prospectus-preview': 'Prospectus Preview',
  '/admin/publish-curriculum': 'Publish Curriculum',
  '/our/received-curriculum': 'Received Curriculum',
  '/our/course-catalog': 'Course Catalog',
  '/our/monitor': 'Monitor Curriculum & Classes',
  '/our/student-summary': 'Student Academic Summary',
  '/adviser/dashboard': 'Adviser Dashboard',
  '/student/dashboard': 'Academic Advisement',
  '/evaluator/dashboard': 'Evaluator Dashboard',
}

const routePrefixRoles: Record<string, UserRole> = {
  admin: 'admin',
  our: 'our',
  adviser: 'adviser',
  student: 'student',
  evaluator: 'evaluator',
}

export function roleFromRoute(path: string): UserRole | null {
  const segment = path.split('/').filter(Boolean)[0]
  return segment ? routePrefixRoles[segment] ?? null : null
}

export function pageTitleFromRoute(path: string): string {
  if (pageTitles[path]) {
    return pageTitles[path]
  }
  const base = path.split('?')[0]
  return pageTitles[base] ?? 'Dashboard'
}
