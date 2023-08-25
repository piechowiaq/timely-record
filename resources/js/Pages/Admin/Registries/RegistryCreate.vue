<template>

    <AdminLayout>

        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold mb-2">
                <Link :href="route('registries.index')" class="text-cyan-600">Registries </Link>
                <p class="text-gray-600">&nbsp|&nbspCreate</p>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Registry Name"/>
                        <TextInput v-model="form.valid_for" :error="form.errors.valid_for" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Valid for | months"/>


                        <TextArea v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full "
                                   label="Description"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Send
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>

    </AdminLayout>
</template>

<script>
import {defineComponent, reactive, ref} from 'vue'
import {useRemember, useForm, Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue"

import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";


import _ from "lodash";
import TextArea from "@/Components/TextArea.vue";


export default defineComponent({
    name: 'Admin/Companies/Create',
    components: {
        TextArea,
        Link,
        AdminLayout,
        TextInput,
        PrimaryButton,
        SelectInput

    },


    props: {
        registries: Array
    },
    computed: {
        orderedRegistries: function () {
            return _.orderBy(this.registries, 'name')
        }
    },

    setup() {
        const form = useForm(useRemember(
            reactive({
                name: null,
                city: null,
                email: null,
                phone: null,
                registry_ids: []
            })))

        return {form}
    },
    methods: {
        store() {
            this.form.post(this.route('companies.store'))
        },
        onToRight() {

            let select = this.$refs["form-registry_ids"].value
            if (select !== "") {
                this.form.registry_ids.push({id: select})
                let del = this.registries.indexOf({id: select})
                this.registries.splice(del, 1)


            }

        },
        onToLeft() {
            let select = this.$refs["registries"].value
            if (select !== "") {
                this.registries.push({id: select})
                let del = this.form.registry_ids.indexOf({id: select})
                this.form.registry_ids.splice(del, 1)

            }

        }

    },
});

</script>



