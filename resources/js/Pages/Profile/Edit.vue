<script setup>

import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";
import FlashMessages from "@/Components/FlashMessages.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    company: {
        type: Object,
    },
    workspacesCount: {
        type: Number,
    },
});
</script>

<template>
    <Head title="Profile" />

    <WorkspaceLayout :company="company" :workspacesCount="workspacesCount">
        <div class="bg-gray-100 py-2 px-3 h-12 items-center flex  justify-between font-bold mb-2">
            <p class="text-gray-600">Profile</p>    <FlashMessages />
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

            </div>
        </div>
    </WorkspaceLayout>
</template>
