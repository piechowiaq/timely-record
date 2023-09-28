<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from '@inertiajs/vue3';

defineProps({
    companies: Object
})
</script>

<template>
    <div class="relative flex items-top justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900 p-6">
        <div class="w-full max-w-md">
            <ApplicationLogo />
            <div class="px-8 py-6 mt-8 bg-white rounded-lg shadow-xl overflow-hidden">

                <h1 class="text-center dark:text-white p-2 mb-2 bg-gray-100">Select your workpace</h1>

                <div v-for="company in companies" :key="company.id" class="text-sm hover:bg-gray-100 focus-within:bg-gray-100 ">

                    <Link :href="route('workspace.dashboard', { company: company.id })" class="px-4 py-2 flex focus:text-indigo-500">{{ company.name }}</Link>
                </div>
            </div>
        </div>
    </div>
</template>

