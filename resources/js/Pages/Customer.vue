<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { defineProps } from 'vue';
import { Inertia } from '@inertiajs/inertia';
//import { usePage } from '@inertiajs/inertia-vue3';

// const { props } = usePage();
// const customers = ref(props.customers);
const props = defineProps({
    customers: Array // prop name: prop type
});

//Delete button confirmation message
const confirmDelete = (id) => {
  if (confirm('Are you sure you want to delete this customer?')) {
    Inertia.delete(route('customer.destroy', id));
  }};
//Activate button confirmation message
const changeStatus = (id) => {
  if (confirm('Are you sure you want to change the status of this customer?')) {
    Inertia.post(route('customer.changeStatus', id));
  }
};
//Change the colors of the badge accoording to the status
const statusClass = (status) => {
  switch (status) {
    case 'active':
      return 'badge bg-success';
    case 'inactive':
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
                Customer
            </h2>
        </template>
    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="mb-3">
            <a :href="route('create_customer')" :active="route().current('create_customer')" class="btn btn-primary btn-sm me-2">Add Customer</a>
        </div>
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <!-- <th>Address</th> -->
                    <th>Telephone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(customers, index) in customers" :key="customers.id">
                        <!-- this will display the raw number in the table -->
                        <td>{{ index + 1 }}</td>
                        <!-- {{ object name.column name }} -->
                        <td>{{ customers.name }}</td>
                        <td>{{ customers.email }}</td>
                        <!-- <td>{{ customers.address }}</td> -->
                        <td>{{ customers.phone }}</td>
                        <td><span :class="statusClass(customers.status)">{{ customers.status }}</span></td>
                    <td>
                        <a :href="route('customer.show', customers.id)" class="btn btn-info btn-sm me-2">View</a>
                        <!-- <a :href="route('customer.edit', customers.id)" class="btn btn-warning btn-sm me-2">Edit</a> -->
                        <button  @click="confirmDelete(customers.id)" class="btn btn-danger btn-sm me-2">Delete</button>
                        <a :href="route('create_invoice', { customer_id: customers.id })" class="btn btn-dark btn-sm me-2">Create Invoice</a>
                        <a :href="route('create_proposal', { customer_id: customers.id })" class="btn btn-dark btn-sm me-2">Create Proposal</a>
                        <button
                            @click="changeStatus(customers.id)"
                            :class="customers.status === 'active' ? 'btn btn-warning btn-sm me-2' : 'btn btn-success btn-sm me-2'"
          >
                             {{ customers.status === 'active' ? 'Deactivate' : 'Activate' }}
                        </button>
                    </td>
                </tr>
                <!-- Repeat <tr> block for each invoice -->
            </tbody>
        </table>
    </div>
</AppLayout>
</template>

