<script setup>
import {computed, defineProps, ref, watch} from 'vue'
import {debounce, mapValues} from "lodash"
import {Link, Head, router} from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue"
import Pagination from '@/Components/Pagination.vue'
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"

import WorkspaceBanner from "@/Components/WorkspaceBanner.vue"

const props = defineProps({
    company: {
        type: Object,
    },
    registries: {
        type: Object,
    },
    filters: {
        type: Object
    },
    companiesCount: {
        type: Number,
    },
    countOfUpToDateRegistries: {
        type: Number,
    }
})


const index = ref({
    search: props.filters.search,
})

watch(index, debounce(function () {
    router.get(route('workspace.registries.index', props.company), index.value, {
        preserveState: true,
        replace: true
    });
}, 150), {deep: true});


const reset = () => {
    index.value = mapValues(index.value, () => null)
}

const sort = (field) => {
    index.value.field = field;
    index.value.direction = index.value.direction === 'asc' ? 'desc' : 'asc';
}

const isRegistryExpired = (expiry_date) => {
    return expiry_date <= 0;
}

const daysLeftUntilExpiryDate = (expiry_date) => {
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


    <WorkspaceLayout :company="company" :companies-count="companiesCount">
        <WorkspaceBanner :href="route('workspace.registries.index', company)" :name="'Index'"/>
        <div class="mb-6 flex items-center">
            <input v-model="index.search" type="text" name="search" placeholder="Search…"
                   class="text-sm w-1/4 h-8 px-6 py-3 border-gray-200 ">
            <button type="button" class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-cyan-600"
                    @click="reset">Reset
            </button>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4 w-2/3 flex" @click="sort('name')">
                        Nazwa przeglądu

                        <Icon name="sorting" class="block m-auto ml-2 text-gray-300"/>

                    </th>
                    <th class="px-6 pt-6 pb-4"></th>
                    <th colspan="2" class="px-6 pt-6 pb-4 flex text-center" @click="sort('expiry_date')">
                        Wygasa za | dnia

                        <Icon name="sorting" class="block m-auto ml-2 text-gray-300 "/>


                    </th>
                    <th class="px-6 pt-6 pb-4"></th>
                    <th class="px-6 pt-6 pb-4 text-center">Pobierz</th>

                </tr>
                <tr v-for="registry of registries.data" :key="registry.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100">

                    <td class="border-t">

                        <Link value="Edit"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"

                              class="px-6 py-3 flex items-center focus:text-indigo-500">{{
                                registry.name
                            }}
                        </Link>
                    </td>
                    <td class="border-t w-px">
                        <div v-if="isRegistryExpired(registry.expiry_date)">
                            <icon name="expired" class="block m-auto text-red-500 h-6 w-6"/>
                        </div>

                    </td>
                    <td class="border-t">
                        <Link value="Edit"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class="px-6 py-3 flex items-center focus:text-indigo-500">
                            {{ daysLeftUntilExpiryDate(registry.expiry_date) }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link value="Edit"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class="pr-6 py-3 w-auto flex items-center text-sm text-gray-300 focus:text-cyan-600">
                            {{ registry.expiry_date }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link value="Edit" v-if="! isRegistryExpired(registry.expiry_date)"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class=" hover:bg-cyan-600 group px-6 py-3 flex items-center focus:text-cyan-600">

                            <Icon name="download" class="block m-auto h-6 w-6 group-hover:fill-white "/>

                        </Link>
                        <Icon v-else name="download" class="text-gray-300 block m-auto h-6 w-6 "/>

                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-4"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              tabindex="-1">
                            <Icon name="cheveron-right" class="block w-6 h-6 fill-gray-400"/>
                        </Link>
                    </td>
                </tr>


                <tr v-if="registries.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No registries found.</td>
                </tr>
            </table>
        </div>

        <Pagination :links="registries.links" class="flex flex-wrap py-6"></Pagination>

    </WorkspaceLayout>

</template>


