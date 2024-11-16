import { usePage } from '@inertiajs/vue3'

export function usePermission() {
  const hasRole = (name) => usePage().props.auth.role.includes(name)
  const hasPermission = (name) => {
    if (typeof name !== 'object') return usePage().props.auth.permissions.includes(name)

    let hasPermission = false
    name.forEach((permission) => {
      if (usePage().props.auth.permissions.includes(permission)) hasPermission = true
    })
    return hasPermission
  }

  return { hasRole, hasPermission }
}
