<template>

    <AdminLayout>

        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold mb-2">
                <Link :href="route('permissions.index')" class="text-cyan-600">Permissions </Link>
                <p class="text-gray-600">&nbsp|&nbspCreate</p>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full" label="Permission Name" />
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
                        <PrimaryButton :loading="form.processing" class="btn-indigo" type="submit">Create Permission</PrimaryButton>
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


export default defineComponent({

    components: {
        Link,
        AdminLayout,
        TextInput,
        PrimaryButton,

    },
    setup () {
        const form = useForm(useRemember(
            reactive({
                    name: null,
                }
            )))
        return { form }
    },
    methods:{
        store() {
            this.form.post(this.route('permissions.store'))
        },
    },
});

</script>



