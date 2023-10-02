<template>

    <WorkspaceLayout :company="company" :companies-count="companiesCount">
        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold mb-2">
                <Link :href="route('registries.index')" class="text-cyan-600">Registries </Link>
                <p class="text-gray-600">&nbsp|&nbspCreate</p>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput type="date" v-model="form.report_date" :error="form.errors.report_date" class="pb-8 pr-6 w-full lg:w-1/2"
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
        </div>

        </WorkspaceLayout>




</template>

<script>

import { defineComponent, computed ,reactive } from 'vue'
import { Link, Head, usePage, useRemember, useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"


export default defineComponent({

    components: {
        Link,
        TextInput,
        PrimaryButton,
        WorkspaceLayout
    },
    props: {
        company: Object,
        registry: Object,
        companies: Object,
        companiesCount: Number,
    },


    setup({registry, company}) {
        const form = useForm(useRemember(
            reactive({
                notes: null,
                report_date: null,
                registry_id: registry.id,
                company_id: company.id,
            })))
        const user = computed(() => usePage().props.value.auth.user)
        return {form, user}
    },


    methods: {
        store() {
            this.form.post(this.route('workspace.registry.reports.store', [this.company, this.registry]))
        },
    },


})
</script>
