<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const openDropdown = ref(false)

const closeOnEscape = (e) => {
  if (openDropdown.value && e.key === 'Escape') {
    openDropdown.value = false
  }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))
</script>

<template>
  <div class="relative hover:cursor-pointer">
    <div class="flex items-center gap-4" @click="openDropdown = !openDropdown">
      <slot name="trigger" />
    </div>

    <div v-show="openDropdown" class="fixed inset-0 h-screen" @click="openDropdown = false"></div>

    <div
      class="bolder absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
      :class="openDropdown === true ? 'block' : 'hidden'"
      @click="openDropdown = false"
    >
      <ul class="flex flex-col gap-5 border border-stroke px-6 py-7.5 dark:border-strokedark">
        <slot name="content" />
      </ul>

      <slot name="footer" />
    </div>
  </div>
</template>
