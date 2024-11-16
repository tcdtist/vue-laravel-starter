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
  paymentMethods: {
    type: Object,
    required: true
  },
  filters: {
    type: Object,
    default: () => {}
  }
})

const { hasPermission } = usePermission()

const columns = [
  {
    name: 'Nombre',
    keyValue: 'title',
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
  'filter[status]': props.filters?.filter.status || ''
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
  edit: 'payment_methods.edit',
  delete: 'payment_methods.destroy'
}
</script>

<template>
  <Head title="Medios de Pago" />
  <TitlePage title="Medios de Pago">
    <Button
      v-if="hasPermission('create payment_methods')"
      icon="plus"
      :href="route('payment_methods.create')"
    >
      Crear
    </Button>
  </TitlePage>

  <Card>
    <Table
      :columns="columns"
      :current-route="currentRoute"
      :data="paymentMethods"
      :filter-options="filterOptions"
      :filters="filtersParsed"
      :route-actions="routeActions"
      message="No se encontraron medios de pago"
      placeholder-search="Nombre"
    />
  </Card>
</template>
