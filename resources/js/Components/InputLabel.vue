<script setup>
defineProps({
  value: {
    default: '',
    type: String
  }
})
</script>

<template>
  <label class="mb-2.5 block text-black dark:text-white">
    <span v-if="value">{{ value }}</span>
    <span v-else><slot /></span>
  </label>
</template>
