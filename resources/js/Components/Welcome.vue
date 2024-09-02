<script setup>
import { defineProps } from 'vue';

const props = defineProps({ //This props section defines the data properties that are passed from the backend (controller) to this component.
    totalCustomers: Number,
    totalInvoices: Number,
    latestInvoices: Array,
    recentTransactions: Array,
    recentCustomers: Array,
});
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                <!-- This will display the user name  -->
                Welcome {{ $page.props.auth.user.name }}
            </h1>
        </div>
        <!-- this will display the total numbers of customers and Invoices -->
         <!-- The grid adjusts its columns depending on screen size (grid-cols-1 for small screens, sm:grid-cols-2 for medium, and lg:grid-cols-4 for large screens).-->
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                <!-- Total Customers -->
                <div class="bg-white p-6 rounded-lg shadow flex items-center">
                    <h2 class="text-lg font-medium text-gray-600">Total Customers</h2>
                    <p class="text-3xl font-bold text-gray-500">{{ totalCustomers }}</p>
                </div>
                <!-- Total Invoices -->
                <div class="bg-white p-6 rounded-lg shadow flex items-center">
                    <h2 class="text-lg font-medium text-gray-600">Total Invoices</h2>
                    <p class="text-3xl font-bold text-gray-900">{{ totalInvoices }}</p>
                </div>
            </div>

            <div>
                <!-- This section will show the latest invoices list  -->
                <div class="bg-white p-6 rounded-lg shadow mt-6">
                    <h2 class="text-lg font-medium text-gray-600">Latest Invoices</h2>
                    <ul><!-- v-for is used to loop through the latestInvoices array prop, displaying each invoice's ID and status.:key="invoice.id" is a unique key for each list item to help Vue keep track of each element efficiently. -->
                        <li v-for="invoice in latestInvoices" :key="invoice.id" class="py-2 border-b">
                            <span class="font-bold">{{ invoice.id }}</span> - {{ invoice.status }}
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="bg-white p-6 rounded-lg shadow mt-6">
                    <h2 class="text-lg font-medium text-gray-600">Recent Transactions</h2>
                    <ul>
                        <li v-for="transaction in recentTransactions" :key="transaction.id" class="py-2 border-b">
                            <span class="font-bold">{{ transaction.id }}</span> - {{ transaction.payment_status }}
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="bg-white p-6 rounded-lg shadow mt-6">
                    <h2 class="text-lg font-medium text-gray-600">Recent Customers</h2>
                    <ul>
                        <li v-for="customer in recentCustomers" :key="customer.id" class="py-2 border-b">
                            {{ customer.name }} - {{ customer.created_at }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
