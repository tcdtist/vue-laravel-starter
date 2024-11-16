<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { computed, defineAsyncComponent } from 'vue'

const props = defineProps({
  message: {
    type: String,
    default: ''
  },
  statusCode: {
    type: [String, Number],
    default: 403
  }
})

defineOptions({
  layout: AuthenticatedLayout
})

const statusCode = computed(() => {
  return props.statusCode.toString()
})

const DynamicSVG = computed(() => {
  return defineAsyncComponent(
    () =>
      import(
        `../../../../assets/images/errors/${statusCode.value === '0' ? '403' : statusCode.value}.vue`
      )
  )
})
</script>

<template>
  <Head :title="statusCode" />

  <div class="flex h-full items-center">
    <div class="mx-auto">
      <p class="mb-6 text-center text-4xl font-bold text-boxdark dark:text-white">ERROR</p>
      <component :is="DynamicSVG" class="mx-auto scale-150" />
      <div class="mt-10 text-center">
        <p class="text-lg font-medium">
          {{ message }}
        </p>
      </div>
    </div>
  </div>
</template>
