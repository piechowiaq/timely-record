<script setup>


import WorkspaceLayout from "@/Layouts/WorkspaceLayout.vue";
import {ref, computed} from "vue";
import DoughnutChart from "@/Components/DoughnutChart.vue";

const props = defineProps({
    company: {
        type: Object,
    },
    companiesCount: {
        type: Number,
    },
    registries: {
        type: Object,
    },
    countOfUpToDateRegistries: {
        type: Number
    }
});


const chartDataRegistries = ref({
    labels: ['Aktualne', 'Nieaktualne'],
    datasets: [
        {
            label: 'Registries',
            backgroundColor: ['#9ae6b4', '#FEB2B2',],
            data: [props.countOfUpToDateRegistries, props.registries.total - props.countOfUpToDateRegistries ],
            borderWidth: 0
        }
    ],
});

const chartOptions =ref({
        cutout: 75,
});

const width =  ref(120)

const height =  ref(100)


</script>

<template>


<WorkspaceLayout :company="company" :companies-count="companiesCount">
    <div class="bg-gray-100 py-2 px-3 h-12 items-center flex font-bold text-cyan-600">
        <p>Dashboard</p>
    </div>
    <div class="md:flex  space-x-2">
        <div class="md:w-1/4">
            <div class="border border-cyan-600 py-2 px-3 h-12 items-center flex font-bold text-gray-600 mt-2">
                <p>Registries</p>
            </div>
            <DoughnutChart :chart-data="chartDataRegistries" class="w-full p-8"/>
        </div>

        <div class="md:w-1/4">
            <div class="border border-cyan-600 py-2 px-3 h-12 items-center flex font-bold text-gray-600 mt-2">
                <p >Dashboard</p>
            </div>
            <DoughnutChart :chart-data="chartDataRegistries" class="w-full p-8"/>
        </div>
        <div class="md:w-1/4">
            <div class="border border-cyan-600 py-2 px-3 h-12 items-center flex font-bold text-gray-600 mt-2">
                <p>Dashboard</p>
            </div>
            <DoughnutChart :chart-data="chartDataRegistries" class="w-full p-8"/>
        </div>
        <div class="md:w-1/4">
            <div class="border border-cyan-600 py-2 px-3 h-12 items-center flex font-bold text-gray-600 mt-2">
                <p>Dashboard</p>
            </div>
            <DoughnutChart  :chart-data="chartDataRegistries" class="w-full p-8"/>
        </div>
    </div>

    <div class="w-1/4">

    </div>


</WorkspaceLayout>

</template>
