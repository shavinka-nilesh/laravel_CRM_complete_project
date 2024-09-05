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
    title: props.customer.title,
    date: props.customer.date,
    name: props.customer.name,
    details: props.customer.details,
    cost: props.customer.cost,
});

// Update customer function
const updateCustomer = () => {
  Inertia.put(route('proposal.update', props.customer.id), form.value);
};
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Proposal
      </h2>
    </template>

    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <form @submit.prevent="updateCustomer">
        <!-- <h1>Edit Customer</h1> -->

        <div class="mb-3">
          <label for="name" class="form-label">Title:</label>
          <input v-model="form.title" id="title" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Date:</label>
          <input v-model="form.date" id="date" type="date" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Client Name:</label>
          <input v-model="form.name" id="name" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Description:</label>
          <input v-model="form.details" id="details" type="text" class="form-control" />
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Estimated Cost:</label>
          <input v-model="form.cost" id="cost" type="number" class="form-control" />
        </div>


        <button type="submit" class="btn btn-outline-info">Update Proposal</button>
      </form>
    </div>
  </AppLayout>
</template>
