<template>

    <AdminLayout>
        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center justify-between flex font-bold mb-2">
                <div class="flex">
                    <Link :href="route('registries.index')" class="text-cyan-600">Registries </Link>
                    <p class="text-gray-600">&nbsp|&nbspEdit</p>
                </div>
                <TrashedMessage v-if="registry.deleted_at" @restore="restore(registry)"> This registry has been
                    deleted.
                </TrashedMessage>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Registry Name"/>
                        <TextInput v-model="form.valid_for" :error="form.errors.valid_for" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="Valid for | months"/>
                        <TextArea v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full "
                                   label="Description"/>

                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <PrimaryButton v-if="!registry.deleted_at" value="Delete" @click.once="destroy(registry)" tabindex="-1"
                                type="button" class="text-red-600 hover:underline">Delete Registry
                        </PrimaryButton>
                        <PrimaryButton :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit
                            Registry
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
import TextArea from "@/Components/TextAreaPing.vue";

export default defineComponent({

    components: {
        TextArea,
        AdminLayout,
        Link,
        TextInput,
        PrimaryButton,
        TrashedMessage
    },
    props: {
        registry: Object,
        errors: Object
    },
    computed: {
        orderedRegistries: function () {
            return _.orderBy(this.registries, 'name')
        }
    },

    setup({registry}) {
        const form = useForm(useRemember(
            reactive({
                name: registry.name,
                description: registry.description,
                valid_for: registry.valid_for,
            })))

        return {form}

    },
    methods: {
        update() {
            this.form.put(this.route('registries.update', this.registry.id))
        },
        destroy(registry) {
            this.$inertia.delete(this.route('registries.destroy', registry))
        },
        restore(registry) {
            this.$inertia.put(this.route('registries.restore', registry))
        },
    },


});

</script>



