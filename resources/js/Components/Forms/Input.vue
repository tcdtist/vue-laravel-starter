<script setup>
import { formatAmount } from '@/Helpers/formatAmount'
import Label from './Label.vue'
import { onMounted, ref } from 'vue'

const classes =
  'w-full rounded-lg border-[1.5px] border-stroke bg-transparent  font-medium outline-none transition placeholder:text-bodydark2 focus:border-primary focus:ring-transparent active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary dark:disabled:bg-black dark:placeholder:text-form-strokedark'

const props = defineProps({
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
  isRequired: {
    type: Boolean,
    default: false
  },
  limit: {
    type: Number,
    default: 0
  },
  onlyNumbers: {
    type: Boolean,
    default: false
  },
  type: {
    type: String,
    default: 'text'
  },
  icon: {
    type: String,
    default: ''
  },
  hasError: {
    type: String,
    default: ''
  },
  isSearch: {
    type: Boolean,
    default: false
  },
  value: {
    type: String,
    default: ''
  }
})

const getLimit = (event) => {
  let value = event.target.value
  if (props.limit > 0 && value.length > props.limit) {
    event.target.value = value.substr(0, props.limit)
    emit('update:modelValue', value.substr(0, props.limit))
  }
}

const onlyNumbers = (event) => {
  if (props.onlyNumbers) {
    if (event.charCode >= 48 && event.charCode <= 57) return true
    else event.preventDefault()
  }
}

const emit = defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) input.value.focus()
  if (input.value.hasAttribute('price')) {
    emit('update:modelValue', formatAmount({ amount: props.modelValue, hasSymbol: false }))
    input.value.addEventListener('input', (event) => {
      let value = event.target.value
      if (value.length > 14) {
        event.target.value = value.substr(0, 14)
        emit('update:modelValue', value.substr(0, 14))
      } else {
        value = formatAmount({ amount: value, hasSymbol: false })
        event.target.value = value
        emit('update:modelValue', value)
      }
    })
  } else {
    input.value.addEventListener('input', (event) => emit('update:modelValue', event.target.value))
  }
})
</script>

<template>
  <div class="flex flex-col">
    <div class="flex justify-between">
      <Label v-if="label" :label="label" :is-required="isRequired" :for="id" />
      <span v-if="limit" class="text-xs"> ({{ modelValue.length }}/{{ limit }}) </span>
    </div>
    <div class="relative">
      <input
        :id="id"
        ref="input"
        v-bind="$attrs"
        :value="modelValue ? modelValue : value"
        :type="type"
        :class="[
          type === 'color' ? 'h-[48px] px-4 py-2' : 'px-5 py-3',
          classes,
          hasError && 'focus:border-danger active:border-danger',
          type !== 'text' && 'cursor-pointer'
        ]"
        @keyup="getLimit"
        @keypress="onlyNumbers"
      />
      <i
        v-if="isSearch"
        class="ti ti-search pointer-events-none absolute right-2 top-2/4 -translate-y-2/4"
        name="Search"
      ></i>
    </div>
    <span v-if="hasError !== ''" class="mt-2 text-[.9rem] leading-none text-danger">{{
      hasError
    }}</span>
  </div>
</template>
