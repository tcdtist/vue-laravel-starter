<script setup>
import Header from '@/Components/UI/Header.vue'
import Sidebar from '@/Components/UI/Sidebar.vue'
import ToastList from '@/Components/Notifications/ToastList.vue'
import { ref } from 'vue'

const sidebarOpen = ref(false)

const setSidebarOpen = (isOpen) => {
  sidebarOpen.value = isOpen
}
</script>

<template>
  <ToastList />

  <div class="dark:bg-boxdark-2 dark:text-bodydark">
    <div class="flex h-screen overflow-hidden">
      <Sidebar :sidebar-open="sidebarOpen" @set-sidebar-open="setSidebarOpen" />
      <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
        <Header :sidebar-open="sidebarOpen" @set-sidebar-open="setSidebarOpen" />
        <main class="h-full">
          <div class="mx-auto h-full max-w-screen-3xl p-4 md:p-6 2xl:p-10">
            <slot />
          </div>
        </main>
      </div>
    </div>
  </div>
</template>
