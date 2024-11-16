<script setup>
import Button from '../Buttons/Button.vue'
import { onMounted, onUnmounted, watch } from 'vue'

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  closeable: {
    type: Boolean,
    default: true
  },
  icon: {
    type: Object,
    default: () => {}
  },
  slots: {
    type: Object,
    default: () => {}
  },
  buttonCancel: {
    type: Object,
    default: () => {}
  },
  buttonConfirm: {
    type: Object,
    default: () => {}
  }
})

const emit = defineEmits(['close', 'confirm'])

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = 'hidden'
    } else {
      document.body.style.overflow = null
    }
  }
)

const close = () => {
  if (props.closeable) {
    emit('close')
  }
}

const closeOnEscape = (e) => {
  if (e.key === 'Escape' && props.show) {
    close()
  }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape)
  document.body.style.overflow = null
})
</script>

<template>
  <Teleport to="body">
    <Transition
      enter-active-class="ease-out duration-300"
      enter-from-class="opacity-0 translate-y-4 sm:translate-y-0"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="ease-in duration-200"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-4 sm:translate-y-0"
    >
      <div
        v-show="show"
        class="fixed left-0 top-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5"
        scroll-region
      >
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-show="show"
            class="max-h-screen w-full max-w-142.5 overflow-auto rounded-lg bg-white px-8 py-12 text-center dark:bg-boxdark md:px-17.5 md:py-15"
          >
            <div class="relative mx-auto flex h-[60px] w-[60px] items-center justify-center">
              <div class="h-full w-full rounded-full opacity-25" :class="`bg-${icon.type}`"></div>
              <i class="ti absolute text-4xl" :class="`ti-${icon.name} text-${icon.type}`"></i>
            </div>

            <h3
              v-if="slots.title"
              class="mt-5.5 pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl"
            >
              {{ slots.title }}
            </h3>

            <p v-if="slots.body" class="my-8 dark:text-gray-3">
              {{ slots.body }}
            </p>

            <div class="-mx-3 flex flex-wrap justify-center gap-6">
              <Button v-if="buttonCancel" :type="buttonCancel.type" @click="emit('confirm', false)">
                {{ buttonCancel.text }}
              </Button>

              <Button
                v-if="buttonConfirm"
                :type="buttonConfirm.type"
                @click="emit('confirm', true)"
              >
                {{ buttonConfirm.text }}
              </Button>
            </div>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
