<script setup>
import toast from '@/Stores/toast'
import ToastItem from './ToastItem.vue'
import { onUnmounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const removeFinishEventListener = router.on('finish', () => {
  const { message, icon, type } = page.props.toast
  if (message) {
    toast.add({
      message,
      icon,
      type
    })
  }
})

const remove = (index) => {
  toast.remove(index)
}

onUnmounted(() => removeFinishEventListener())
</script>

<template>
  <TransitionGroup
    tag="div"
    enter-from-class="translate-x-full opacity-0"
    enter-active-class="duration-500"
    leave-active-class="duration-500"
    leave-to-class="translate-x-full opacity-0"
    class="fixed bottom-4 right-6 z-99999 w-full max-w-xs space-y-4"
  >
    <ToastItem
      v-for="({ key, message, icon, type }, index) in toast.items"
      :key="key"
      :message="message"
      :icon="icon || 'check'"
      :type="type || 'success'"
      @remove="remove(index)"
    />
  </TransitionGroup>
</template>
