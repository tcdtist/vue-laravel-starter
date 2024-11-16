<script setup>
import { computed } from 'vue'

const props = defineProps({
  label: {
    type: String,
    default: '',
    required: false
  },
  isRequired: {
    type: Boolean,
    default: false
  }
})

const isRequiredStyles = computed(() =>
  props.isRequired
    ? 'after:content-["*"] after:text-danger after:scale-150 after:relative after:top-[4px]'
    : ''
)
</script>

<template>
  <label class="mb-2 flex items-center gap-3 text-black dark:text-white" :class="isRequiredStyles">
    {{ label }}
  </label>
</template>
