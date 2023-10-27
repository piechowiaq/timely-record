<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    company: {
        type: Object,
    },
    workspace: {
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
    <section :class="{'border-green-600': percentageOfUpToDate === 100, 'border-cyan-600': percentageOfUpToDate !== 100}" class="border bg-gray-300 flex-grow p-4 rounded-lg shadow-2xl font-bold text-gray-600 mt-2">
        <article class="">
            <header class="justify-between items-center flex border-b pb-2 block whitespace-nowrap">
                <h2 class="truncate"><Link :href="route('workspaces.show',[workspace])"> {{ workspace.name }}</Link></h2>
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
            <ul  class="text-cyan-600">
                <li  class="py-1 truncate">
                    Kontrola okresowa stanu technicznego obiektu
                </li>
                <li  class="py-1 truncate">
                    Kontrola okresowa stanu technicznego obiektu
                </li>
                <li  class="py-1 truncate">
                    Kontrola okresowa stanu technicznego obiektu
                </li>
            </ul>

        </aside>

        <aside class=" text-xs py-2">
            <h3 class="py-2">Recently updated:</h3>
            <ul class="text-cyan-600 ">
                <li  class="py-1 truncate">
                    Kontrola okresowa stanu technicznego obiektu
                </li>
                <li  class="py-1 truncate">
                    Kontrola okresowa stanu technicznego obiektu
                </li>
                <li  class="py-1 truncate">
                    Kontrola okresowa stanu technicznego obiektu
                </li>
            </ul>
        </aside>
    </section>
</template>

