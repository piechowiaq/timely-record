<template>

    <AdminLayout>
        <div>
            <div class="bg-gray-100 py-2 px-3 h-12 items-center justify-between flex font-bold mb-2">
                <div class="flex">
                    <Link :href="route('users.index')" class="text-cyan-600">Users </Link>
                    <p class="text-gray-600">&nbsp|&nbspEdit</p>
                </div>
                <TrashedMessage v-if="user.deleted_at" @restore="restore(user)"> This company has been
                    deleted.
                </TrashedMessage>
            </div>

            <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                <form @submit.prevent="update">
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
                        <TextInput v-model="form.password" :error="form.errors.password"
                                    class="pr-6 pb-8 w-full lg:w-1/2" label="Password"/>
                        <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation"
                                    class="pr-6 pb-8 w-full lg:w-1/2" label="Password Confirmation"/>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                        <PrimaryButton v-if="user.id !== 1 || user.id !== 1 && !user.deleted_at" value="Delete"
                                @click.once="destroy(user)" tabindex="-1" type="button"
                                class="text-red-600 hover:underline">Delete Contact
                        </PrimaryButton>

                        <form @submit.prevent="send">
                                <PrimaryButton :class="{ 'opacity-25': form2.processing }" :disabled="form2.processing">
                                    Resend Verification Email
                                </PrimaryButton>
                        </form>


                     <PrimaryButton v-if="user.id !== 1" :loading=" form.processing" class="btn-indigo ml-auto" type="submit">Edit User
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
import SelectInput from "@/Components/SelectInput.vue";

export default defineComponent({

    components: {
        SelectInput,
        AdminLayout,
        Link,
        TextInput,
        PrimaryButton,
        TrashedMessage
    },
    props: {
        roles: Array,
        user: Object,
        role_id: Number,
        errors: Object,
        companies: Array,
        company_ids: Array
    },

    setup({user, role_id, company_ids}) {
        const form = useForm(useRemember(
            reactive({
                name: user.name,
                last_name: user.last_name,
                email: user.email,
                phone: user.phone,
                password: user.password,
                password_confirmation: user.password,
                role_id: role_id,
                company_ids: company_ids,
            },)))

        const form2 = useForm({ user: user})

        return {form, form2}
    },



    methods: {
        update() {
            this.form.put(this.route('users.update', this.user.id))
        },
        destroy(user) {
            this.$inertia.delete(this.route('users.destroy', user))
        },
        restore(user) {
            this.$inertia.put(this.route('users.restore', user))
        },
        send() {
            this.form2.post(this.route('user.link', this.user.id))
        }
    },


});

</script>



