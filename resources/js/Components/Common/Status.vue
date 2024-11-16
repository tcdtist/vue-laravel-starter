<script setup>
const styleStatus = {
  success: 'bg-success text-success',
  danger: 'bg-danger text-danger',
  warning: 'bg-warning text-warning',
  primary: 'bg-primary text-primary'
}

defineProps({
  status: {
    type: Number,
    required: true
  },
  options: {
    type: Object,
    default: () => {
      return {
        0: {
          text: 'Inactivo',
          type: 'danger'
        },
        1: {
          text: 'Activo',
          type: 'success'
        }
      }
    }
  }
})
</script>

<template>
  <p
    class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium"
    :class="styleStatus[options[status].type]"
  >
    {{ options[status].text }}
  </p>
</template>
