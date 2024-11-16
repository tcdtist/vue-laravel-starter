<script setup>
import { computed } from 'vue'
import Label from './Label.vue'

const props = defineProps({
  modelValue: {
    type: Number,
    default: 0
  },
  id: {
    type: String,
    required: true
  },
  label: {
    type: String,
    default: 'Estado'
  },
  alternativeOptions: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['update:modelValue'])

const toggleState = () => {
  if (props.modelValue) {
    emit('update:modelValue', 0)
  } else {
    emit('update:modelValue', 1)
  }
}

const textOption = computed(() => {
  if (props.alternativeOptions) {
    return props.modelValue ? 'Si' : 'No'
  } else {
    return props.modelValue ? 'Activo' : 'Inactivo'
  }
})
</script>

<template>
  <div class="flex flex-col">
    <Label :label="label" :for="id" />
    <div class="flex h-[50px] items-center gap-4">
      <div class="relative hover:cursor-pointer" @click="toggleState">
        <input :id="id" type="checkbox" class="sr-only" />
        <div
          class="block h-8 w-14 rounded-full bg-meta-9 dark:bg-[#5A616B]"
          :class="modelValue && 'dark:bg-primary'"
        ></div>
        <div
          class="absolute left-1 top-1 h-6 w-6 rounded-full bg-white transition"
          :class="modelValue && '!right-1 !translate-x-full !bg-primary dark:!bg-white'"
        ></div>
      </div>
      <span
        class="cursor-pointer"
        :class="modelValue ? 'text-primary dark:text-white' : 'text-[#5A616B]'"
        @click="toggleState"
        >{{ textOption }}</span
      >
    </div>
  </div>
</template>
