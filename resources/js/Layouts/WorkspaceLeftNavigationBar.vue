<script setup>

import { useWorkspaceMenuStore } from "@/Stores/WorkspaceMenuStore.js";
import { defineProps } from 'vue';
import Icon from "@/Components/Icon.vue";
import NavLink from "@/Components/NavLink.vue";

const WorkspaceMenu = useWorkspaceMenuStore();

const isSuperAdmin = WorkspaceMenu.isSuperAdmin;
const hasMultipleWorkspaces = WorkspaceMenu.hasMultipleWorkspaces;


defineProps({
    workspace: {
        type: Object,
    },
});

</script>

<template>
    <nav class="flex-shrink-0 hidden pt-2 md:block w-56 bg-cyan-600">
        <ul>
            <li v-for="option in WorkspaceMenu.options" :key="option.route" class="pb-2" >
                    <NavLink :href="route(option.route, workspace )" :active="route().current(option.route)"
                          class="flex items-center group">
                        <Icon :name="option.icon" :active="route().current(option.route)"/>
                        <span class="group-hover:text-cyan-600"> {{ option.name }}</span>
                    </NavLink>
            </li>
            <li v-if="isSuperAdmin" class="border-t border-gray-200 pt-2" >
                <NavLink :href="route(WorkspaceMenu.superAdminOptions.route, workspace)"
                      class="flex items-center group">
                    <Icon :name="WorkspaceMenu.superAdminOptions.icon" class="ml-4 w-4 h-4 mr-2 fill-white group-hover:fill-cyan-600"/>
                    <span class="text-white  group-hover:text-cyan-600"> {{ WorkspaceMenu.superAdminOptions.name }}</span>
                </NavLink>
            </li>
            <li v-if="hasMultipleWorkspaces && !isSuperAdmin" class="border-t border-gray-200" >
                <NavLink  :href="route(WorkspaceMenu.multipleWorkspacesOptions.route, workspace )"
                      class="flex items-center group">
                    <Icon :name="WorkspaceMenu.multipleWorkspacesOptions.icon" class="ml-4 w-4 h-4 mr-2 fill-white group-hover:fill-cyan-600"/>
                    <span class="text-white  group-hover:text-cyan-600"> {{ WorkspaceMenu.multipleWorkspacesOptions.name }}</span>
                </NavLink>
            </li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
