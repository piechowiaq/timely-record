<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Icon from "@/Components/Icon.vue";
import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import WorkspaceLeftNavigationBar from '@/Layouts/WorkspaceLeftNavigationBar.vue';

import WorkspaceLogo from "@/Components/WorkspaceLogo.vue";
import {ref} from "vue";

const showingNavigationDropdown = ref(false);


const props = defineProps({
    project: {
        type: Object,
        required: true,
    },
})

const form = useForm({
    name: '',
    location: '',
    project_id: props.project.id
});

const submit = () => {
    form.post(route('workspaces.store'));
};

</script>

<template>
    <WorkspaceLayout>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name"/>

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="location" value="Location"/>

                        <TextInput
                            id="location"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.location"
                            required
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.location"/>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            Create Workspace
                        </PrimaryButton>
                    </div>
                </form>
         </WorkspaceLayout>
</template>

