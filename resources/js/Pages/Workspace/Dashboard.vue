<script setup>


import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";

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


<WorkspaceLayout :company="company" :companies-count="companiesCount">
    <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold">
        <p>Dashboard</p>
    </div>

    <p>Company Dashboard</p>
</WorkspaceLayout>

</template>
