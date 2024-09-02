<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, watch, onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
//defining propos
const props = defineProps({
  customer: Object,
});

const invoiceNumber = ref('');
const invoiceDate = ref('');
const customerName = ref('');
const email = ref('');
const itemDescription = ref('');
const amount = ref('');

// Autofill fields based on customer prop
onMounted(() => {
  if (props.customer) {
    customerName.value = props.customer.name;
    email.value = props.customer.email;
  }
});
//form sumission
const createInvoice = () => {
  const data = {
    invoice_number: invoiceNumber.value,
    invoice_date: invoiceDate.value,
    customer_name: customerName.value,
    email: email.value,
    item_description: itemDescription.value,
    amount: amount.value,
  };
  Inertia.post('/invoices', data);
};
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Invoice
      </h2>
    </template>
    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <form @submit.prevent="createInvoice">
        <div class="mb-3">
          <label for="invoiceNumber" class="form-label">Invoice Number</label>
          <input type="text" class="form-control" v-model="invoiceNumber" placeholder="Enter Invoice Number" required>
        </div>
        <div class="mb-3">
          <label for="invoiceDate" class="form-label">Invoice Date</label>
          <input type="date" class="form-control" v-model="invoiceDate">
        </div>
        <div class="mb-3">
          <label for="customerName" class="form-label">Customer Name</label>
          <input type="text" class="form-control" v-model="customerName" placeholder="Enter Customer Name" readonly>
        </div>
        <div class="mb-3">
          <label for="customerName" class="form-label">Customer Email</label>
          <input type="text" class="form-control" v-model="email" placeholder="Enter Customer Name" readonly>
        </div>
        <div class="mb-3">
          <label for="itemDescription" class="form-label">Item Description</label>
          <textarea class="form-control" v-model="itemDescription" rows="3" placeholder="Enter Item Description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="amount" class="form-label">Amount</label>
          <input type="number" class="form-control" v-model="amount" placeholder="Enter Amount" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </AppLayout>
</template>
