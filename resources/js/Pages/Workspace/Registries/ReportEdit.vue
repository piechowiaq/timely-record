<script setup>

import {reactive} from 'vue'
import {useRemember, useForm, router} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import WorkspaceBanner from "@/Components/WorkspaceBanner.vue"

const props = defineProps({
    report: Object,
    company: Object,
    registry: Object,
})

const form = useForm(useRemember(reactive({
        notes: props.report.notes,
        report_date: props.report.report_date,
        registry_id: props.registry.id,
        company_id: props.company.id,
    }))
)

const update = () => {
    form.put(route('workspace.registry.reports.update', [props.company, props.registry, props.report]));
};

const destroy = (report) => {
    router.delete(route('workspace.registry.reports.destroy', [props.company, props.registry, report]))
};
</script>

<template>
    <WorkspaceLayout :company="company">
        <WorkspaceBanner :href="route('workspace.registries.index', company)" :name="registry.name"/>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update">

                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <TextInput type="date" v-model="form.report_date" :error="form.errors.report_date"
                               class="pb-8 pr-6 w-full lg:w-1/2"
                               label="Date of the report"/>
                    <TextInput v-model="form.notes" :error="form.errors.notes" class="pb-8 pr-6 w-full lg:w-1/2"
                               label="Notes"/>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <PrimaryButton v-if="!report.deleted_at" value="Delete"
                                   @click.once="destroy(report)" tabindex="-1"
                                   type="button" class="text-red-600 hover:underline">Delete Report
                    </PrimaryButton>
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Edit Registry
                    </PrimaryButton>
                </div>

            </form>
        </div>
    </WorkspaceLayout>
</template>


