<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from '@inertiajs/vue3';

defineProps({
    companies: Object
})
</script>

<template>

    <div class="min-h-screen min-w-fit flex flex-col justify-start items-center bg-gray-100 dark:bg-gray-900">
        <!-- Logo div -->
        <div class="m-4">
            <ApplicationLogo/>
        </div>

        <!-- Content div -->
        <div class=" bg-white p-4 md:w-2/5 rounded-lg m-6 p-6 ">
            <!-- Text content goes here -->

            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 21H2v-2h1V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v5h2v10h1v2Zm-5-2h2v-8h-6v8h2v-6h2v6Zm0-10V5H5v14h6V9h6ZM7 11h2v2H7v-2Zm0 4h2v2H7v-2Zm0-8h2v2H7V7Z"/>
                </svg>
                <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Select your workspace</div>
            </div>
            <div class="mx-12">

                <div v-if="!companies" class="mt-1 ">


                    <p class="px-4 py-2 flex text-red-500 focus:text-cyan-500">No workspace available</p>


                </div>


                <div v-else v-for="company in companies" :key="company.id" class="mt-1 bg-white rounded-md shadow hover:bg-gray-100 focus-within:bg-gray-100">


                    <Link :href="route('workspace.dashboard', { company: company.id })" class="text-sm px-4 py-2 flex text-gray-600 ">{{ company.name }}</Link>


                </div>


            </div>

        </div>
    </div>



</template>

