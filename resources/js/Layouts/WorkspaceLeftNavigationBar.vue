<script setup>

import { Link } from '@inertiajs/vue3';

defineProps({
    company: {
        type: Object,
    },
    companiesCount: {
        type: Number,
    },
});



</script>
<template>
    <div class="flex-shrink-0 hidden md:block w-56 p-12 bg-cyan-700">
        <div class="mb-4">
            <Link :href="route('workspace.dashboard', { company: company.id })" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                    <path
                        d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Dashboard</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('workspace.registries.index', { company: company.id })" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"
                     class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                    <path fill-rule="evenodd"
                          d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Registers</div>
            </Link>
        </div>
      <hr>

        <div v-if="companiesCount > 1" class="my-4">
            <Link :href="route('workspace.selector')" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                    <path d="M22 21H2v-2h1V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v5h2v10h1v2Zm-5-2h2v-8h-6v8h2v-6h2v6Zm0-10V5H5v14h6V9h6ZM7 11h2v2H7v-2Zm0 4h2v2H7v-2Zm0-8h2v2H7V7Z"/>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Workspace</div>
            </Link>
        </div>
    </div>
</template>


<style scoped>

</style>
