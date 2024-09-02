<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

// Define props
const props = defineProps({
  customer: Object,
});
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View Customer
      </h2>
    </template>

    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <div class="container mt-2">
        <div class="card">
          <div class="card-header">
            <h1 class="card-title">Customer Details</h1>
          </div>
          <div class="card-body">
            <p><strong>Name:</strong> {{ customer.name }}</p>
            <p><strong>Email:</strong> {{ customer.email }}</p>
            <p><strong>Phone:</strong> {{ customer.phone }}</p>
            <p><strong>Address:</strong> {{ customer.address }}</p>
            <a :href="route('customer.edit', customer.id)" class="btn btn-warning mt-3">Edit Customer</a>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
