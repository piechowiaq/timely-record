<script setup>

import {Link, usePage} from "@inertiajs/vue3";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import WorkspaceBanner from "@/Components/WorkspaceBanner.vue"
import {computed} from "vue";
import Icon from "@/Components/Icon.vue"

const props = defineProps({
    company: {
        type: Object,
    },

    registry: {
        type: Object,
    },
    reports: {
        type: Array,
    }
})

const validFor = computed(() => {
    if (props.registry.valid_for < 12) {
        return `${props.registry.valid_for} ${props.registry.valid_for === 1 ? 'month' : 'months'}`;
    } else {
        const years = Math.floor(props.registry.valid_for / 12);
        const months = props.registry.valid_for % 12;

        let yearText = `${years} ${years === 1 ? 'year' : 'years'}`;
        let monthText = months ? `${months} ${months === 1 ? 'month' : 'months'}` : '';

        return months ? `${yearText} and ${monthText}` : yearText;
    }
});

const isReportExpired = (expiry_date) => {
    const currentDate = new Date();
    const expiryDate = new Date(expiry_date);
    return expiryDate <= currentDate;
}

const timeLeftUntilExpiryDate = (expiry_date) => {
    const today = new Date();
    const expiryDate = new Date(!expiry_date ? today : expiry_date);
    const diffTime = expiryDate - today;
    let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (!expiry_date){
        return "Awaiting upload"
    }
    else if (days <= 0) {
        return "Expired";
    } else if (days < 30) {
        return `${days} day(s)`;
    } else if (days < 365) {
        const months = Math.floor(days / 30);
        return `${months} month(s)`;
    } else {
        const years = Math.floor(days / 365);
        const remainingMonths = Math.floor((days % 365) / 30);
        return `${years} year(s) ${remainingMonths ? `${remainingMonths} month(s)` : ''}`.trim();
    }
};



</script>

<template>

    <WorkspaceLayout :company="company">
        <WorkspaceBanner :href="route('workspace.registries.index', company)" :name="registry.name"/>

        <div class="md:flex md:flex-grow md:overflow-hidden">
            <div class=" md:flex-1 md:overflow-y-auto">
                <div>
                    <div class="p-4 flex justify-between items-center">
                        <h1 class="font-bold text-3xl pr-4">{{ registry.name }}</h1>
                        <Link :href="route('workspace.registry.reports.create', [company, registry])" class="block whitespace-nowrap">
                            Submit Report
                        </Link>
                    </div>
                    <div class="bg-white shadow overflow-x-auto p-4">
                        <div class="font-bold"> Description: </div>
                        <br>

                        <div class=" text-sm mb-6">{{ registry.description }}</div>

                        <div class=" font-bold"> Valid for: {{ validFor }}</div>

                    </div>


                    <div class="bg-white shadow overflow-x-auto ">
                        <table class="w-full border border-cyan-600 rounded-lg whitespace-nowrap">
                            <caption class="text-start ml-4">Current most recent report</caption>
                            <tr class="text-sm">
                                <th class="p-4 w-2/3 flex">
                                    Data przeglądu

                                    <Icon name="sorting" class="block m-auto ml-2 text-gray-300"/>

                                </th>
                                <th class="p-4">Ikonka</th>
                                <th colspan="2" class="px-6 pt-6 pb-4 flex text-center" @click="sort('expiry_date')">
                                    Wygasa za

                                    <Icon name="sorting" class="block m-auto ml-2 text-gray-300 "/>


                                </th>
                                <th class="p-4">Wygasa dnia</th>
                                <th class="p-4 text-center">Pobierz</th>

                            </tr>


                            <tr v-for="report of reports" :key="report.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">

                                <td class="border-t">

                                    <Link value="Edit"


                                          class="px-6 py-3 flex items-center focus:text-indigo-500">
                                        {{
                                            report.report_date
                                        }} <span class="text-xs text-gray-400 italic  ml-6">Uploaded: {{ report.created_at }} - {{ report.notes }}</span>
                                    </Link>
                                </td>
                                <td class="border-t w-px">
                                    <div v-if="isReportExpired(report.expiry_date)">
                                        <Icon name="expired" class="block m-auto text-red-500 h-6 w-6"/>
                                    </div>

                                </td>
                                <td class="border-t">
                                    <Link value="Edit"

                                          class="px-6 py-3 flex items-center focus:text-indigo-500">
                                        {{ timeLeftUntilExpiryDate(report.expiry_date) }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit"

                                          class="pr-6 py-3 w-auto flex items-center text-sm text-gray-300 focus:text-cyan-600">
                                        {{ report.expiry_date }}
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit"

                                          class=" hover:bg-cyan-600 group px-6 py-3 flex items-center focus:text-cyan-600">

                                        <Icon name="download" class="block m-auto h-6 w-6 group-hover:fill-white "/>

                                    </Link>


                                </td>

                            </tr>




                            <tr v-if="reports.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">Awaiting upoload.</td>
                            </tr>
                        </table>

                    <div class="bg-white shadow overflow-x-auto mt-4">
                        <table class="w-full border border-cyan-600 rounded-lg whitespace-nowrap">
                            <caption class="text-start ml-4">Current most recent report</caption>
                            <tr class="text-sm">
                                <th class="p-4 w-2/3 flex">
                                    Data przeglądu

                                    <Icon name="sorting" class="block m-auto ml-2 text-gray-300"/>

                                </th>
                                <th class="p-4">Ikonka</th>
                                <th colspan="2" class="px-6 pt-6 pb-4 flex text-center" @click="sort('expiry_date')">
                                    Wygasa za

                                    <Icon name="sorting" class="block m-auto ml-2 text-gray-300 "/>


                                </th>
                                <th class="p-4">Wygasa dnia</th>
                                <th class="p-4 text-center">Pobierz</th>

                            </tr>


                            <tr v-for="report of reports" :key="report.id"
                                class="hover:bg-gray-100 focus-within:bg-gray-100">

                                <td class="border-t">

                                    <Link value="Edit"


                                          class="px-6 py-3 flex items-center focus:text-indigo-500">
                                        {{
                                            report.report_date
                                        }} <span class="text-xs text-gray-400 italic  ml-6">Uploaded: 2023-10-12 - Bartosz Piechowiak</span>
                                    </Link>
                                </td>
                                <td class="border-t w-px">
                                    <div >
                                        <Icon name="expired" class="block m-auto text-red-100 h-6 w-6"/>
                                    </div>

                                </td>
                                <td class="border-t">
                                    <Link value="Edit"

                                          class="px-6 py-3 flex items-center focus:text-indigo-500">
                                        50 days
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit"

                                          class="pr-6 py-3 w-auto flex items-center text-sm text-gray-300 focus:text-cyan-600">
                                        2024-10-10
                                    </Link>
                                </td>
                                <td class="border-t">
                                    <Link value="Edit"

                                          class=" hover:bg-cyan-600 group px-6 py-3 flex items-center focus:text-cyan-600">

                                        <Icon name="download" class="block m-auto h-6 w-6 group-hover:fill-white "/>

                                    </Link>


                                </td>

                            </tr>




                            <tr v-if="reports.length === 0">
                                <td class="px-6 py-4 border-t" colspan="4">Awaiting upoload.</td>
                            </tr>
                        </table>




                    </div>



                </div>
            </div>
            </div>
        </div>
    </WorkspaceLayout>
</template>


