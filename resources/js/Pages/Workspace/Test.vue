<script setup>



defineProps({
    company: Object,
})


</script>


<template>


        <div class="flex flex-col h-screen">
            <div class="flex">

                <div class="flex flex-shrink-0 w-56">
                    {{ company }}
                </div>

                <div class="flex w-full">

                    Menu Top
                </div>
            </div>

            <div class="flex flex-grow overflow-hidden">
                <div class="flex-shrink-0 w-56">
                   Menu Side

                </div>

                <div class="flex-1 overflow-y-auto" >
                    Content
                </div>
            </div>
        </div>









<!--    <div class="bg-red-500 h-screen">-->
<!--        <div class="flex bg-orange-500 h-24">-->
<!--            <div class="bg-yellow-500 w-56 ">A</div>-->
<!--            <div class="bg-lime-500 w-full ">B</div>-->
<!--        </div>-->
<!--        <div class="flex bg-emerald-500">-->
<!--            <div class="bg-sky-500 w-56 min-h-screen">C</div>-->
<!--            <div class="bg-pink-500 w-full">D-->

<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="flex bg-lime-800">-->
<!--        <div class="w-56 bg-red-800">-->

<!--            <div class="h-24 bg-orange-500">A</div>-->
<!--            <div class="min-h-screen bg-teal-500">B</div>-->
<!--        </div>-->
<!--        <div class="w-full bg-emerald-500">-->
<!--            <div class="h-24 bg-cyan-700">C</div>-->
<!--            <div class="min-h-screen bg-yellow-500 ">D-->

<!--                <table class="w-full ">-->
<!--                    <tr class="text-left font-bold">-->
<!--                        <th class="px-6 pt-6 pb-4">Name</th>-->
<!--                        <th class="px-6 pt-6 pb-4">City</th>-->
<!--                        <th class="px-6 pt-6 pb-4">E-mail</th>-->
<!--                        <th colspan="2" class="px-6 pt-6 pb-4">Phone</th>-->
<!--                    </tr>-->
<!--                    <tr-->
<!--                        class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                        <td class="border-t">-->
<!--                            FEEE-->
<!--                        </td>-->
<!--                        <td class="border-t">-->
<!--                            FFFF-->
<!--                        </td>-->
<!--                        <td class="border-t">-->
<!--                            FFFF-->
<!--                        </td>-->
<!--                        <td class="border-t">-->
<!--                            FFFF-->
<!--                        </td>-->
<!--                        <td class="w-px border-t">-->
<!--                            FFF-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr-->
<!--                        class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                        <td class="border-t">-->
<!--                            FEEE-->
<!--                        </td>-->
<!--                        <td class="border-t">-->
<!--                            FFFF-->
<!--                        </td>-->
<!--                        <td class="border-t">-->
<!--                            FFFF-->
<!--                        </td>-->
<!--                        <td class="border-t">-->
<!--                            FFFF-->
<!--                        </td>-->
<!--                        <td class="w-px border-t">-->
<!--                            FFF-->
<!--                        </td>-->
<!--                    </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr>  <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr> <tr-->
<!--                    class="hover:bg-gray-100 focus-within:bg-gray-100">-->
<!--                    <td class="border-t">-->
<!--                        FEEE-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="border-t">-->
<!--                        FFFF-->
<!--                    </td>-->
<!--                    <td class="w-px border-t">-->
<!--                        FFF-->
<!--                    </td>-->
<!--                </tr>-->
<!--                    <tr >-->
<!--                        <td class="px-6 py-4 border-t" colspan="4">No companies found.</td>-->
<!--                    </tr>-->
<!--                </table>-->

<!--            </div>-->

<!--        </div>-->
<!--    </div>-->



</template>



<style scoped>

</style>
