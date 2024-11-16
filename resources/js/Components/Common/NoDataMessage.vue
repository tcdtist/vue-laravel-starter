<script setup>
defineProps({
  message: {
    type: String,
    required: true
  }
})
</script>

<template>
  <h5 class="mt-6 text-center dark:text-gray-2">{{ message }}</h5>
</template>
