<!-- resources/js/Pages/CreateInvoice.vue -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue'; //reactive reference to create reactive state variable
import { Inertia } from '@inertiajs/inertia'; //importi inertia js to handle form subbmissions and page navigation

const customerPhone = ref(''); //reactive variables that used to store values of the form fields.
const customerEmail = ref('');
const customerName = ref('');
const customerAddress = ref('');

//form subbmission
const createCustomer = () => {//this method should be called in the @submit
    // Prepare the form data
    const data = { //this will create a constant called data
        name: customerName.value, //column Name: v-model name.value,
        email: customerEmail.value,
        phone: customerPhone.value,
        address: customerAddress.value,
    };

    // Submit the form using Inertia
    Inertia.post('/customers', data); //Inertia.post('/url name of the rout', data);
};
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customer
            </h2>
        </template>
    <div class="container mt-5  mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <form @submit.prevent="createCustomer">
        <div class="mb-3">
            <label for="customerName" class="form-label">Customer Name</label>
            <input type="text" class="form-control" v-model="customerName"  placeholder="Enter Customer Name">
        </div>
        <div class="mb-3">
            <label for="customerEmail" class="form-label">Customer Email</label>
            <input type="email" class="form-control" v-model="customerEmail" placeholder="Enter Customer Email">
        </div>
        <div class="mb-3">
            <label for="customerPhone" class="form-label">Customer Phone</label>
            <input type="tel" class="form-control" v-model="customerPhone" placeholder="Enter Customer Phone">
        </div>
        <div class="mb-3">
            <label for="customerAddress" class="form-label">Customer Address</label>
            <textarea class="form-control" v-model="customerAddress" rows="3" placeholder="Enter Customer Address"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
</AppLayout>
  </template>


