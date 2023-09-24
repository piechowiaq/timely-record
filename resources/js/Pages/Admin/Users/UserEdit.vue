<script setup>
import {defineComponent, reactive} from 'vue'
import {useRemember, useForm, Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue"
import TextInput from "@/Components/TextInputPing.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TrashedMessage from "@/Components/TrashedMessage.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { router } from '@inertiajs/vue3'

defineOptions({ layout: AdminLayout })

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    role_id: {
        type: Number,
        required: false,
    },
    roles: {
        type: Array,
        required: true,
    },
    errors: {
        type: Object,
        required: true,
    },
    companies: {
        type: Array,
        required: true,
    },
    company_ids: {
        type: Array,
        required: true,
    }
});

const form = useForm(useRemember(
    reactive({
        name: props.user.name,
        last_name: props.user.last_name,
        email: props.user.email,
        phone: props.user.phone,
        password: props.user.password,
        password_confirmation: props.user.password,
        role_id: props.role_id,
        company_ids: props.company_ids,
})));

const formSecond = useForm({});

const  update = () => {
    form.put(route('users.update', props.user), {
        onFinish: () => form.reset('password_confirmation', 'password'),
    });
};

const  sendRegistrationLink = () => {
    formSecond.post(route('registration.send', props.user));
};

const destroy = (user) => {
    router.delete(route('users.destroy', user))
};

const restore = (user) => {
    router.put(route('users.restore', user))
};

</script>
<template>

            <div class="bg-gray-100 py-2 px-3 h-12 items-center justify-between flex font-bold mb-2">
                <div class="flex">
                    <Link :href="route('users.index')" class="text-cyan-600">Users </Link>
                    <p class="text-gray-600">&nbsp|&nbspEdit</p>
                </div>
                <TrashedMessage v-if="user.deleted_at" @restore="restore(user)"> This company has been
                    deleted.
                </TrashedMessage>
                <form v-if="user.id !== 1 && !user.deleted_at" @submit.prevent="sendRegistrationLink">
                    <PrimaryButton :class="{ 'opacity-25': formSecond.processing }" :disabled="formSecond.processing" class="mx-2">
                        Resend Verification Email
                    </PrimaryButton>
                </form>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">

                <form @submit.prevent="update()">
                    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <TextInput v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2"
                                    label="First Name"/>
                        <TextInput v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2"
                                    label="Email"/>
                        <SelectInput v-model="form.role_id" :error="form.errors.role_id"
                                      class="pb-8 pr-6 w-full lg:w-1/2" label="Role">
                            <option :value="null"/>
                            <option v-for="(role, id) in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </SelectInput>
                        <SelectInput v-model="form.company_ids" multiple :error="form.errors.company_ids"
                                      class="pb-8 pr-6 w-full lg:w-1/2" label="Companies">
                            <option v-for="(company, id) in companies" :key="company.id" :value="company.id">
                                {{ company.name }}
                            </option>
                        </SelectInput>
                        <TextInput v-model="form.password" id="password" :error="form.errors.password"
                                    class="pr-6 pb-8 w-full lg:w-1/2" label="Password"/>
                        <TextInput id="password_confirmation" v-model="form.password_confirmation" :error="form.errors.password_confirmation"
                                    class="pr-6 pb-8 w-full lg:w-1/2" label="Password Confirmation"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                        <PrimaryButton v-if="user.id !== 1 && !user.deleted_at" value="Delete"
                                @click.once="destroy(user)" tabindex="-1" type="button"
                                >Delete Contact
                        </PrimaryButton>


                     <PrimaryButton v-if="user.id !== 1" :loading=" form.processing" class="btn-indigo ml-auto" type="submit">Edit User
                        </PrimaryButton>
                    </div>
                </form>

            </div>



</template>
