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
    const today = new Date();
    const expiryDate = new Date(expiry_date);
    return expiryDate <= today;
}

const isRegistryExpiringInLessThanAMonth = (expiry_date) => {
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
        <div class="bg-white rounded-md shadow overflow-x-auto p-2">
            <table class="w-full">
                <thead>
                <tr>
                    <th class="text-start flex p-2" @click="sort('name')">
                        Nazwa Przeglądu
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
                <tr v-for="registry of registries.data" :key="registry.id">
                    <td class="border-b p-2 w-2/3 truncate ...">
                        <Link :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class="hover:text-cyan-600 text-sm">
                            {{ registry.name }}
                        </Link>

                    </td>
                    <td class="border-b p-2 px-2 w-16">
                        <Icon v-if="isRegistryExpired(registry.expiry_date)" name="expired" class="block m-auto text-red-500 h-6 w-6"/>

                        <Icon v-else-if="isRegistryExpiringInLessThanAMonth(registry.expiry_date)" name="bell" class="block m-auto text-yellow-500 h-6 w-6"/>

                    </td>
                    <td class="border-b p-2 text-sm truncate ... ">
                       {{ registry.expiry_date }} <span class="ml-2 text-xs italic text-gray-400"> {{ timeLeftUntilExpiryDate(registry.expiry_date) }} </span>
                    </td>
                    <td class="border-b p-2 w-24">
                        <Link
                            v-if="!isRegistryExpired(registry.expiry_date)"
                            :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
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
                <tr v-if="registries.data.length === 0">
                    <td class="p-2 border-t text-red-600" colspan="4">No registries assigned.</td>
                </tr>

                </tbody>
            </table>
            <Pagination :links="registries.links" class="flex flex-wrap pt-2"></Pagination>
        </div>



    </WorkspaceLayout>

</template>


