<script setup>
import {defineComponent, reactive, ref} from 'vue'
import {useRemember, useForm, Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue"
import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    roles: Array,
    errors: Object,
    companies: Array,

})

const form = useForm(useRemember(reactive({
    first_name: null,
    last_name: null,
    email: null,
    phone: null,
    password: null,
    password_confirmation: null,
    role_id: '',
    company_ids: [],
    }))
)

const store = () => {
    form.post(route('users.store'));
};



</script>



<template>

    <AdminLayout>

        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold mb-2">
                <Link :href="route('users.index')" class="text-cyan-600">Users </Link>
                <p class="text-gray-600">&nbsp|&nbspCreate</p>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="store">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
                        <TextInput v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last Name" />
                        <TextInput v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                        <SelectInput v-model="form.role_id" :error="form.errors.role_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Role">
                            <option :value="null" />
                            <option v-for="(role, id) in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </SelectInput>
                        <SelectInput v-model="form.company_ids" multiple :error="form.errors.company_ids" class="pb-8 pr-6 w-full lg:w-1/2" label="Companies">
                            <option v-for="(company, id) in companies" :key="company.id" :value="company.id" >{{ company.name }}</option>
                        </SelectInput>
                        <TextInput v-model="form.password" :error="form.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" label="Password" />
                        <TextInput v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="pr-6 pb-8 w-full lg:w-1/2" label="Password Confirmation" />
                    </div>
                    <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                        <PrimaryButton :loading="form.processing" class="btn-indigo" type="submit">Create User</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>

    </AdminLayout>
</template>




