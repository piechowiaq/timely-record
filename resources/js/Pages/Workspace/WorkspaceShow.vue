<script setup>
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";

defineProps({
    workspace: {
        type: Object,
        required: true
    },
    workspacesCount: Number
})

</script>

<template>

<WorkspaceLayout :workspace="workspace" :workspacesCount="workspacesCount" >Hello

{{workspacesCount}}</WorkspaceLayout>

</template>

