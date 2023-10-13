<script setup>

import {Link} from '@inertiajs/vue3';
import Icon from '@/Components/Icon.vue';

defineProps({
    company: {
        type: Object,
    },
    companiesCount: {
        type: Number,
    },
    menuOptions: {
        type: Object,
    }
});

</script>
<template>
    <nav class="flex-shrink-0 hidden md:block w-56 p-12 bg-cyan-600">
        <ul>
            <li v-for="option in menuOptions" :key="option.route">
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
