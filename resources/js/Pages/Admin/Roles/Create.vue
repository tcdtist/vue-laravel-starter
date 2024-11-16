<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Checkbox from '@/Components/Forms/Checkbox.vue'
import Form from '@/Components/Forms/Form.vue'
import Input from '@/Components/Forms/Input.vue'
import SubtitlePage from '@/Components/UI/SubtitlePage.vue'
import Switcher from '@/Components/Forms/Switcher.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const props = defineProps({
  permissions: {
    type: Object,
    default: () => {
      return {}
    }
  }
})

defineOptions({
  layout: AuthenticatedLayout
})

const form = useForm({
  name: '',
  status: 1,
  permissions: []
})

const submit = () => {
  form.post(route('roles.store'))
}

const isCheckAll = ref(false)

const groupedPermissions = Object.values(
  props.permissions.data.reduce((acc, obj) => {
    const key = obj.module
    if (!acc[key]) {
      acc[key] = { module: key, data: [] }
    }
    acc[key].data.push(obj)
    return acc
  }, {})
)

const columnsPermissions = ['Módulo', 'Ver', 'Crear', 'Editar', 'Eliminar']

const gridCols = computed(() => {
  return `grid-template-columns: 300px repeat(${columnsPermissions.length - 1}, minmax(140px, 1fr))`
})

const handlePermissionsSelected = (id) => {
  isCheckAll.value = false
  if (isCheckedPermission(id)) {
    form.permissions = form.permissions.filter((permission) => permission !== id)
  } else {
    form.permissions.push(id)
  }
}

const isCheckedPermission = (id) => {
  return form.permissions.some((permission) => {
    return permission === id
  })
}

const checkAllPermissions = () => {
  isCheckAll.value = !isCheckAll.value
  form.permissions = []

  if (isCheckAll.value) {
    props.permissions.data.map((permission) => form.permissions.push(permission.id))
  }
}
</script>

<template>
  <Head title="Crear rol" />
  <TitlePage title="Crear rol" />

  <Card>
    <Form>
      <Input
        id="name"
        v-model="form.name"
        label="Nombre"
        :is-required="true"
        :has-error="form.errors.name"
        autofocus
      />

      <Switcher id="status" v-model="form.status" />
    </Form>

    <div class="mt-10">
      <SubtitlePage text="Permisos" class="mb-4" />

      <Checkbox
        id="checkAll"
        label="Seleccionar todo"
        class="mb-4"
        :checked="isCheckAll"
        @click="checkAllPermissions"
      />

      <div class="max-w-full overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr class="grid bg-gray-2 text-left dark:bg-meta-4" :style="gridCols">
              <th
                v-for="(head, i) in columnsPermissions"
                :key="i"
                class="grid place-content-center break-words px-4 py-5 font-medium text-black dark:text-white"
              >
                <div class="flex h-full items-center">
                  {{ head }}
                </div>
              </th>
            </tr>
          </thead>
          <tbody v-if="groupedPermissions.length !== 0" class="grid auto-rows-[60px]">
            <tr
              v-for="(item, i) in groupedPermissions"
              :key="i"
              class="grid items-center border-b border-[#eee] duration-150 last:border-none dark:border-[#eeeeee34]"
              :style="gridCols"
            >
              <td class="grid pl-4">{{ item.module }}</td>
              <td
                v-for="permission in item.data"
                :key="permission.id"
                class="grid place-content-center"
              >
                <Checkbox
                  :id="permission.id"
                  :key="permission.id"
                  :checked="isCheckedPermission(permission.id)"
                  :value="permission.id"
                  @click="handlePermissionsSelected(permission.id)"
                />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <template #footer>
      <div></div>
      <div class="flex gap-6">
        <Button :href="route('roles.index')" type="danger" icon="circle-half-vertical"
          >Cancelar</Button
        >
        <Button icon="device-floppy" @click="submit">Crear</Button>
      </div>
    </template>
  </Card>
</template>
