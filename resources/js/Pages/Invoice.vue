<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { defineProps } from 'vue';

const props = defineProps({
    invoices: Array // prop name: prop type
});
//Delete button confirmation message
const confirmDelete = (id) => {
  if (confirm('Are you sure you want to delete this invoice?')) {
    Inertia.delete(route('invoice.destroy', id));
  }
};
//Activate button confirmation message
const changeStatus = (id) => {
  if (confirm('Are you sure you want to change the status of this invoice?')) {
    Inertia.post(route('invoice.changeStatus', id));
  }
};
//Change the colors of the badge accoording to the status
const statusClass = (status) => {
  switch (status) {
    case 'approved':
      return 'badge bg-success';
    case 'rejected':
      return 'badge bg-warning';
    case 'pending':
      return 'badge bg-secondary';
    default:
      return 'badge bg-secondary';
  }
};
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoice
            </h2>
        </template>
    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200 shadow-xl sm:rounded-lg">
        <div class="mb-3">
            <!-- <a :href="route('create_invoice')" :active="route().current('create_invoice')" class="btn btn-secondary btn-sm me-2">Create Invoice</a> -->
        </div>
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice Number</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <!-- v-for="(object name, position in the current array) in invoices" :key="invoice.id"-this will provide a unique key for each raw -for rendering pourpose  -->
                    <tr v-for="(invoice, index) in invoices" :key="invoice.id">
                        <!-- this will display the raw number in the table -->
                        <td>{{ invoice.id }}</td>
                        <!-- {{ object name.column name }} -->
                        <td>{{ invoice.invoice_number }}</td>
                        <td>{{ invoice.customer_name }}</td>
                        <td>{{ invoice.invoice_date }}</td>
                        <td>{{ invoice.amount }}</td>
                        <td><span :class="statusClass(invoice.status)">{{ invoice.status }}</span></td>
                        <td>
                            <a :href="route('invoice.show', invoice.id)" class="btn btn-outline-info btn-sm me-2">View</a>
                            <!-- <a href="#" class="btn btn-warning btn-sm  me-2">Edit</a> -->
                            <button  @click="confirmDelete(invoice.id)" class="btn btn-outline-danger btn-sm me-2">Delete</button>
                            <button
                            @click="changeStatus(invoice.id)"
                            :class="invoice.status === 'approved' ? 'btn btn-warning btn-sm me-2' : 'btn btn-success btn-sm me-2'"
          >
                             {{ invoice.status === 'approved' ? 'reject' : 'approve' }}
                        </button>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</AppLayout>
</template>
