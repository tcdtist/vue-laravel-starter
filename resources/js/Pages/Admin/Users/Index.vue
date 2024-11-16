<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Table from '@/Components/Common/Table.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head } from '@inertiajs/vue3'
import { usePermission } from '@/Composables/permissions'

defineOptions({
  layout: AuthenticatedLayout
})

const props = defineProps({
  users: {
    type: Object,
    required: true
  },
  filters: {
    type: Object,
    default: () => {
      return {}
    }
  },
  roles: {
    type: Object,
    default: () => {
      return {}
    }
  }
})

const { hasPermission } = usePermission()

const columns = [
  {
    name: 'Identificación',
    keyValue: 'identification_number',
    type: 'default',
    sort: true
  },
  {
    name: 'Nombre completo',
    keyValue: 'full_name',
    type: 'default',
    sort: true
  },
  {
    name: 'Correo electrónico',
    keyValue: 'email',
    type: 'default',
    sort: true
  },
  {
    name: 'Rol',
    keyValue: 'role_name',
    type: 'default',
    sort: true
  },
  {
    name: 'Estado',
    keyValue: 'status',
    type: 'status',
    sort: true
  },
  {
    name: 'Acciones',
    type: 'actions'
  }
]

const filtersParsed = {
  direction: props.filters.direction || '',
  sort: props.filters.sort || '',
  'filter[global]': props.filters.filter.global || '',
  page: props.filters.page || 1,
  perPage: props.filters.perPage || '15',
  'filter[status]': props.filters?.filter.status || '',
  'filter[start_date]': props.filters?.filter.start_date || '',
  'filter[end_date]': props.filters?.filter.end_date || '',
  'filter[role]': props.filters?.filter.role || ''
}

const filterOptions = [
  {
    label: 'Estado',
    keyValue: 'status',
    type: 'select',
    options: {
      0: 'Inactivo',
      1: 'Activo'
    }
  },
  {
    label: 'Rol',
    keyValue: 'role',
    type: 'select',
    options: props.roles
  },
  {
    label: 'Fecha de inicio',
    keyValue: 'start_date',
    type: 'date'
  },
  {
    label: 'Fecha de fin',
    keyValue: 'end_date',
    type: 'date'
  }
]

const currentRoute = route().current().split('.')[0]

const routeActions = {
  edit: 'users.edit',
  delete: 'users.destroy'
}
</script>

<template>
  <Head title="Usuarios" />
  <TitlePage title="Usuarios">
    <Button v-if="hasPermission('create users')" icon="plus" :href="route('users.create')">
      Crear
    </Button>
  </TitlePage>

  <Card>
    <Table
      :columns="columns"
      :current-route="currentRoute"
      :data="users"
      :filter-options="filterOptions"
      :filters="filtersParsed"
      :route-actions="routeActions"
      message="No se encontraron usuarios"
    />
  </Card>
</template>
