<script setup>
import Checkbox from '@/Components/Checkbox.vue'
import DarkModeSwitcher from '@/Components/Common/DarkModeSwitcher.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps({
  canResetPassword: {
    type: Boolean
  },
  status: {
    default: '',
    type: String
  }
})

const form = useForm({
  email: '',
  password: '',
  remember: false
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password')
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Log in" />

    <div v-if="status" class="text-green-600 mb-4 text-sm font-medium">
      {{ status }}
    </div>

    <DarkModeSwitcher class="absolute right-10 top-10 md:right-20" />

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          required
          autocomplete="current-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mb-5.5 mt-5 flex flex-col items-center justify-between gap-5 md:flex-row">
        <label for="formCheckbox" class="flex cursor-pointer">
          <div class="relative pt-0.5">
            <Checkbox
              id="formCheckbox"
              v-model:checked="form.remember"
              name="remember"
              class="taskCheckbox sr-only"
            />
            <div
              class="box mr-3 flex h-5 w-5 items-center justify-center rounded border border-stroke dark:border-strokedark"
            >
              <span class="text-white opacity-0">
                <svg
                  class="fill-current"
                  width="10"
                  height="7"
                  viewBox="0 0 10 7"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M9.70685 0.292804C9.89455 0.480344 10 0.734667 10 0.999847C10 1.26503 9.89455 1.51935 9.70685 1.70689L4.70059 6.7072C4.51283 6.89468 4.2582 7 3.9927 7C3.72721 7 3.47258 6.89468 3.28482 6.7072L0.281063 3.70701C0.0986771 3.5184 -0.00224342 3.26578 3.785e-05 3.00357C0.00231912 2.74136 0.10762 2.49053 0.29326 2.30511C0.4789 2.11969 0.730026 2.01451 0.992551 2.01224C1.25508 2.00996 1.50799 2.11076 1.69683 2.29293L3.9927 4.58607L8.29108 0.292804C8.47884 0.105322 8.73347 0 8.99896 0C9.26446 0 9.51908 0.105322 9.70685 0.292804Z"
                    fill=""
                  />
                </svg>
              </span>
            </div>
          </div>
          <p>Remember me</p>
        </label>
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="text-gray-600 hover:text-gray-900 focus:ring-indigo-500 rounded-md text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2"
        >
          Forgot your password?
        </Link>
      </div>

      <div class="mt-4 flex items-center justify-end">
        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Log in
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
