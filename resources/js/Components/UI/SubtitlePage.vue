<script setup>
defineProps({
  text: {
    type: String,
    required: true
  }
})
</script>

<template>
  <h4 class="mb-6 text-xl font-semibold text-black dark:text-white">{{ text }}</h4>
</template>
