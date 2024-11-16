<template>
  <div
    class="rounded-sm border border-stroke bg-white px-5 pb-6 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-6"
  >
    <div v-if="$slots.header" class="mb-10 mt-4 text-title-sm font-bold text-black dark:text-white">
      <slot name="header" />
    </div>
    <slot />

    <div v-if="$slots.footer" class="mt-10 flex justify-center gap-4 md:justify-between lg:mt-15">
      <slot name="footer" />
    </div>
  </div>
</template>
