<template>

    <Head title="Registries" />

    <AdminLayout>



        <div class="bg-gray-100 py-2 px-3 h-12 items-center flex  justify-between font-bold mb-2">
            <p class="text-gray-600">Registries</p>    <FlashMessages />
        </div>


        <div class="mb-6 flex justify-between items-center">
            <Search v-model="form.search" v-model:trashed="form.trashed" @reset="reset"
                    class="flex items-center w-full max-w-md mr-4"/>
            <Link :href="route('registries.create')">
                Create Registry
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                    <th class="px-6 pt-6 pb-4">Valid for | months</th>
                </tr>
                <tr v-for="registry of registries.data" :key="registry.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <Link value="Edit" :href="route('registries.edit', registry)"
                              class="px-6 py-4 flex items-center focus:text-indigo-500">{{ registry.name }}
                        </Link>
                    </td>

                    <td class="border-t">
                        <Link value="Edit" :href="route('registries.edit', registry)"
                              class="px-6 py-4 flex items-center focus:text-indigo-500">{{ registry.valid_for }}
                        </Link>
                    </td>
                    <td class="w-px border-t">
                        <Link class="flex items-center px-4" :href="route('registries.edit', registry)" tabindex="-1">
                            <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400"/>
                        </Link>
                    </td>
                </tr>
                <tr v-if="registries.length === 0">
                    <td class="px-6 py-4 border-t" colspan="4">No registries found.</td>
                </tr>
            </table>
        </div>

        <Pagination :links="registries.links" class="flex flex-wrap py-6"></Pagination>

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
    name: 'Admin/Registries/Index',
    components: {
        AdminLayout,
        Link,
        Pagination,
        Icon,
        Search,
        FlashMessages,
        Head
    },
    props: {
        registries: Object,
        filters: Object
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
                this.$inertia.get(this.route('registries.index'), this.form, {preserveState: true, replace: true})
            }, 150),
        },
    },
    methods: {
        destroy(registry) {
            this.$inertia.delete(this.route('registries.destroy', registry))
        },
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },

})
</script>


