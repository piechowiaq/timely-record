<script setup>

import {reactive} from 'vue'
import {useRemember, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import WorkspaceBanner from "@/Components/WorkspaceBanner.vue"

const props = defineProps({
    company: Object,
    registry: Object,
    companies: Object,

})

const form = useForm(useRemember(reactive({
        notes: null,
        report_date: null,
        registry_id: props.registry.id,
        company_id: props.company.id,
    }))
)

const store = () => {
    form.post(route('workspace.registry.reports.store', [props.company, props.registry]));
};

</script>

<template>
    <WorkspaceLayout :company="company">
        <WorkspaceBanner :href="route('workspace.registries.index', company)" :name="'Create Report'"/>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="store">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <TextInput type="date" v-model="form.report_date" :error="form.errors.report_date"
                               class="pb-8 pr-6 w-full lg:w-1/2"
                               label="Date of the report"/>
                    <TextInput v-model="form.notes" :error="form.errors.notes" class="pb-8 pr-6 w-full lg:w-1/2"
                               label="Notes"/>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create Registry
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </WorkspaceLayout>
</template>


