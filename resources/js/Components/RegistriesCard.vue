<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    company: {
        type: Object,
    },
    mostOutdatedRegistries: {
        type: Array,
    },
    getExpiringSoonRegistries: {
        type: Array,
    },
    recentlyUpdatedRegistries: {
        type: Array,
    },
    countOfUpToDateRegistries: {
        type: Number
    },
    countOfExpiredRegistries: {
        type: Number
    },
    percentageOfUpToDate: {
        type: Number
    }
});

</script>

<template>
    <section :class="{'border-green-600': percentageOfUpToDate === 100, 'border-cyan-600': percentageOfUpToDate !== 100}" class="border flex-grow p-4 rounded-lg shadow-2xl font-bold text-gray-600 mt-2">
        <article class="">
            <header class="justify-between items-center flex border-b pb-2 block whitespace-nowrap">
                <h2 class="truncate">Registries</h2>
                <template v-if="percentageOfUpToDate === 100">
                    <span class="bg-green-500 px-2 mb-2 rounded text-white text-xs font-medium">EXCELLENT</span>
                </template>
                <template v-else-if="percentageOfUpToDate > 90">
                    <span class="bg-green-300 px-2 mb-2 rounded text-white text-xs font-medium">GOOD</span>
                </template>
                <template v-else-if="percentageOfUpToDate > 80">
                    <span class="bg-yellow-300 px-2 mb-2 rounded text-white text-xs font-medium">AVERAGE</span>
                </template>
                <template v-else>
                    <span class="bg-red-500 px-2 mb-2 rounded text-white text-xs font-medium truncate">NEEDS IMPROVEMENT</span>
                </template>
            </header>

            <div class="flex justify-between py-2">
                <p class="text-5xl">{{ percentageOfUpToDate }}% <span class="text-xs truncate">COMPLETED</span></p>
                <div>
                    <p class="text-sm"><span class="text-green-600 truncate">{{ countOfUpToDateRegistries }} valid</span></p>
                    <p class="text-sm"><span class="text-red-600 truncate">{{ countOfExpiredRegistries }} expired</span></p>
                </div>
            </div>

        </article>


        <aside class=" text-xs py-2">
            <h3 class="py-2">Most Outdated:</h3>
            <ul v-if="mostOutdatedRegistries && mostOutdatedRegistries.length" class="text-cyan-600">
                <li v-for="registry in mostOutdatedRegistries" :key="registry.name" class="py-1 truncate">
                    <Link :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])">
                        {{ registry.name }}
                    </Link>
                </li>
            </ul>
            <p v-else class="text-green-600">All of the registries are updated.</p>
        </aside>
        <aside class=" text-xs py-2">
            <h3 class="py-2">Expiring Soon:</h3>
            <ul class="text-cyan-600 ">
                <li v-for="registry in getExpiringSoonRegistries" :key="registry.name" class="py-1 truncate">
                    <Link :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])">
                        {{ registry.name }}
                    </Link>
                </li>
            </ul>
        </aside>
    </section>
</template>

