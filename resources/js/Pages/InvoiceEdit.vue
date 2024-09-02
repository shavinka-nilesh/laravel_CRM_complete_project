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
    invoice_number: props.customer.invoice_number,
    invoice_date: props.customer.invoice_date,
    customer_name: props.customer.customer_name,
    item_description: props.customer.item_description,
    amount: props.customer.amount,
});

// Update customer function
const updateCustomer = () => {
  Inertia.put(route('invoice.update', props.customer.id), form.value);
};
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Invoice
      </h2>
    </template>

    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <form @submit.prevent="updateCustomer">
        <!-- <h1>Edit Customer</h1> -->

        <div class="mb-3">
          <label for="name" class="form-label">Invoice Number:</label>
          <input v-model="form.invoice_number" id="invoice_number" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Date:</label>
          <input v-model="form.invoice_date" id="invoice_date" type="date" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Customer Name:</label>
          <input v-model="form.customer_name" id="customer_name" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Description:</label>
          <input v-model="form.item_description" id="item_description" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Amount:</label>
          <input v-model="form.amount" id="amount" type="number" class="form-control" />
        </div>


        <button type="submit" class="btn btn-success">Update Invoice</button>
      </form>
    </div>
  </AppLayout>
</template>
