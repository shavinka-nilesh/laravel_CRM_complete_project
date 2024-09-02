<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
const props = defineProps({//This props section defines the data properties that are passed from the backend (controller) to this component.
    totalCustomers: Number,//totalCustomers and totalInvoices are numbers.
    totalInvoices: Number,
    latestInvoices: Array,//latestInvoices, recentTransactions, and recentCustomers are arrays.
    recentTransactions: Array,
    recentCustomers: Array,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
