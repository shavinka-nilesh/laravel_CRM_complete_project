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
        View Invoice
      </h2>
    </template>

    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <div class="container mt-2">
        <div class="card">
          <div class="card-header">
            <h1 class="card-title">Invoice Details</h1>
          </div>
          <div class="card-body">
            <p><strong>Invoice Number:</strong> {{ customer.invoice_number }}</p>
            <p><strong>Date:</strong> {{ customer.invoice_date }}</p>
            <p><strong>Customer Name:</strong> {{ customer.customer_name }}</p>
            <p><strong>Description:</strong> {{ customer.item_description }}</p>
            <p><strong>Amount:</strong> {{ customer.amount }}</p>
            <a :href="route('invoice.edit', customer.id)" class="btn btn-warning mt-3">Edit Invoice</a>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
