<script setup>
defineProps({
  title: {
    type: String,
    default: ''
  },
  icon: {
    type: String,
    default: ''
  }
})
</script>

<template>
  <button class="duration-150 hover:text-primary" :title="title">
    <i v-if="icon" :class="`ti ti-${icon}`"></i>
  </button>
</template>
