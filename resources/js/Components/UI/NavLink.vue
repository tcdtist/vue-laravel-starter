<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { usePermission } from '@/Composables/permissions'

defineProps({
  url: {
    required: true,
    type: Object
  }
})

const isUrl = (url) => {
  usePage().url
  return url.startsWith(route().current().split('.')[0])
}

const { hasPermission } = usePermission()
</script>

<template>
  <Link
    v-if="hasPermission(url.permissions)"
    class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 lg:py-3"
    :class="isUrl(url.route) && 'bg-graydark dark:bg-meta-4'"
    :href="route(url.route)"
  >
    <i v-if="url.icon" :class="`ti ti-${url.icon}`"></i>
    <p class="-mb-1">
      {{ url.name }}
    </p>
  </Link>
</template>
