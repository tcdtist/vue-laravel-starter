<script setup>
defineProps({
  title: {
    type: String,
    required: false,
    default: ''
  }
})
</script>

<template>
  <div
    class="mb-6 flex flex-col gap-3 text-center sm:flex-row sm:items-center sm:justify-between md:flex-row md:text-left"
  >
    <h2 class="text-title-md2 font-semibold text-black dark:text-white">
      {{ title }}
    </h2>
    <slot />
  </div>
</template>
