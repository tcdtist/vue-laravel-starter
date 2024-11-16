<script setup>
import DarkModeSwitcher from '../Common/DarkModeSwitcher.vue'
import Dropdown from '../Common/Dropdown.vue'
import DropdownLink from '../Common/DropdownLink.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  sidebarOpen: {
    default: false,
    type: Boolean
  }
})

const emit = defineEmits(['setSidebarOpen'])
</script>

<template>
  <header
    class="sticky top-0 z-999 flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none"
    @click="emit('setSidebarOpen', false)"
  >
    <div
      class="flex flex-grow items-center justify-between px-4 py-4 shadow-2 md:px-6 lg:justify-end 2xl:px-11"
    >
      <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
        <button
          class="block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark lg:hidden"
          aria-controls="sidebar"
          @click="
            (e) => {
              e.stopPropagation()
              emit('setSidebarOpen', !sidebarOpen)
            }
          "
        >
          <span class="relative block h-5.5 w-5.5 cursor-pointer">
            <span class="du-block absolute right-0 h-full w-full">
              <span
                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                :class="!sidebarOpen && '!w-full delay-300'"
              ></span>
              <span
                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                :class="!sidebarOpen && 'delay-400 !w-full'"
              ></span>
              <span
                class="relative left-0 top-0 my-1 block h-0.5 w-0 rounded-sm bg-black delay-[0] duration-200 ease-in-out dark:bg-white"
                :class="!sidebarOpen && '!w-full delay-500'"
              ></span>
            </span>
          </span>
        </button>
      </div>

      <div class="flex items-center gap-3 2xsm:gap-7">
        <ul class="flex items-center gap-2 2xsm:gap-4">
          <dark-mode-switcher />
        </ul>

        <Dropdown>
          <template #trigger>
            <span class="hidden text-right lg:block">
              <span class="block text-sm font-medium text-black dark:text-white">
                {{ $page.props.auth.user.full_name }}
              </span>
              <span class="block text-xs">{{ $page.props.auth.role }}</span>
            </span>

            <span class="h-12 w-12 rounded-full">
              <img
                class="rounded-full"
                src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80"
                alt="User"
              />
            </span>
            <i class="ti ti-chevron-down"></i>
          </template>

          <template #content>
            <li>
              <DropdownLink :href="route('users.edit', $page.props.auth.user.id)">
                <i class="ti ti-user-edit"></i>
                Profile
              </DropdownLink>
            </li>
          </template>

          <template #footer>
            <Link
              href="/logout"
              method="post"
              as="button"
              class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base"
            >
              <i class="ti ti-logout-2"></i>
              Log Out
            </Link>
          </template>
        </Dropdown>
      </div>
    </div>
  </header>
</template>
