<script setup>
import Logo from '../../../assets/images/logo/logo.svg'
import NavLink from './NavLink.vue'
import SidebarGroupLink from './SidebarGroupLink.vue'
import { ref } from 'vue'

defineOptions({
  routes: routesAdmin
})

defineProps({
  routes: {
    default: routesAdmin,
    type: Array
  },
  sidebarOpen: {
    default: false,
    type: Boolean
  }
})

const routeLinkActive = ref('')

const emit = defineEmits(['setSidebarOpen'])

const handleRouteLinkActive = (routeActive) => {
  routeLinkActive.value = routeActive
}

const handleSetSidebarOpen = (status) => {
  emit('setSidebarOpen', status)
}
</script>

<template>
  <div
    v-show="sidebarOpen"
    class="fixed inset-0 z-999"
    @click="emit('setSidebarOpen', false)"
  ></div>
  <aside
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0 2xl:w-[320px]"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
  >
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
      <a to="/">
        <img :src="Logo" alt="Logo" class="max-w-[200px] lg:mt-2 2xl:mt-4" />
      </a>

      <button
        class="block lg:hidden"
        aria-controls="sidebar"
        :aria-expanded="sidebarOpen"
        @click="emit('setSidebarOpen', false)"
      >
        <svg
          class="fill-current"
          width="20"
          height="18"
          viewBox="0 0 20 18"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
            fill=""
          />
        </svg>
      </button>
    </div>

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear 2xl:mt-5">
      <nav class="p-4">
        <ul class="mt-4 flex flex-col gap-4">
          <li v-for="(route, index) in routes" :key="index">
            <SidebarGroupLink
              v-if="route.isGroup === true"
              :key="index"
              :url="route"
              :route-link-active="routeLinkActive"
              @handle-route-link-active="handleRouteLinkActive"
              @handle-set-sidebar-open="handleSetSidebarOpen"
            />
            <NavLink
              v-else
              :url="route"
              @click="
                () => {
                  handleRouteLinkActive(route.route)
                  emit('setSidebarOpen', false)
                }
              "
            />
          </li>
        </ul>
      </nav>
    </div>
  </aside>
</template>
