<template>

    <AdminLayout>

        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold mb-2">
                <Link :href="route('roles.index')" class="text-cyan-600">Roles </Link>
                <p class="text-gray-600">&nbsp|&nbspCreate</p>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name a role" />
                        <SelectInput v-model="form.permission_ids" multiple :error="form.errors.permission_ids" class="pb-8 pr-6 w-full lg:w-1/2" label="Permissions">
                            <option v-for="(permission, id) in permissions" :key="permission.id" :value="permission.id" >{{ permission.name }}</option>
                        </SelectInput>
                    </div>
                    <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                        <PrimaryButton :loading="form.processing" class="btn-indigo" type="submit">Create Role</PrimaryButton>
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
import SelectInput from "@/Components/SelectInput.vue";




export default defineComponent({

    components: {
        Link,
        AdminLayout,
        TextInput,
        PrimaryButton,
        SelectInput

    },
    props:{
        permissions: Array,
        errors: Object
    },
    setup () {
        const form = useForm(useRemember(
            reactive({
                name: null,
                permission_ids: [],
            },)))

        return { form }
    },
    methods:{
        store() {
            this.form.post(this.route('roles.store'))
        }
    }
});

</script>



