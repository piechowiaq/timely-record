<script setup>

import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    company: {
        type: Object,
    },
    mostOutdatedRegistries: {
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


    <WorkspaceLayout :company="company">
        <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold text-cyan-600">
            <p>Dashboard</p>
        </div>
        <div class="sm:flex sm:space-x-2">
            <div class="sm:w-1/2">
                <section :class="{'border-green-600': percentageOfUpToDate === 100, 'border-cyan-600': percentageOfUpToDate !== 100}" class="border h-full p-8 rounded-lg shadow-2xl font-bold text-gray-600 mt-2">
                    <div class="h-1/3">
                        <header class="justify-between items-center flex border-b pb-2 block whitespace-nowrap">
                            <p class="truncate ...">Registries</p>
                            <span v-if="percentageOfUpToDate === 100" class="bg-green-500 px-2 mb-2 rounded text-white text-xs font-medium">EXCELLENT</span>
                            <span v-else-if="percentageOfUpToDate > 95" class="bg-green-300 px-2 mb-2 rounded text-white text-xs font-medium">GOOD</span>
                            <span v-else-if="percentageOfUpToDate > 90" class="bg-yellow-300 px-2 mb-2 rounded text-white text-xs font-medium">AVERAGE</span>
                            <span v-else class="bg-red-500 px-2 mb-2 rounded text-white text-xs font-medium truncate ... ">NEEDS IMPROVEMENT</span>
                        </header>

                        <div class="flex justify-between py-2">
                            <p class="text-5xl">{{ percentageOfUpToDate }}% <span class="text-xs truncate ...">COMPLETED</span></p>
                            <div class="">
                                <p class="text-sm"><span class="text-green-600 truncate ...">{{ countOfUpToDateRegistries }} valid</span></p>
                                <p class="text-sm"><span class="text-red-600 truncate ...">{{ countOfExpiredRegistries }} expired</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="h-1/3">
                        <article class="text-xs py-2">

                                <h1 class="py-4">Most Outdated:</h1>
                                <ul class="text-cyan-600" v-if="mostOutdatedRegistries && mostOutdatedRegistries.length">
                                    <li v-for="registry in mostOutdatedRegistries" :key="registry.name" class="py-1 truncate ...">
                                        <Link :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])" >
                                            {{ registry.name }}
                                        </Link>
                                    </li>
                                </ul>
                                <p v-else class="text-green-600">All of the registries are updated.</p>
                        </article>
                    </div>
                    <div class="h-1/3">
                        <article class="text-xs py-2">
                            <h1 class="py-4">Recently updated:</h1>
                            <ul class="text-cyan-600">
                                <li v-for="registry in recentlyUpdatedRegistries" :key="registry.name" class="py-1 truncate ...">
                                    <Link :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])" >
                                        {{ registry.name }}
                                    </Link>
                                </li>
                            </ul>
                        </article>
                    </div>

                </section>
            </div>




            <div class="sm:w-1/2 ">
                <div class="h-full border bg-gray-100 border-gray-300 p-8 rounded-lg font-bold text-gray-300 mt-2">
                    <div class="justify-between items-center flex border-b">
                        <p class="text-sm  pb-2">Trainings</p>
                        <p class="bg-red-200 px-2 mb-2 rounded text-white text-xs font-medium">NEEDS IMPROVEMENT</p>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-2xl py-2">65%</p>
                        <div class="py-2">
                            <p class="text-xs ">8 <span class="text-green-200">valid</span></p>
                            <p class="text-xs ">18 <span class="text-red-200">expired</span></p>

                        </div>


                    </div>

                    <div class="text-xs py-2">
                        <h1 class="py-4">Most Outdated:</h1>
                        <ul class="text-gray-200">
                            <li class="py-1">Kontrola okresowa stanu technicznego obiektu</li>
                            <li class="py-1">Kontrola okresowa stanu technicznego obiektu</li>
                            <li class="py-1">Kontrola okresowa stanu technicznego obiektu</li>
                        </ul>
                    </div>
                    <div class="text-xs py-2">
                        <h1 class="py-4">Recently updated:</h1>
                        <ul class="text-gray-200">
                            <li class="py-1">Kontrola okresowa stanu technicznego obiektu</li>
                            <li class="py-1">Kontrola okresowa stanu technicznego obiektu</li>
                            <li class="py-1">Kontrola okresowa stanu technicznego obiektu</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>


    </WorkspaceLayout>

</template>
