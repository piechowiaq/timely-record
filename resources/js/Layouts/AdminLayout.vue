<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <!-- Layout -->
    <div class="flex overflow-hidden">

        <!-- Left Side Wrapper -->
        <div class="w-56">
            <!--Left Top Side Wrapper -->
            <!-- Logo -->
            <div class="h-24 flex items-center md:bg-gray-200 justify-center ">
                <Link :href="route('admin.dashboard')">
                    <ApplicationLogo
                        class="block h-14 w-auto fill-current text-gray-800"
                    />
                </Link>
            </div>
            <!--Left Bottom Side Wrapper -->
            <!-- Side Navigation-->
            <div class="flex bg-red-800 h-screen hidden md:block bg-cyan-700 flex-shrink-0 w-56 p-12 overflow-y-auto">
                <div class="mb-4">
                    <Link :href="route('dashboard')" class="flex items-center group py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                            <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
                        </svg>
                        <div class="text-zinc-300 group-hover:text-white">Dashboard</div>
                    </Link>
                </div>
                <div class="mb-4">
                    <Link :href="route('dashboard')" class="flex items-center group py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                            <path fill-rule="evenodd" d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"></path>
                        </svg>
                        <div class="text-zinc-300 group-hover:text-white">Companies</div>
                    </Link>
                </div>
                <div class="mb-4">
                    <Link :href="route('dashboard')" class="flex items-center group py-3">
                        <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                            <path d="M18.344,16.174l-7.98-12.856c-0.172-0.288-0.586-0.288-0.758,0L1.627,16.217c0.339-0.543-0.603,0.668,0.384,0.682h15.991C18.893,16.891,18.167,15.961,18.344,16.174 M2.789,16.008l7.196-11.6l7.224,11.6H2.789z M10.455,7.552v3.561c0,0.244-0.199,0.445-0.443,0.445s-0.443-0.201-0.443-0.445V7.552c0-0.245,0.199-0.445,0.443-0.445S10.455,7.307,10.455,7.552M10.012,12.439c-0.733,0-1.33,0.6-1.33,1.336s0.597,1.336,1.33,1.336c0.734,0,1.33-0.6,1.33-1.336S10.746,12.439,10.012,12.439M10.012,14.221c-0.244,0-0.443-0.199-0.443-0.445c0-0.244,0.199-0.445,0.443-0.445s0.443,0.201,0.443,0.445C10.455,14.021,10.256,14.221,10.012,14.221"></path>
                        </svg>
                        <div class="text-zinc-300 group-hover:text-white">Permissions</div>
                    </Link>
                </div>
                <div class="mb-4">
                    <Link :href="route('dashboard')" class="flex items-center group py-3">
                        <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                            <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                        </svg>
                        <div class="text-zinc-300 group-hover:text-white">Roles</div>
                    </Link>
                </div>
                <div class="mb-4">
                    <Link :href="route('dashboard')" class="flex items-center group py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
                            <path d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"></path>
                        </svg>
                        <div class="text-zinc-300 group-hover:text-white">Users</div>
                    </Link>
                </div>
                <div class="mb-4">
                    <Link :href="route('dashboard')" class="flex items-center group py-3">
                        <svg class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white" viewBox="0 0 20 20">
                            <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                        </svg>
                        <div class="text-zinc-300 group-hover:text-white">Registries</div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Right Side Wrapper -->
        <div class="w-full">
            <!-- Right Top Side Wrapper -->
            <nav class="bg-white border-b border-gray-100 h-24">
                <!-- Primary Navigation Menu -->
                <div class="flex justify-between h-24 mx-auto">
                    <!-- Full width Top Navigation -->
                    <div class="flex justify-between w-full">
                        <!-- Company Name -->
                        <div class="sm:flex sm:items-center hidden">
                            <p>Radisson Blu Hotel & Residences, Zakopane</p>
                        </div>
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                    </div>


                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>

                </div>


                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Right Bottom Side Wrapper -->
            <div class="h-screen bg-red-800">
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>

</template>
