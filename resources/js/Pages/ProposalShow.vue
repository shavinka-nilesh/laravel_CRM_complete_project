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
        View Proposal
      </h2>
    </template>

    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
      <div class="container mt-2">
        <div class="card">
          <div class="card-header">
            <h1 class="card-title">Proposal Details</h1>
          </div>
          <div class="card-body">
            <p><strong>Title:</strong> {{ customer.title }}</p>
            <p><strong>Date:</strong> {{ customer.date }}</p>
            <p><strong>Customer Name:</strong> {{ customer.name }}</p>
            <p><strong>Description:</strong> {{ customer.details }}</p>
            <p><strong>Estimated Cost:</strong> {{ customer.cost }}</p>
            <a :href="route('proposal.edit', customer.id)" class="btn btn-warning mt-3">Edit Proposal</a>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
