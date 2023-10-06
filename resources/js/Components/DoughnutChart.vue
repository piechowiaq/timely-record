<template>


    <Doughnut :data="chartData"  />

</template>

<script>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip,  BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'

ChartJS.register(Title, Tooltip,  BarElement, CategoryScale, LinearScale, ArcElement)

export default {

    components: {  Doughnut },
    props: {
        chartData: Object,

    }
}
</script>
