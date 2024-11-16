<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Form from '@/Components/Forms/Form.vue'
import Input from '@/Components/Forms/Input.vue'
import Switcher from '@/Components/Forms/Switcher.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  status: 1
})

defineOptions({
  layout: AuthenticatedLayout
})

const submit = () => {
  form.post(route('payment_methods.store'))
}
</script>

<template>
  <Head title="Crear medio de pago" />
  <TitlePage title="Crear medio de pago" />

  <Card>
    <Form>
      <Input
        id="name"
        v-model="form.title"
        label="Nombre"
        :is-required="true"
        :has-error="form.errors.title"
        autofocus
      />

      <Switcher id="status" v-model="form.status" />
    </Form>

    <template #footer>
      <div></div>
      <div class="flex gap-6">
        <Button :href="route('payment_methods.index')" type="danger" icon="circle-half-vertical"
          >Cancelar</Button
        >
        <Button icon="device-floppy" @click="submit">Crear</Button>
      </div>
    </template>
  </Card>
</template>
