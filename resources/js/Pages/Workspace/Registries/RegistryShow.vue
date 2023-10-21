<script setup>

import {Link, usePage} from "@inertiajs/vue3";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import WorkspaceBanner from "@/Components/WorkspaceBanner.vue"


defineProps({
    company: {
        type: Object,
    },
    companiesCount: {
        type: Number,
    },
    registry: {
        type: Object,
    },
    reports: {
        type: Array,
    }
})

</script>

<template>

    <WorkspaceLayout :company="company" :companies-count="companiesCount">
        <WorkspaceBanner :href="route('workspace.registries.index', company)" :name="registry.name"/>

        <div class="md:flex md:flex-grow md:overflow-hidden">
            <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto">
                <div>
                    <div class="mb-6 flex justify-between items-center">
                        <h1 class="mb-8 font-bold text-3xl pr-4">{{ registry.name }}</h1>
                        <Link :href="route('workspace.registry.reports.create', [company, registry])" class="block whitespace-nowrap">
                            Submit Report
                        </Link>
                    </div>
                    <div class="bg-white shadow overflow-x-auto px-6 pt-6 pb-4">
                        <div class="font-bold"> Description:</div>
                        <br>

                        <div class=" text-sm mb-6">{{ registry.description }}</div>

                        <div class=" font-bold"> Valid for | in months:</div>
                        <br>

                        <div class="text-sm">{{ registry.valid_for }}</div>
                    </div>

                    <div class="bg-white shadow overflow-x-auto mt-4">
                        <table class="w-full whitespace-nowrap">
                            <tr class="text-left font-bold">
                                <th class="px-6 pt-6 pb-4">Reports</th>

                            </tr>
                            <tr v-for="report of reports" :key="report.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">
                                <td class="border-t">
                                    <div class="px-6 py-4 flex items-center focus:text-indigo-500">{{
                                            report.report_date
                                        }}
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="reports.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">No reports found.</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </WorkspaceLayout>
</template>


