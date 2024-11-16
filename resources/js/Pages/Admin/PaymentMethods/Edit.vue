<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Form from '@/Components/Forms/Form.vue'
import Input from '@/Components/Forms/Input.vue'
import Switcher from '@/Components/Forms/Switcher.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  paymentMethod: {
    type: Object,
    required: true
  }
})

const form = useForm({
  id: props.paymentMethod.id,
  title: props.paymentMethod.title,
  status: props.paymentMethod.status
})

defineOptions({
  layout: AuthenticatedLayout
})

const submit = () => {
  form.put(route('payment_methods.update', form.id))
}
</script>

<template>
  <Head title="Editar medio de pago" />
  <TitlePage title="Editar medio de pago" />

  <Card>
    <Form>
      <Input
        id="name"
        v-model="form.title"
        label="Nombre"
        :is-required="true"
        :has-error="form.errors.title"
      />

      <Switcher id="status" v-model="form.status" />
    </Form>

    <template #footer>
      <div></div>
      <div class="flex gap-6">
        <Button :href="route('payment_methods.index')" type="danger" icon="circle-half-vertical"
          >Cancelar</Button
        >
        <Button icon="device-floppy" @click="submit">Actualizar</Button>
      </div>
    </template>
  </Card>
</template>
