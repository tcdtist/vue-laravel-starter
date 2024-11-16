<script setup>
import Label from './Label.vue'

const classes =
  'w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition placeholder:text-bodydark2 focus:border-primary focus:ring-transparent active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary dark:disabled:bg-black dark:placeholder:text-form-strokedark cursor-pointer'

defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  id: {
    type: String,
    required: true
  },
  label: {
    type: String,
    default: ''
  },
  placeholder: {
    type: String,
    default: ''
  },
  isObject: {
    type: Boolean,
    default: false
  },
  isRequired: {
    type: Boolean,
    default: false
  },
  options: {
    type: [Object, Array],
    default: null
  },
  hasError: {
    type: String,
    default: ''
  },
  value: {
    type: [String, Number],
    default: 0
  }
})

defineEmits(['update:modelValue'])
</script>

<template>
  <div class="flex flex-col">
    <div v-if="label" class="flex justify-between">
      <Label :label="label" :is-required="isRequired" :for="id" />
    </div>

    <select
      :id="id"
      v-bind="$attrs"
      :value="modelValue ? modelValue : value"
      :class="[classes, hasError && 'focus:border-danger active:border-danger']"
      @change="$emit('update:modelValue', $event.target.value)"
    >
      <option v-if="placeholder !== ''" value="">{{ placeholder }}</option>
      <template v-if="isObject">
        <option v-for="item in options" :key="item.id" :value="item.id">
          {{ item.name }}
        </option>
      </template>

      <template v-if="!isObject">
        <option v-for="(item, key) in options" :key="key" :value="key">
          {{ item }}
        </option>
      </template>
    </select>
    <span v-if="hasError !== ''" class="mt-3 text-[.9rem] leading-none text-danger">{{
      hasError
    }}</span>
  </div>
</template>
