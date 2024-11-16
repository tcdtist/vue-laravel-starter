<script setup>
defineProps({
  message: {
    default: '',
    type: String
  }
})
</script>

<template>
  <div v-show="message">
    <p class="text-sm text-danger">
      {{ message }}
    </p>
  </div>
</template>
