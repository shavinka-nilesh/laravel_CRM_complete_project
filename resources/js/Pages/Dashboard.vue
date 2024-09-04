<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
const props = defineProps({//This props section defines the data properties that are passed from the backend (controller) to this component.
    totalCustomers: Number,//totalCustomers and totalInvoices are numbers.
    totalInvoices: Number,
    totalProposals: Number,
    totalTransactions: Number,
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
                                <div>
                    <div class="p-6 lg:p-8 bg-emerald-100 border-b border-gray-200">
                        <h1 class="mt-8 text-2xl font-medium text-gray-900">
                            <!-- This will display the user name  -->
                            Welcome {{ $page.props.auth.user.name }}
                        </h1>
                    </div>
                    <!-- this will display the total numbers of customers and Invoices -->
                    <!-- The grid adjusts its columns depending on screen size (grid-cols-1 for small screens, sm:grid-cols-2 for medium, and lg:grid-cols-4 for large screens).-->
                    <div class="bg-emerald-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                            <!-- Total Customers -->
                            <div class="bg-white p-3 rounded-lg shadow  ">
                                <h2 class="text-lg font-medium text-gray-900">Total Customers</h2>
                                <br/>
                                <!-- {{Just put the prop name}} -->
                                <p class="text-3xl font-bold text-gray-500">{{ totalCustomers }}</p>
                            </div>
                            <!-- Total Invoices -->
                            <div class="bg-white p-6 rounded-lg shadow ">
                                <h2 class="text-lg font-medium text-gray-600">Total Invoices</h2>
                                <br/>
                                <p class="text-3xl font-bold text-gray-900">{{ totalInvoices }}</p>
                            </div>
                            <!-- Total Proposals -->
                            <div class="bg-white p-6 rounded-lg shadow ">
                                <h2 class="text-lg font-medium text-gray-600">Total Proposals</h2>
                                <br/>
                                <p class="text-3xl font-bold text-gray-900">{{ totalProposals }}</p>
                            </div>
                            <!-- Total Invoices -->
                            <div class="bg-white p-3 rounded-lg shadow items-center">
                                <h2 class="text-lg font-medium text-gray-900 ">Total Transactions</h2>
                                <br/>
                                <p class="text-3xl font-bold text-gray-500">{{ totalTransactions }}</p>
                            </div>
                        </div>

                        <div>
                            <!-- This section will show the latest invoices list  -->
                            <div class="bg-white p-6 rounded-lg shadow mt-6">
                                <h2 class="text-lg font-medium text-gray-900">Latest Invoices</h2>
                                <ul><!-- v-for is used to loop through the latestInvoices array prop, displaying each invoice's ID and status.:key="invoice.id" is a unique key for each list item to help Vue keep track of each element efficiently. -->
                                    <li v-for="invoice in latestInvoices" :key="invoice.id" class="py-2 border-b">
                                        <!-- The span tag will bold the content inside the span tag. {{ key name.database table field name }}-->
                                        <span class="font-bold">{{ invoice.id }}</span> - {{ invoice.customer_name }} - {{ invoice.status }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <div class="bg-white p-6 rounded-lg shadow mt-6">
                                <h2 class="text-lg font-medium text-gray-900">Recent Transactions</h2>
                                <ul>
                                    <li v-for="transaction in recentTransactions" :key="transaction.id" class="py-2 border-b">
                                        <span class="font-bold">{{ transaction.id }}</span> - {{ transaction.customer_name }} - {{ transaction.status }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <div class="bg-white p-6 rounded-lg shadow mt-6">
                                <h2 class="text-lg font-medium text-gray-900">Recent Customers</h2>
                                <ul>
                                    <li v-for="customer in recentCustomers" :key="customer.id" class="py-2 border-b">
                                        {{ customer.name }} - {{ customer.created_at }}- {{ customer.status }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </AppLayout>
</template>
