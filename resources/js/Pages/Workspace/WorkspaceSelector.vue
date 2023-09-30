<script setup>

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from '@inertiajs/vue3';

defineProps({
    companies: Object
})
</script>

<template>
    <div class="relative flex items-top justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="px-20 pt-8 flex items-center justify-center">

                <ApplicationLogo/>
            </div>


            <div
                class="p-6 bg-white dark:bg-gray-800 shadow rounded-lg flex justify-center grid grid-cols-1 mt-8 overflow-hidden ">
                <div class="justify-between">
                    <div class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500"
                             viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M22 21H2v-2h1V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v5h2v10h1v2Zm-5-2h2v-8h-6v8h2v-6h2v6Zm0-10V5H5v14h6V9h6ZM7 11h2v2H7v-2Zm0 4h2v2H7v-2Zm0-8h2v2H7V7Z"/>
                        </svg>
                        <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Select your workspace
                        </div>
                    </div>

                    <div v-for="company in companies" :key="company.id" class="text-sm hover:bg-cyan-600 hover:text-gray-100 focus-within:bg-gray-100">
                        <Link :href="route('workspace.dashboard', { company: company.id })" class="px-4 py-2 flex focus:text-cyan-500">{{ company.name }}
                        </Link>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--    <div class="relative items-top items-center justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900">-->
    <!--        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 ">-->
    <!--            <div class="flex justify-center grid grid-cols-1">-->
    <!--                <ApplicationLogo class="pt-6 px-20 "/>-->
    <!--            </div>-->

    <!--            <div class="mt-8 overflow-hidden ">-->


    <!--                <div class=" flex justify-center grid grid-cols-1">-->
    <!--                    <div class="p-6 lg:w-1/2 bg-white dark:bg-gray-800 shadow rounded-lg">-->

    <!--                        <div class="flex items-center">-->
    <!--                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" width="24" height="24"-->
    <!--                                 viewBox="0 0 24 24">-->
    <!--                                <path fill="currentColor"-->
    <!--                                      d="M22 21H2v-2h1V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v5h2v10h1v2Zm-5-2h2v-8h-6v8h2v-6h2v6Zm0-10V5H5v14h6V9h6ZM7 11h2v2H7v-2Zm0 4h2v2H7v-2Zm0-8h2v2H7V7Z"/>-->
    <!--                            </svg>-->
    <!--                            <div class="ml-4 text-lg leading-7 font-semibold dark:text-white">Select your workspace-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div v-for="company in companies" :key="company.id"-->
    <!--                             class="text-sm hover:bg-gray-100 focus-within:bg-gray-100 ">-->

    <!--                            <Link :href="route('workspace.dashboard', { company: company.id })"-->
    <!--                                  class="px-4 py-2 flex focus:text-indigo-500">{{ company.name }}-->
    <!--                            </Link>-->
    <!--                        </div>-->


    <!--                        <div class="mx-12">-->


    <!--                            <label class="block font-medium text-sm text-gray-700">-->
    <!--                                <span v-if="value">{{ value }}</span>-->
    <!--                                <span v-else><slot/></span>-->
    <!--                            </label>-->


    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    &lt;!&ndash;    </div>&ndash;&gt;-->
    <!--    &lt;!&ndash;    <div class="relative flex items-top justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900 p-6">&ndash;&gt;-->
    <!--    &lt;!&ndash;        <div class="w-full max-w-md">&ndash;&gt;-->
    <!--    &lt;!&ndash;            <ApplicationLogo />&ndash;&gt;-->
    <!--    &lt;!&ndash;            <div class="px-8 py-6 mt-8 bg-white rounded-lg shadow-xl overflow-hidden">&ndash;&gt;-->

    <!--    &lt;!&ndash;                <h1 class="text-center dark:text-white p-2 mb-2 bg-gray-100">Select your workpace</h1>&ndash;&gt;-->


    <!--    &lt;!&ndash;            </div>&ndash;&gt;-->
    <!--    &lt;!&ndash;        </div>&ndash;&gt;-->
    <!--    &lt;!&ndash;    </div>&ndash;&gt;-->
</template>

