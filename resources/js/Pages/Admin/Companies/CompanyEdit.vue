<template>

    <AdminLayout>
        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center justify-between flex font-bold mb-2">
                <div class="flex">
                    <Link :href="route('companies.index')" class="text-cyan-600">Companies </Link>
                    <p class="text-gray-600">&nbsp|&nbspEdit</p>
                </div>
                <TrashedMessage v-if="company.deleted_at" @restore="restore(company)"> This company has been
                    deleted.
                </TrashedMessage>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Name"/>
                        <TextInput v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="City"/>
                        <TextInput v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company E-mail"/>
                        <TextInput v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Company Phone"/>
                    </div>

                    <div class="p-8">
                        <p>Registries:</p>
                        <table class="table-auto w-full text-sm">
                            <thead class="border-b">
                            <tr>
                                <th class="">Name:</th>
                                <th class="">Duration in months:</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="registry in orderedRegistries" :key="registry.id"
                                class="">
                                <td class="border-r lg:w-1/2">
                                    <input type="checkbox" v-model="form.registry_ids" :value="registry.id"
                                           :id="registry.id" class="mr-6 ">
                                    <label :for="registry.id">{{ registry.name }}</label>
                                </td>
                                <td class="text-center lg:w-1/2">
                                    <p>{{ registry.valid_for }}</p>
                                </td>
                            </tr>
                            <tr v-if="registries.length === 0">
                                <td class="" colspan="4">No registries found.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <PrimaryButton v-if="company.id !== 1 || company.id !== 1 && !company.deleted_at" value="Delete"
                                @click.once="destroy(company)" tabindex="-1"
                                type="button" class="text-red-600 hover:underline">Delete Company
                        </PrimaryButton>
                        <PrimaryButton :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit
                            Company
                        </PrimaryButton>
                    </div>

                </form>
            </div>
        </div>
    </AdminLayout>

</template>

<script>
import {defineComponent, reactive} from 'vue'
import {useRemember, useForm, Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue"
import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TrashedMessage from "@/Components/TrashedMessage.vue";
import _ from "lodash";

export default defineComponent({

    components: {
        AdminLayout,
        Link,
        TextInput,
        PrimaryButton,
        TrashedMessage
    },
    props: {
        company: Object,
        errors: Object,
        registries: Object,
        registry_ids: Array
    },
    computed: {
        orderedRegistries: function () {
            return _.orderBy(this.registries, 'name')
        }
    },

    setup({company, registry_ids}) {
        const form = useForm(useRemember(
            reactive({
                name: company.name,
                city: company.city,
                email: company.email,
                phone: company.phone,
                registry_ids: registry_ids
            })))

        return {form}

    },
    methods: {
        update() {
            this.form.put(this.route('companies.update', this.company.id))
        },
        destroy(company) {
            this.$inertia.delete(this.route('companies.destroy', company))
        },
        restore(company) {
            this.$inertia.put(this.route('companies.restore', company))
        },
    },

});

</script>



