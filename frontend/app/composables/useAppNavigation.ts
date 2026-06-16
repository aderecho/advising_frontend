import type { UserRole } from '~/types/auth'
import { roleLabels } from '~/types/auth'
import { navSections, pageTitleFromRoute, roleFromRoute } from '~/types/navigation'

export function useCurrentRole(): ComputedRef<UserRole> {
  const auth = useAuthStore()
  const route = useRoute()

  return computed(() => {
    if (auth.user?.role) {
      return auth.user.role
    }
    return roleFromRoute(route.path) ?? 'admin'
  })
}

export function useAppNavigation() {
  const auth = useAuthStore()
  const route = useRoute()
  const currentRole = useCurrentRole()

  const sections = computed(() =>
    navSections
      .map(section => ({
        ...section,
        items: section.items.filter(item => item.roles.includes(currentRole.value)),
      }))
      .filter(section => section.items.length > 0),
  )

  const roleLabel = computed(() => roleLabels[currentRole.value])

  const pageTitle = computed(() => pageTitleFromRoute(route.path))

  const userName = computed(() => auth.user?.name ?? 'Grachelle Mae Carmelotes')

  const userInitial = computed(() => userName.value.charAt(0).toUpperCase())

  function isActive(path: string) {
    return route.path === path || route.path.startsWith(`${path}/`)
  }

  return {
    sections,
    currentRole,
    roleLabel,
    pageTitle,
    userName,
    userInitial,
    isActive,
  }
}
