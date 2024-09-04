<!-- resources/js/Pages/CreateInvoice.vue -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
//import { ref } from 'vue'; //reactive reference to create reactive state variable
import { Inertia } from '@inertiajs/inertia'; //importi inertia js to handle form subbmissions and page navigation
import { ref, watch, onMounted } from 'vue';

//defining propos
const props = defineProps({
  customer: Object,
});

const clientName = ref(''); //reactive variables that used to store values of the form fields.
const estimatedCost = ref('');
const proposalTitle = ref('');
const proposalDate = ref('');
const proposalDetails = ref('');

// Autofill fields based on customer prop
onMounted(() => {
  if (props.customer) {
    clientName.value = props.customer.name;
  }
});

//form subbmission
const createProposal = () => {//this method should be called in the @submit
    // Prepare the form data
    const data = { //this will create a constant called data
        title: proposalTitle.value, //column Name: v-model name.value,
        date: proposalDate.value,
        name: clientName.value,
        details: proposalDetails.value,
        cost: estimatedCost.value,
    };

    // Submit the form using Inertia
    Inertia.post('/proposals', data); //Inertia.post('/url name of the rout', data);
};

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Proposal
            </h2>
        </template>
    <div class="container mt-5  mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <form @submit.prevent="createProposal">
        <div class="mb-3">
            <label for="proposalTitle" class="form-label">Proposal Title</label>
            <input type="text" class="form-control" v-model="proposalTitle" placeholder="Enter Proposal Title" required>
        </div>
        <div class="mb-3">
            <label for="proposalDate" class="form-label">Proposal Date</label>
            <input type="date" class="form-control" v-model="proposalDate" required>
        </div>
        <div class="mb-3">
            <label for="clientName" class="form-label">Client Name</label>
            <input type="text" class="form-control" v-model="clientName" placeholder="Enter Client Name" readonly>
        </div>
        <div class="mb-3">
            <label for="proposalDetails" class="form-label">Proposal Details</label>
            <textarea class="form-control" v-model="proposalDetails" rows="4" placeholder="Enter Proposal Details" required></textarea>
        </div>
        <div class="mb-3">
            <label for="estimatedCost" class="form-label">Estimated Cost</label>
            <input type="number" class="form-control" v-model="estimatedCost" placeholder="Enter Estimated Cost" required>
        </div>
        <button type="submit" class="btn btn-outline-info">Create Proposal</button>
      </form>
    </div>
</AppLayout>
  </template>


