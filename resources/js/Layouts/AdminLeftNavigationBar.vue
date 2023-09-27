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
            <Link :href="route('companies.index')" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"
                     class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                    <path fill-rule="evenodd"
                          d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Companies</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('permissions.index')" class="flex items-center group py-3">
                <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                    <path
                        d="M18.344,16.174l-7.98-12.856c-0.172-0.288-0.586-0.288-0.758,0L1.627,16.217c0.339-0.543-0.603,0.668,0.384,0.682h15.991C18.893,16.891,18.167,15.961,18.344,16.174 M2.789,16.008l7.196-11.6l7.224,11.6H2.789z M10.455,7.552v3.561c0,0.244-0.199,0.445-0.443,0.445s-0.443-0.201-0.443-0.445V7.552c0-0.245,0.199-0.445,0.443-0.445S10.455,7.307,10.455,7.552M10.012,12.439c-0.733,0-1.33,0.6-1.33,1.336s0.597,1.336,1.33,1.336c0.734,0,1.33-0.6,1.33-1.336S10.746,12.439,10.012,12.439M10.012,14.221c-0.244,0-0.443-0.199-0.443-0.445c0-0.244,0.199-0.445,0.443-0.445s0.443,0.201,0.443,0.445C10.455,14.021,10.256,14.221,10.012,14.221"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Permissions</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('roles.index')" class="flex items-center group py-3">
                <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                    <path
                        d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Roles</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('users.index')" class="flex items-center group py-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                    <path
                        d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Users</div>
            </Link>
        </div>
        <div class="mb-4">
            <Link :href="route('registries.index')" class="flex items-center group py-3">
                <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                    <path
                        d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                </svg>
                <div class="text-zinc-300 group-hover:text-white">Registries</div>
            </Link>
        </div>


    </div>

</template>


<style scoped>

</style>
