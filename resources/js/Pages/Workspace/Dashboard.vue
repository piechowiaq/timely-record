<script setup>

import { Head, Link } from '@inertiajs/vue3';
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";

defineOptions({ layout: WorkspaceLayout })

const props = defineProps({
    company: {
        type: Object,
        required: true,
    },
});


</script>

<template>



    <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold">
        <p>{{company.name}}Dashboard</p>
    </div>

    <p>Company Dashboard</p>


</template>
