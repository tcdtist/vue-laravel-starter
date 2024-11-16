<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const buttonTypes = {
  primary: 'bg-primary hover:bg-primaryDark text-white border-transparent',
  danger: 'bg-danger hover:bg-dangerDark text-white border-transparent',
  secondary:
    'border border-stroke bg-gray-2 transition hover:bg-gray dark:border-strokedark dark:bg-meta-4 dark:text-white'
}

const props = defineProps({
  type: {
    type: String,
    default: 'primary'
  },
  icon: {
    type: String,
    default: ''
  },
  align: {
    type: String,
    default: 'left'
  },
  href: {
    type: String,
    default: ''
  },
  isOnlyIcon: {
    type: Boolean,
    default: false
  }
})

const classes = `border h-full block inline-flex items-center justify-center rounded-md ${
  props.isOnlyIcon ? 'h-full lg:h-fit px-4 py-3 lg:py-2.5' : 'py-3 px-8 xl:px-10'
} text-center font-medium duration-300 gap-2 w-auto ${props.isOnlyIcon ? '' : 'md:min-w-[180px]'}`

const align = computed(() => {
  if (props.align === 'right') {
    return 'flex-row-reverse'
  }
  return ''
})
</script>

<template>
  <Link
    v-if="href !== ''"
    :class="[classes, buttonTypes[type], align]"
    :href="href"
    v-bind="$attrs"
  >
    <i v-if="icon" :class="`ti ti-${icon}`"></i>
    <p v-if="!isOnlyIcon" class="-mb-1">
      <slot />
    </p>
  </Link>

  <button v-else :class="[classes, buttonTypes[type], align]" v-bind="$attrs">
    <i v-if="icon" :class="`ti ti-${icon}`"></i>
    <p v-if="!isOnlyIcon" class="-mb-1">
      <slot />
    </p>
  </button>
</template>
