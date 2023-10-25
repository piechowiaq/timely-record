<script setup>

import {Link, router, usePage} from "@inertiajs/vue3";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import WorkspaceBanner from "@/Components/WorkspaceBanner.vue"
import {computed, ref, watch} from "vue";
import Icon from "@/Components/Icon.vue"
import {debounce} from "lodash";

const props = defineProps({
    company: {
        type: Object,
    },
    registry: {
        type: Object,
    },
    historicalReports: {
        type: Object,
    },
    mostCurrentReport: {
        type: Object
    },
    reports: {
        type: Array
    },
    filters: {
        type: Object
    },
})

const index = ref(
    props.filters
)


const sort = (field) => {
    index.value.field = field;
    index.value.direction = index.value.direction === 'asc' ? 'desc' : 'asc';
}


watch(index, debounce(function () {
    router.get(route('workspace.registries.show', [props.company, props.registry]), index.value, {
        preserveState: true,
        replace: true
    });
}, 150), {deep: true});

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

const isReportExpiringInLessThanAMonth = (expiry_date) => {
    const today = new Date();
    const expiryDate = new Date(expiry_date);
    const diffTime = expiryDate - today;
    const daysUntilExpiry = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    return daysUntilExpiry > 0 && daysUntilExpiry < 30;
}

const timeLeftUntilExpiryDate = (expiry_date) => {
    const today = new Date();
    const expiryDate = new Date(!expiry_date ? today : expiry_date);
    const diffTime = expiryDate - today;
    let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    if (!expiry_date) {
        return "Awaiting upload"
    } else if (days <= 0) {
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

const toDateString = (dateString) => {
    return new Date(dateString).toISOString().split('T')[0];
}



</script>

<template>

    <WorkspaceLayout :company="company">
        <WorkspaceBanner :href="route('workspace.registries.index', company)" :name="registry.name"/>
        <div class="md:flex md:flex-grow md:overflow-hidden">
            <div class=" md:flex-1 md:overflow-y-auto">
                <div>
                    <div class="p-4 flex justify-between items-center">
                        <h1 class="font-bold text-3xl pr-4">{{ registry.name }}</h1>
                        <Link :href="route('workspace.registry.reports.create', [company, registry])"
                              class="block whitespace-nowrap">
                            Submit Report
                        </Link>
                    </div>
                    <div class="shadow overflow-x-auto px-4 pb-4">
                        <div class="font-bold"> Description:</div>
                        <br>
                        <div class=" text-sm mb-6">{{ registry.description }}</div>
                        <div class=" font-bold"> Valid for: {{ validFor }}</div>
                    </div>

                    <div class="shadow overflow-x-auto p-2">

                        <table class="w-full border">
                            <caption class="py-2">Most current report</caption>
                            <thead v-if="mostCurrentReport">
                            <tr>
                                <th class="text-start flex p-2">
                                    Data Przeglądu

                                </th>
                                <th class="p-2"></th>
                                <th class="p-2 flex">
                                    Wygasa dnia | za

                                </th>
                                <th class="p-2">Pobierz</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!mostCurrentReport">
                                <td class="p-2 text-red-600" colspan="4">Awaiting upoload.</td>
                            </tr>
                            <tr v-else>
                                <td class="border-b p-2 w-2/3 truncate ...">
                                    <Link :href="route('workspace.registry.reports.edit', [company.id, registry.id, mostCurrentReport.id ])"
                                          class="hover:text-cyan-600 text-sm">
                                        {{ mostCurrentReport.report_date }}
                                    </Link>
                                    <span class="text-xs text-gray-400 italic  ml-6">
                                        Created: {{ toDateString(mostCurrentReport.created_at) }} -
                                        {{ mostCurrentReport?.created_by_user?.first_name }} {{ mostCurrentReport?.created_by_user?.last_name }}
                                    <span v-if="new Date(mostCurrentReport.updated_at) > new Date(mostCurrentReport.created_at)">
                                    | Updated: {{ toDateString(mostCurrentReport.updated_at) }} -
                                        {{ mostCurrentReport?.updated_by_user?.first_name }} {{ mostCurrentReport?.updated_by_user?.last_name }}
                                        </span>


                                    </span>

                                </td>
                                <td class="border-b p-2 px-2 w-16">
                                    <Icon v-if="isReportExpired(mostCurrentReport.expiry_date)" name="expired" class="block m-auto text-red-500 h-6 w-6"/>

                                    <Icon v-else-if="isReportExpiringInLessThanAMonth(mostCurrentReport.expiry_date)" name="bell" class="block m-auto text-yellow-500 h-6 w-6"/>

                                </td>
                                <td class="border-b p-2 text-sm truncate ... ">
                                    {{ mostCurrentReport.expiry_date }} <span class="ml-2 text-xs italic text-gray-400"> {{ timeLeftUntilExpiryDate(mostCurrentReport.expiry_date) }} </span>
                                </td>
                                <td class="border-b p-2 w-24">
                                    <Link
                                        v-if="mostCurrentReport.expiry_date"
                                        :href="route('workspace.registry.reports.edit', [company.id, registry.id, mostCurrentReport.id ])"
                                        class="hover:bg-gray-100 group flex items-center border"
                                    >
                                        <Icon name="download" class="block m-auto h-6 w-6 group-hover:fill-cyan-600 fill-gray-600" />
                                    </Link>
                                    <Icon
                                        v-else
                                        name="download"
                                        class="text-gray-300 block m-auto h-6 w-6"
                                    />
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="bg-white shadow overflow-x-auto p-2">

                        <table class="w-full bg-gray-100 ">
                            <caption class="py-2">Hisorical reports</caption>
                            <thead v-if="historicalReports.length !== 0">
                            <tr>
                                <th class="text-start flex p-2" @click="sort('report_date')" >
                                    Data Przeglądu
                                    <Icon name="sorting" class="block m-auto ml-2 text-gray-300"/>
                                </th>
                                <th class="p-2"></th>
                                <th class="p-2 flex" @click="sort('expiry_date')">
                                    Wygasa dnia | za
                                    <Icon name="sorting" class="block m-auto ml-2 text-gray-300"/>
                                </th>
                                <th class="p-2">Pobierz</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="historicalReports.length === 0">
                                <td class="p-2 text-red-600" colspan="4">No other reports.</td>
                            </tr>
                            <tr v-else v-for="report of historicalReports" :key="report.id">
                                <td class="border-b p-2 w-2/3 truncate ...">
                                    <Link :href="route('workspace.registry.reports.edit', [company.id, registry.id, report.id ])"
                                          class="hover:text-cyan-600 text-sm">
                                        {{ report.report_date }}
                                    </Link>
                                    <span class="text-xs text-gray-400 italic  ml-6">
                                        Created: {{ toDateString(report.created_at) }} -
                                        {{ report?.created_by_user?.first_name }} {{ report?.created_by_user?.last_name }}
                                        <span v-if="new Date(report.updated_at) > new Date(report.created_at)">
                                        / Updated: {{ toDateString(report.updated_at) }} -
                                            {{ report?.updated_by_user?.first_name }} {{ report?.updated_by_user?.last_name }}
                                        </span>
                                    </span>

                                </td>
                                <td class="border-b p-2 px-2 w-16">
                                    <Icon v-if="isReportExpired(report.expiry_date)" name="expired" class="block m-auto text-red-200 h-6 w-6"/>

                                    <Icon v-else-if="isReportExpiringInLessThanAMonth(report.expiry_date)" name="bell" class="block m-auto text-yellow-500 h-6 w-6"/>

                                </td>
                                <td class="border-b p-2 text-sm truncate ... ">
                                    {{ report.expiry_date }} <span class="ml-2 text-xs italic text-gray-400"> {{ timeLeftUntilExpiryDate(report.expiry_date) }} </span>
                                </td>
                                <td class="border-b p-2 w-24">
                                    <Link
                                        v-if="report.expiry_date"
                                        :href="route('workspace.registry.reports.edit', [company.id, registry.id, report.id ])"
                                        class="hover:bg-gray-100 group flex items-center border"
                                    >
                                        <Icon name="download" class="block m-auto h-6 w-6 group-hover:fill-cyan-600 fill-gray-600" />
                                    </Link>
                                    <Icon
                                        v-else
                                        name="download"
                                        class="text-gray-300 block m-auto h-6 w-6"
                                    />
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </WorkspaceLayout>
</template>


