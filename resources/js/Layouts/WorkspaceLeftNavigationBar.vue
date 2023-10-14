<script setup>

import {Link, usePage} from '@inertiajs/vue3';
import Icon from '@/Components/Icon.vue';
import {useWorkspaceMenuStore} from "@/Stores/WorkspaceMenuStore.js";

const {company, companiesCount} = defineProps({
    company: {
        type: Object,
    },
    companiesCount: {
        type: Number,
    },
});

const WorkspaceMenu = useWorkspaceMenuStore();

const page = usePage()
const isSuperUser = () => page.props.auth.user.id === 1;
const hasMultipleCompanies = (companiesCount) => companiesCount > 1;
const user = page.props.auth.user;

WorkspaceMenu.setUser(user);
WorkspaceMenu.setCompaniesCount(companiesCount);
WorkspaceMenu.initializeOptions();

</script>
<template>
    <nav class="flex-shrink-0 hidden md:block w-56 p-12 bg-cyan-600">
        <ul>
            <li v-for="option in WorkspaceMenu.options" :key="option.route">
                <div class="mb-4">
                    <Link v-if="option.active" :href="route(option.route, { company: company.id })"
                          class="flex items-center group py-3">
                        <Icon :name="option.icon" class="w-6 h-6 mr-2 fill-gray-300 group-hover:fill-white"/>
                        <span class="text-gray-300 group-hover:text-white"> {{ option.name }}</span>
                    </Link>
                </div>
            </li>
        </ul>
    </nav>
</template>


<style scoped>

</style>
