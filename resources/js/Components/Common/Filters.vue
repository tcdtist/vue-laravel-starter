<script setup>
import { ref } from 'vue'
import Button from '../Buttons/Button.vue'
import Input from '../Forms/Input.vue'
import Select from '../Forms/Select.vue'

defineProps({
  isSearch: {
    type: Boolean,
    required: true
  },
  placeholderSearch: {
    type: String,
    required: true
  },
  filters: {
    type: Object,
    required: true
  },
  filterOptions: {
    type: Array,
    required: true
  },
  currentRoute: {
    type: String,
    required: true
  }
})

const isOpenFilters = ref(false)

const emit = defineEmits(['updateQueriesParams', 'clearFilters'])

const handleClearFilters = () => {
  isOpenFilters.value = false
  emit('clearFilters')
}
</script>

<template>
  <div
    v-show="isOpenFilters === true"
    class="absolute left-0 top-0 z-9 h-screen w-full bg-transparent"
    @click="isOpenFilters = false"
  ></div>
  <div class="relative flex items-end justify-between gap-4 lg:flex-wrap">
    <div v-if="isSearch">
      <Input
        id="search"
        :placeholder="placeholderSearch"
        :is-search="true"
        :value="filters['filter[global]']"
        class="md:min-w-[200px]"
        @input="emit('updateQueriesParams', 'filter[global]', $event.target.value)"
      />
    </div>
    <template v-if="filterOptions.length > 0">
      <div class="flex-grow">
        <Button
          :icon="isOpenFilters ? 'x' : 'filter'"
          :is-only-icon="true"
          class="lg:hidden"
          @click="isOpenFilters = !isOpenFilters"
        />
        <div
          class="absolute right-0 top-14 z-10 w-full rounded-lg border-[1.5px] border-stroke bg-white p-4 duration-500 dark:border-strokedark dark:bg-black sm:w-auto lg:relative lg:top-0 lg:flex lg:translate-x-0 lg:items-end lg:justify-between lg:gap-4 lg:border-none lg:p-0 lg:dark:bg-boxdark 2xl:flex-row 2xl:justify-end"
          :class="isOpenFilters ? 'translate-x-0' : 'translate-x-[200%]'"
        >
          <div class="flex flex-col flex-wrap gap-4 sm:flex-row">
            <template v-for="filter in filterOptions" :key="filter">
              <Select
                v-if="filter.type === 'select'"
                :id="filter.keyValue"
                :label="filter.label"
                :options="filter.options"
                class="min-w-[180px] flex-1"
                placeholder="Todo"
                :value="filters[`filter[${filter.keyValue}]`]"
                @change="
                  emit('updateQueriesParams', `filter[${filter.keyValue}]`, $event.target.value)
                "
              />

              <Input
                v-else
                :id="filter.keyValue"
                :label="filter.label"
                :type="filter.type"
                :value="filter[`filter[${filter.keyValue}]`]"
                class="min-w-[180px] flex-1"
                @input="
                  emit('updateQueriesParams', `filter[${filter.keyValue}]`, $event.target.value)
                "
              />
            </template>
          </div>
          <div class="mt-4 flex justify-end">
            <Button
              type="danger"
              icon="filter-x"
              class="lg:hidden"
              title="Limpiar filtros"
              @click="handleClearFilters"
              >Limpiar filtros</Button
            >
            <Button
              type="danger"
              icon="filter-x"
              class="hidden max-h-[50px] lg:block"
              :is-only-icon="true"
              title="Limpiar filtros"
              @click="handleClearFilters"
            />
          </div>
        </div>
      </div>
    </template>
  </div>
</template>
