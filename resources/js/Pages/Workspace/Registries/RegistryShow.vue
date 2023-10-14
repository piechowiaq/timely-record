<template>

    <WorkspaceLayout :company="company" :companies-count="companiesCount">

        <div class="flex-grow bg-gray-100 py-2 px-3 md:h-12 items-center flex  justify-between font-bold mb-2">
            <div class="flex">
                <Link :href="route('workspace.registries.index', company)" class="text-cyan-600">Registries </Link>
                <p class="text-gray-600">&nbsp|&nbsp{{registry.name}}</p>
            </div>
              <FlashMessages />
        </div>
            <div class="md:flex md:flex-grow md:overflow-hidden">


                <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" >

                    <div>
                        <div class="mb-6 flex justify-between items-center">
                            <h1 class="mb-8 font-bold text-3xl">{{registry.name}}</h1>
                            <Link :href="route('workspace.registry.reports.create', [company, registry])">
                                Submit Report
                            </Link>

                        </div>


                        <div class="bg-white shadow overflow-x-auto px-6 pt-6 pb-4">
                            <div class="font-bold"> Description: </div> <br>

                            <div class=" text-sm mb-6">{{ registry.description }}</div>

                            <div class=" font-bold"> Valid for | in months: </div> <br>

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
                                        <div class="px-6 py-4 flex items-center focus:text-indigo-500">{{ report.report_date }}
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

<script>

import { defineComponent, computed } from 'vue'
import { Link, Head, usePage } from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue"
import Pagination from '@/Components/Pagination.vue'
import Search from "@/Components/Search.vue"
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import FlashMessages from "@/Components/FlashMessages.vue";


export default defineComponent({
    components: {
        WorkspaceLayout,
        Link,
        Pagination,
        Icon,
        Search,
        FlashMessages
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
    props: {
        company: Object,
        registry: Object,
        reports: Array,
        companies: Array,
        companiesCount: Number,

    },


})
</script>
