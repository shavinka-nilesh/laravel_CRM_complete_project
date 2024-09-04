<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

// Define props
const props = defineProps({
  customer: Object,
});

// Reactive form state
const form = ref({
  name: props.customer.name,
  email: props.customer.email,
  phone: props.customer.phone,
  address: props.customer.address,
});

// Update customer function
const updateCustomer = () => {
  Inertia.put(route('customer.update', props.customer.id), form.value);
};
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Customer
      </h2>
    </template>

    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <form @submit.prevent="updateCustomer">
        <!-- <h1>Edit Customer</h1> -->

        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input v-model="form.name" id="name" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input v-model="form.email" id="email" type="email" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone:</label>
          <input v-model="form.phone" id="phone" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address:</label>
          <input v-model="form.address" id="address" type="text" class="form-control" />
        </div>

        <button type="submit" class="btn btn-outline-primary">Update Customer</button>
      </form>
    </div>
  </AppLayout>
</template>
