<script setup>

import { useWorkspaceMenuStore } from "@/Stores/WorkspaceMenuStore.js";
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import Icon from "@/Components/Icon.vue";

const WorkspaceMenu = useWorkspaceMenuStore();

const isSuperAdmin = WorkspaceMenu.isSuperAdmin;
const hasMultipleCompanies = WorkspaceMenu.hasMultipleCompanies;


defineProps({
    company: {
        type: Object,
    },
});

</script>

<template>
    <nav class="flex-shrink-0 hidden pt-2 md:block w-56 bg-cyan-600">
        <ul>
            <li v-for="option in WorkspaceMenu.options" :key="option.route" >
                    <Link :href="route(option.route, { company: company.id })"
                          class="flex items-center group hover:bg-gray-100 p-3 ">
                        <Icon :name="option.icon" class="ml-4 w-4 h-4 mr-2 fill-white group-hover:fill-cyan-600"/>
                        <span class="text-white  group-hover:text-cyan-600"> {{ option.name }}</span>
                    </Link>
            </li>
            <li v-if="isSuperAdmin" class="border-t border-gray-200" >
                <Link :href="route(WorkspaceMenu.superAdminOptions.route, { company: company.id })"
                      class="flex items-center group hover:bg-gray-100 p-3 ">
                    <Icon :name="WorkspaceMenu.superAdminOptions.icon" class="ml-4 w-4 h-4 mr-2 fill-white group-hover:fill-cyan-600"/>
                    <span class="text-white  group-hover:text-cyan-600"> {{ WorkspaceMenu.superAdminOptions.name }}</span>
                </Link>
            </li>
            <li v-if="hasMultipleCompanies && !isSuperAdmin" class="border-t border-gray-200" >
                <Link  :href="route(WorkspaceMenu.multipleCompaniesOptions.route, { company: company.id })"
                      class="flex items-center group hover:bg-gray-100 p-3 ">
                    <Icon :name="WorkspaceMenu.multipleCompaniesOptions.icon" class="ml-4 w-4 h-4 mr-2 fill-white group-hover:fill-cyan-600"/>
                    <span class="text-white  group-hover:text-cyan-600"> {{ WorkspaceMenu.multipleCompaniesOptions.name }}</span>
                </Link>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
