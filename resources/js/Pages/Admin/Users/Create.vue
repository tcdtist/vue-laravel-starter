<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Input from '@/Components/Forms/Input.vue'
import Switcher from '@/Components/Forms/Switcher.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head, useForm } from '@inertiajs/vue3'
import Form from '@/Components/Forms/Form.vue'
import Select from '@/Components/Forms/Select.vue'

defineProps({
  roles: {
    type: Object,
    required: true
  }
})

const form = useForm({
  identification_number: '',
  full_name: '',
  phone_number: '',
  address: '',
  email: '',
  password: '',
  password_confirmation: '',
  status: 1,
  role: 1
})

defineOptions({
  layout: AuthenticatedLayout
})

const submit = () => {
  form.post(route('users.store'))
}
</script>

<template>
  <Head title="Crear usuario" />
  <TitlePage title="Crear usuario" />

  <Card>
    <Form>
      <Input
        id="identification_number"
        v-model="form.identification_number"
        label="Número de identificación"
        :is-required="true"
        :has-error="form.errors.identification_number"
        autofocus
      />

      <Input
        id="full_name"
        v-model="form.full_name"
        label="Nombre Completo"
        :is-required="true"
        :has-error="form.errors.full_name"
      />

      <Input
        id="phone_number"
        v-model="form.phone_number"
        label="Número de teléfono"
        :is-required="true"
        :has-error="form.errors.phone_number"
      />

      <Input
        id="email"
        v-model="form.email"
        type="email"
        label="Correo"
        placeholder="xxx@gmail.com"
        :is-required="true"
        :has-error="form.errors.email"
      />

      <Input
        id="password"
        v-model="form.password"
        type="password"
        label="Contraseña"
        :is-required="true"
        :has-error="form.errors.password"
      />

      <Input
        id="password_confirmation"
        v-model="form.password_confirmation"
        type="password"
        label="Confirmar contraseña"
        :is-required="true"
        :has-error="form.errors.password_confirmation"
      />

      <Input
        id="address"
        v-model="form.address"
        label="Dirección"
        :has-error="form.errors.address"
      />

      <Select id="role" v-model="form.role" label="Rol" :options="roles" />

      <Switcher id="status" v-model="form.status" />
    </Form>

    <template #footer>
      <div></div>
      <div class="flex gap-6">
        <Button :href="route('users.index')" type="danger" icon="circle-half-vertical"
          >Cancelar</Button
        >
        <Button icon="device-floppy" @click="submit">Crear</Button>
      </div>
    </template>
  </Card>
</template>
