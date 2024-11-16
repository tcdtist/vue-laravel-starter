<script setup>
import { Link } from '@inertiajs/vue3'
import Logo from '../../assets/images/logo/logo-dark.svg'
</script>

<template>
  <div
    class="flex min-h-screen flex-col items-center justify-center pt-0 dark:bg-boxdark-2 dark:text-bodydark md:pt-6"
  >
    <div>
      <Link href="/">
        <img :src="Logo" alt="Logo de explorer" class="mb-10 max-w-[340px]" />
      </Link>
    </div>

    <div
      class="mt-6 w-[90%] max-w-md overflow-hidden rounded-sm border border-stroke bg-white px-6 py-4 shadow-default dark:border-strokedark dark:bg-boxdark md:w-full md:py-6"
    >
      <slot />
    </div>
  </div>
</template>
