<template>

    <Head title="Registries" />

    <WorkspaceLayout :company="company" :companies-count="companiesCount">


        <div class="bg-gray-100 py-2 px-3 h-12 items-center flex  justify-between font-bold mb-2">
            <p class="text-gray-600">Registries</p>    <FlashMessages />
        </div>


        <div class="mb-6 flex justify-between items-center">
            <Search v-model="form.search" v-model:trashed="form.trashed" @reset="reset"
                    class="flex items-center w-full max-w-md mr-4"/>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4 w-2/3 flex" @click="sort('name')">
                        Nazwa przeglądu

                        <icon name="sorting" class="block m-auto ml-2 text-gray-300"/>

                    </th>
                    <th class="px-6 pt-6 pb-4"></th>
                    <th colspan="2" class="px-6 pt-6 pb-4 flex" @click="sort('expiry_date')">
                        Wygasa za

                        <icon name="sorting" class="block m-auto ml-2 text-gray-300 "/>


                    </th>
                    <th class="px-6 pt-6 pb-4">Pobierz</th>
                    <th class="px-6 pt-6 pb-4"></th>
                </tr>
                <tr v-for="registry of registries.data" :key="registry.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100">

                    <td class="border-t">
                        <Link value="Edit"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"

                              class="px-6 py-3 flex items-center focus:text-indigo-500">{{
                            registry.name
                            }}
                        </Link>
                    </td>
                    <td class="border-t w-px">
                        <div v-if="expired(daysLeftUntilExpiryDate(registry.expiry_date))">
                            <icon name="expired" class="block m-auto text-red-500 h-6 w-6"/>
                        </div>
                    </td>
                    <td class="border-t">
                        <Link value="Edit"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class="px-6 py-3 flex items-center focus:text-indigo-500">
                            {{ daysLeftUntilExpiryDate(registry.expiry_date) }} dni
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link value="Edit"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class="pr-6 py-3 w-auto flex items-center text-sm text-gray-300 focus:text-indigo-500">
                            {{ registry.expiry_date }}
                        </Link>
                    </td>
                    <td class="border-t">
                        <Link value="Edit" v-if="! expired(daysLeftUntilExpiryDate(registry.expiry_date))"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              class=" hover:bg-indigo-300 px-6 py-3 flex items-center focus:text-indigo-500">

                            <icon name="download" class="block m-auto h-6 w-6 "/>

                        </Link>
                        <icon v-else name="download" class="text-gray-300 block m-auto h-6 w-6 "/>

                    </td>
                    <td class="border-t">
                        <Link class="flex items-center px-4"
                              :href="route('workspace.registries.show', [registry.company_id, registry.registry_id])"
                              tabindex="-1">
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



    </WorkspaceLayout>

</template>


<script>
import {defineComponent} from 'vue'
import {debounce, mapValues} from "lodash"
import { Link, Head } from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue"
import Pagination from '@/Components/Pagination.vue'
import Search from "@/Components/Search.vue"
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue"
import FlashMessages from "@/Components/FlashMessages.vue";


export default defineComponent({

    components: {
        WorkspaceLayout,
        Link,
        Pagination,
        Icon,
        Search,
        FlashMessages,
        Head
    },
    props: {
        company: Object,
        registries: Object,
        filters: Object,
        companiesCount: Number,
        countOfUpToDateRegistries: Number,
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
                this.$inertia.get(this.route('workspace.registries.index', this.company), this.form, {preserveState: true, replace: true})
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
        sort(field) {
            this.form.field = field;
            this.form.direction = this.form.direction === 'asc' ? 'desc' : 'asc';
        },
        expired(registry) {
            return registry <= 0
        },
        daysLeftUntilExpiryDate(expiry_date) {

            const today = new Date();
            const expiryDate = new Date(!expiry_date ? today : expiry_date);
            const diffTime = expiryDate - today;
            return Math.ceil(diffTime / (1000 * 60 * 60 * 24))
        },


    },

})
</script>


