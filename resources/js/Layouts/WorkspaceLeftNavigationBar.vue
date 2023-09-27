<script setup>

import { Link } from '@inertiajs/vue3';

</script>
<template>
    <div class="flex-shrink-0 hidden md:block w-56 p-12 bg-cyan-700">
        <div class="mb-4">
            <Link :href="route('admin.dashboard')" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                    <path
                        d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Dashboard</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('dashboard')" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"
                     class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                    <path fill-rule="evenodd"
                          d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Registers</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('dashboard')" class="flex items-center group py-3">
                <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                    <path
                        d="M18.344,16.174l-7.98-12.856c-0.172-0.288-0.586-0.288-0.758,0L1.627,16.217c0.339-0.543-0.603,0.668,0.384,0.682h15.991C18.893,16.891,18.167,15.961,18.344,16.174 M2.789,16.008l7.196-11.6l7.224,11.6H2.789z M10.455,7.552v3.561c0,0.244-0.199,0.445-0.443,0.445s-0.443-0.201-0.443-0.445V7.552c0-0.245,0.199-0.445,0.443-0.445S10.455,7.307,10.455,7.552M10.012,12.439c-0.733,0-1.33,0.6-1.33,1.336s0.597,1.336,1.33,1.336c0.734,0,1.33-0.6,1.33-1.336S10.746,12.439,10.012,12.439M10.012,14.221c-0.244,0-0.443-0.199-0.443-0.445c0-0.244,0.199-0.445,0.443-0.445s0.443,0.201,0.443,0.445C10.455,14.021,10.256,14.221,10.012,14.221"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Trainings</div>
            </Link>
        </div>
    </div>
</template>


<style scoped>

</style>
