<script setup>

import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";
import RegistriesCard from "@/Components/RegistriesCard.vue"
import TrainingsCard from "@/Components/TrainingsCard.vue";

const props = defineProps({
    company: {
        type: Object,
    },
    mostOutdatedRegistries: {
        type: Array,
    },
    recentlyUpdatedRegistries: {
        type: Array,
    },
    countOfUpToDateRegistries: {
        type: Number
    },
    countOfExpiredRegistries: {
        type: Number
    },
    percentageOfUpToDate: {
        type: Number
    }
});

</script>

<template>

    <WorkspaceLayout :company="company">
        <section class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold text-cyan-600">
            <h1>Dashboard</h1>

        </section>

        <div class="sm:flex sm:space-x-2">

            <!-- Registries Section -->

            <RegistriesCard :percentageOfUpToDate="percentageOfUpToDate"
                            :countOfUpToDateRegistries="countOfUpToDateRegistries"
                            :countOfExpiredRegistries="countOfExpiredRegistries"
                            :mostOutdatedRegistries="mostOutdatedRegistries"
                            :recentlyUpdatedRegistries="recentlyUpdatedRegistries" class=" sm:w-1/2 "/>




            <!-- Trainings Section -->
            <TrainingsCard class="sm:w-1/2"/>

        </div>

    </WorkspaceLayout>

</template>
