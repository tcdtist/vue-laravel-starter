<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Button from '@/Components/Buttons/Button.vue'
import Card from '@/Components/Common/Card.vue'
import Table from '@/Components/Common/Table.vue'
import TitlePage from '@/Components/UI/TitlePage.vue'
import { Head } from '@inertiajs/vue3'
import { usePermission } from '@/Composables/permissions'

const props = defineProps({
  roles: {
    type: Object,
    required: true
  },
  filters: {
    type: Object,
    default: () => {}
  }
})

defineOptions({
  layout: AuthenticatedLayout
})

const { hasPermission } = usePermission()

const columns = [
  {
    name: 'Nombre',
    keyValue: 'name',
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
  'filter[status]': props.filters?.filter.module || ''
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
  }
]

const currentRoute = route().current().split('.')[0]

const routeActions = {
  edit: 'roles.edit',
  delete: 'roles.destroy'
}
</script>

<template>
  <Head title="Roles" />
  <TitlePage title="Roles">
    <Button v-if="hasPermission('create roles')" icon="plus" :href="route('roles.create')">
      Crear
    </Button>
  </TitlePage>

  <Card>
    <Table
      :columns="columns"
      :current-route="currentRoute"
      :data="roles"
      :filter-options="filterOptions"
      :filters="filtersParsed"
      :route-actions="routeActions"
      message="No se encontraron roles"
      placeholder-search="Nombre"
    />
  </Card>
</template>
