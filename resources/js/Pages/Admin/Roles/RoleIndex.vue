<template>

    <Head title="Roles" />

    <AdminLayout>
        <div class="bg-gray-100 py-2 px-3 h-12 items-center flex  justify-between font-bold mb-2">
            <p class="text-gray-600">Roles</p>    <FlashMessages />
        </div>


        <div class="mb-6 flex justify-between items-center">
            <Search v-model="form.search" v-model:trashed="form.trashed" @reset="reset"
                    class="flex items-center w-full max-w-md mr-4"/>
            <Link :href="route('roles.create')">
                Create Role
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                </tr>
                <tr v-for="role of roles.data"  :key="role.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <Link value="Edit" :href="route('roles.edit', role )" class="px-6 py-4 flex items-center focus:text-indigo-500">{{ role.name }}</Link>
                    </td>
                    <td class="w-px border-t">
                        <Link class="flex items-center px-4" :href="route('roles.edit', role)" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                        </Link>
                    </td>
                </tr>
                <tr v-if="roles.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No roles found.</td>
                </tr>
            </table>
        </div>

        <Pagination :links="roles.links" class="flex flex-wrap py-6"></Pagination>

    </AdminLayout>

</template>


<script>
import {defineComponent} from 'vue'
import {debounce, mapValues} from "lodash"
import { Link, Head } from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue"
import Pagination from '@/Components/Pagination.vue'
import Search from "@/Components/Search.vue"
import AdminLayout from "@/Layouts/AdminLayout.vue"
import FlashMessages from "@/Components/FlashMessages.vue";

export default defineComponent({

    components: {
        AdminLayout,
        Link,
        Pagination,
        Icon,
        Search,
        FlashMessages,
        Head
    },

    props:{
        roles: Object,
        filters: Object,
    },
    data() {
        return {
            isOpen: false,
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: debounce(function () {
                this.$inertia.get(this.route('roles.index'), this.form, { preserveState: true , replace: true})
            }, 150),
        },
    },
    methods:{
        destroy(role) {
            this.$inertia.delete(this.route('roles.destroy', role))
        },
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
})
</script>


