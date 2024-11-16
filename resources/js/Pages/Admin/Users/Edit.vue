<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Input from '@/Components/Forms/Input.vue'
import Switcher from '@/Components/Forms/Switcher.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head, useForm } from '@inertiajs/vue3'
import Select from '@/Components/Forms/Select.vue'

const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  roles: {
    type: Object,
    required: true
  }
})

defineOptions({
  layout: AuthenticatedLayout
})

const form = useForm({
  id: props.user.id,
  identification_number: props.user.identification_number,
  full_name: props.user.full_name,
  phone_number: props.user.phone_number,
  address: props.user.address,
  email: props.user.email,
  password: '',
  password_confirmation: '',
  role: props.user.role,
  status: props.user.status
})

const submit = () => {
  form.put(route('users.update', form.id))
}
</script>

<template>
  <Head title="Editar usuario" />
  <TitlePage title="Editar usuario" />

  <Card>
    <div class="grid gap-10 md:grid-cols-2 md:gap-20 md:gap-y-10 lg:grid-cols-3 2xl:grid-cols-4">
      <Input
        id="identification_number"
        v-model="form.identification_number"
        label="Número de identificación"
        :is-required="true"
        :has-error="form.errors.identification_number"
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
    </div>

    <template #footer>
      <div></div>
      <div class="flex gap-6">
        <Button :href="route('users.index')" type="danger" icon="circle-half-vertical"
          >Cancelar</Button
        >
        <Button icon="device-floppy" @click="submit">Actualizar</Button>
      </div>
    </template>
  </Card>
</template>
