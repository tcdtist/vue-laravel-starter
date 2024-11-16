<script setup>
import { onMounted } from 'vue'

const typeToast = {
  danger: {
    border: 'border-r-danger dark:border-r-danger',
    icon: 'bg-danger'
  },
  warning: '',
  error: '',
  info: '',
  success: {
    border: 'border-r-success dark:border-r-success',
    icon: 'bg-success'
  }
}

defineProps({
  icon: {
    type: String,
    default: 'check'
  },
  message: {
    type: String,
    default: ''
  },
  type: {
    type: String,
    default: 'success'
  }
})

const emit = defineEmits(['remove'])

onMounted(() => {
  setTimeout(() => emit('remove'), 3000)
})
</script>

<template>
  <div
    class="flex items-center rounded-lg border border-r-4 border-stroke bg-white py-4 pl-4 pr-4.5 shadow-2 dark:border-strokedark dark:bg-meta-4"
    :class="typeToast[type].border"
    role="alert"
  >
    <div
      class="inline-flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full text-white"
      :class="typeToast[type].icon"
    >
      <i class="ti text-lg" :class="`ti-${icon}`"></i>
    </div>
    <div class="text-md -mb-1 ml-3 font-normal dark:text-white">{{ message }}</div>
    <button
      type="button"
      class="ml-auto flex dark:text-white"
      data-dismiss-target="#toast-default"
      aria-label="Close"
      @click="emit('remove')"
    >
      <span class="sr-only">Close</span>
      <i class="ti ti-x text-lg"></i>
    </button>
  </div>
</template>
