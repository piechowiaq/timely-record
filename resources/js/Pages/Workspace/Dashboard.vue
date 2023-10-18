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
    <div class="md:flex space-x-2">
        <div class="md:w-1/4">
            <div class="border border-cyan-600 py-2 px-3 font-bold text-gray-600 mt-2">
                <div class="justify-between flex border-b">
                    <p class="text-sm  pb-2">Registries</p>
                    <p class="text-xs bg-green-600 text text-white border-b pb-2">VERY GOOD</p>
                </div>

                <div class="flex justify-between">
                    <p class="text-xl py-2">85%</p>
                    <div class="py-2">
                        <p class="text-xs ">8 <span class="text-green-600">valid</span></p>
                        <p class="text-xs ">18 <span class="text-red-600">expired</span></p>

                    </div>


                </div>

                <div class="text-xs py-2">
                    <h1>Most Outdated:</h1>
                    <ul class="text-cyan-600">
                        <li>Kontrola okresowa stanu technicznego obiektu</li>
                        <li>Kontrola okresowa stanu technicznego obiektu</li>
                        <li>Kontrola okresowa stanu technicznego obiektu</li>
                    </ul>
                </div>
                <div class="text-xs py-2">
                    <h1>Recently updated:</h1>
                    <ul class="text-cyan-600">
                        <li>Kontrola okresowa stanu technicznego obiektu</li>
                        <li>Kontrola okresowa stanu technicznego obiektu</li>
                        <li>Kontrola okresowa stanu technicznego obiektu</li>
                    </ul>
                </div>
            </div>
<!--            <DoughnutChart :chart-data="chartDataRegistries" class="w-full p-8"/>-->
        </div>

    </div>



</WorkspaceLayout>

</template>
