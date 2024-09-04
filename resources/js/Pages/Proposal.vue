<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const props = defineProps({
    proposals: Array // prop name: prop type
});
//Delete button confirmation message
const confirmDelete = (id) => {
  if (confirm('Are you sure you want to delete this proposal?')) {
    Inertia.delete(route('proposal.destroy', id));
  }
};
//Activate button confirmation message
const changeStatus = (id) => {
  if (confirm('Are you sure you want to change the status of this proposal?')) {
    Inertia.post(route('proposal.changeStatus', id));
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
                Proposal
            </h2>
        </template>
    <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200  shadow-xl sm:rounded-lg">
        <div class="mb-3">
            <!-- <a :href="route('create_proposal')" :active="route().current('create_proposal')" class="btn btn-primary btn-sm me-2">Create Proposal</a> -->
        </div>
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Client Name</th>
                    <!-- <th>Detials</th> -->
                    <th>Estimated Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- this key is used in passing the data through the buttons -->
                    <tr v-for="(proposals, index) in proposals" :key="proposals.id">
                        <!-- this will display the raw number in the table -->
                        <td>{{ index + 1 }}</td>
                        <!-- {{ object name.column name }} -->
                        <td>{{ proposals.title }}</td>
                        <td>{{ proposals.name }}</td>
                        <!-- <td>{{ proposals.details }}</td> -->
                        <td>{{ proposals.cost }}</td>
                        <td><span :class="statusClass(proposals.status)">{{ proposals.status }}</span></td>
                    <td>
                        <!-- this proposals in comes from the key field above code -->
                        <a :href="route('proposal.show', proposals.id)" class="btn btn-outline-info btn-sm me-2">View</a>
                        <!-- <a href="#" class="btn btn-warning btn-sm me-2">Edit</a> -->
                        <button  @click="confirmDelete(proposals.id)" class="btn btn-outline-danger btn-sm me-2">Delete</button>
                        <!-- <a :href="route('create_invoice', { customer_id: proposals.id })" class="btn btn-dark btn-sm me-2">Create Invoice</a> -->
                        <button
                            @click="changeStatus(proposals.id)"
                            :class="proposals.status === 'approved' ? 'btn btn-warning btn-sm me-2' : 'btn btn-success btn-sm me-2'"
          >
                             {{ proposals.status === 'approved' ? 'reject' : 'approve' }}
                        </button>
                        <!-- <a :href="route('create_invoice')" :active="route().current('create_invoice')" class="btn btn-secondary btn-sm me-2">Create Invoice</a> -->
                    </td>
                </tr>
                <!-- Repeat <tr> block for each invoice -->
            </tbody>
        </table>
    </div>
</AppLayout>
</template>

