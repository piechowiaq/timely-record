<template>

    <AdminLayout>
        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center justify-between flex font-bold mb-2">
                <div class="flex">
                    <Link :href="route('permissions.index')" class="text-cyan-600">Permissions </Link>
                    <p class="text-gray-600">&nbsp|&nbspEdit</p>
                </div>
                <TrashedMessage v-if="permission.deleted_at" @restore="restore(permission)"> This permission has been
                    deleted.
                </TrashedMessage>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full"
                                    label="Permission Name"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <PrimaryButton v-if="!permission.deleted_at" value="Delete" @click.once="destroy(permission)" tabindex="-1" type="button"
                                class="text-red-600 hover:underline">Delete Permission
                        </PrimaryButton>
                        <PrimaryButton :loading="form.processing" class="btn-indigo ml-auto" type="submit">Edit
                            Permission
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


export default defineComponent({

    components: {
        AdminLayout,
        Link,
        TextInput,
        PrimaryButton,
        TrashedMessage
    },
    props: {
        permission: Object,
    },
    setup({permission}) {
        const form = useForm(useRemember(reactive({
            name: permission.name,
        })))

        return {form}

    },
    methods: {
        update() {
            this.form.put(this.route('permissions.update', this.permission.id))
        },
        destroy(permission) {
            this.$inertia.delete(this.route('permissions.destroy', permission))
        },
        restore(permission) {
            this.$inertia.put(this.route('permissions.restore', permission))
        },
    },

});

</script>



