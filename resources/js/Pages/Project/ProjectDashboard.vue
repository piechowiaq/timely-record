<script setup>

import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";
import RegistriesCard from "@/Components/RegistriesCard.vue"
import TrainingsCard from "@/Components/TrainingsCard.vue";

import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import WorkspaceLeftNavigationBar from '@/Layouts/WorkspaceLeftNavigationBar.vue';
import Icon from "@/Components/Icon.vue";
import WorkspaceLogo from "@/Components/WorkspaceLogo.vue";
import {ref} from "vue";
import {Link, usePage, Head} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";

const showingNavigationDropdown = ref(false);


const props = defineProps({
    project: {
        type: Object,
    },
    workspace: {
        type: Object,
    }
});

</script>

<template>
    <div class="flex flex-col h-screen ">
        <!-- Top Layout -->
        <div class="justify-between md:flex">

            <!-- Workspace Logo -->
            <WorkspaceLogo/>

            <nav class="bg-white border-b border-gray-100 w-full ">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Banner -->
                        <div class="flex">
                            <!-- Workspace Name -->
                            <div class="hidden space-x-8  sm:flex items-center">
                                <Link v-if="workspace && workspace.name"
                                      :href="route('workspaces.show', { workspace: workspace.id })"
                                >
                                    {{ workspace.name }}
                                </Link>
                                <Link else-if="project && project.name"
                                      :href="route('project.dashboard', project)"
                                >
                                    {{ project.name }}
                                </Link>
                            </div>
                            <!-- Small Screen Logo -->
                            <div class="block sm:hidden">
                                <div
                                    class="md:w-56 md:flex-shrink-0 h-16 flex items-center justify-center md:bg-gray-100">
                                    <Icon :name="'logo'" class="w-12 h-12"/>
                                    <p class="ml-2 font-bold whitespace-nowrap tracking-widest text-gray-600"><span
                                        class="text-cyan-600 ">TIMELY</span> RECORD</p>
                                </div>
                            </div>
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
                                                     {{
                                                        $page.props.auth.user.first_name
                                                    }}  {{ $page.props.auth.user.last_name }}

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
                                        <!--                                        <DropdownLink v-if="isSuperAdmin"-->
                                        <!--                                                      :href="route('admin.dashboard')" as="button"> Admin Dashboard-->
                                        <!--                                        </DropdownLink>-->
                                        <!--                                        <DropdownLink v-else :href="route('profile.edit', { company_id : company.id })">-->
                                        <!--                                            Profile-->
                                        <!--                                        </DropdownLink>-->
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger Button -->
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
                </div>

                <!-- Small Screen Workspace Settings -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <!-- Small Screen Workspace Top Navigation -->
                    <div class="pt-2 pb-3 space-y-1">
                        <ul>
                            <li>
                                <ResponsiveNavLink :href="route('project.dashboard', project)"
                                >
                                    Workspaces
                                </ResponsiveNavLink>
                            </li>
                            <!--                            <li v-for="option in WorkspaceMenu.options" :key="option.route">-->
                            <!--                                <ResponsiveNavLink-->
                            <!--                                    :href="route(option.route, { company: company.id })"-->
                            <!--                                    :active="route().current(option.route)" >-->
                            <!--                                    {{ option.name }}-->
                            <!--                                </ResponsiveNavLink>-->
                            <!--                            </li>-->
                            <!--                            <li v-if="isSuperAdmin" class="border-t border-gray-200" >-->
                            <!--                                <ResponsiveNavLink-->
                            <!--                                    :href="route(WorkspaceMenu.superAdminOptions.route, { company: company.id })"-->
                            <!--                                    :active="route().current(WorkspaceMenu.superAdminOptions.route)">-->
                            <!--                                    {{ WorkspaceMenu.superAdminOptions.name }}-->
                            <!--                                </ResponsiveNavLink>-->
                            <!--                            </li>-->
                            <!--                            <li v-if="hasMultipleCompanies && !isSuperAdmin" class="border-t border-gray-200">-->
                            <!--                                <ResponsiveNavLink-->
                            <!--                                    :href="route(WorkspaceMenu.multipleCompaniesOptions.route, { company: company.id })"-->
                            <!--                                    :active="route().current(WorkspaceMenu.multipleCompaniesOptions.route)">-->
                            <!--                                    {{ WorkspaceMenu.multipleCompaniesOptions.name }}-->
                            <!--                                </ResponsiveNavLink>-->
                            <!--                            </li>-->
                        </ul>
                    </div>

                    <!-- Small Screen Settings-->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <!--                            <ResponsiveNavLink v-if="!isSuperAdmin" :href="route('profile.edit')"> Profile</ResponsiveNavLink>-->
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Bottom Layout -->
        <div class="flex flex-grow overflow-hidden">
            <!-- Left Nav Bar -->
<!--            <nav class="flex-shrink-0 hidden pt-2 md:block w-56 bg-cyan-600">-->
<!--                <ul>-->
<!--                    <li  class="pb-2" >-->
<!--                        <NavLink :href="route('test')"-->
<!--                                 class="flex items-center group">-->
<!--                            <Icon :name="'workspace'" />-->
<!--                            <span class="group-hover:text-cyan-600"> Registries </span>-->
<!--                        </NavLink>-->
<!--                    </li>               </ul>-->




<!--            </nav>-->



            <!--Content-->
            <main class="flex-1 overflow-y-auto p-2">

                <div class="sm:flex sm:space-x-2">


                            <TrainingsCard
                                v-for="workspace in project.workspaces"
                                :key="workspace.id"
                                :workspace="workspace"
                                />
                </div>



            </main>
        </div>
    </div>




















</template>
