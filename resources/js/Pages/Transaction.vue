<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
    proposals: Array // prop name: prop type
});

const search = ref('');//this will store the value of search input
const selectedStatus = ref('all');//this will store tha value of selected inpuit, by dafault it is set to no specefic filter add(all)

const filteredProposals = computed(() => { //this will dynamically calculates the filtered list of proposals based on the current values of search and selectedStatus
    return props.proposals.filter(proposal => {//this will return the prop values in array including only filetred proposals.
        const matchesSearch = proposal.customer_name.toLowerCase().includes(search.value.toLowerCase());//this will chcek the customer name is included in the search input field and transform it into lowercase to avoid errors
        const matchesStatus = selectedStatus.value === 'all' || proposal.status === selectedStatus.value;//this willcheck if the status matches to the selected status.If its true the proposals is included in the filetred results.
        return matchesSearch && matchesStatus;//this will return the matchesSearch and matchesStatus
    });
});
//This will display the different color status fields according to the customer fields.
const statusClass = (status) => {
    switch (status) {
        case 'paid':
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
                Transactions
            </h2>
        </template>

        <div class="container mt-5 p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="mb-3">
                <!-- Search bar -->
                <input
                    v-model="search"
                    type="text"
                    class="form-control mb-2"
                    placeholder="Search by customer name"
                />

                <!-- Status filter -->
                <div class="mb-3">
                    <select
                        v-model="selectedStatus"
                        class="form-select"
                    >
                        <option value="all">All</option>
                        <option value="paid">Paid</option>
                        <option value="rejected">Rejected</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
                <!-- table field -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Number</th>
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(proposal, index) in filteredProposals" :key="proposal.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ proposal.invoice_number }}</td>
                        <td>{{ proposal.customer_name }}</td>
                        <td>{{ proposal.amount }}</td>
                        <td>{{ proposal.updated_at }}</td>
                        <td><span :class="statusClass(proposal.status)">{{ proposal.status }}</span></td>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
