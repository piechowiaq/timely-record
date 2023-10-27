<script setup>

import {Head, Link} from '@inertiajs/vue3'
import GuestFooter from "@/Layouts/GuestFooter.vue";
import Icon from "@/Components/Icon.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
})

</script>

<template>

    <Head title="Welcome"/>

    <div class="relative flex items-top justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900">

        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('project.dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Register</Link
                >
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="pt-6 px-20">
                <div class="pt-8 sm:pt-0 flex items-center justify-center md:justify-start">

                    <Link :href="route('welcome')" >
                        <Icon :name="'logo'" class="w-20 h-20"/>
                    </Link>
                    <p class="ml-2 text-2xl font-bold whitespace-nowrap tracking-widest text-gray-600"><span
                        class="text-cyan-600 ">TIMELY</span> RECORD</p>
                </div>
                <div class="mt-8 text-xl dark:text-white">
                    Welcome to your Timely Record application!
                </div>
                <div class="mt-6 text-gray-500 text-justify">
                    "Timely Record - Zapis na czas" to innowacyjna aplikacja przeznaczona do zarządzania i monitorowania dokumentacji w obiektach hotelowych, aby zapewnić, że wszystkie ważne dokumenty i rekordy są aktualizowane i nie przeterminowane. Aplikacja koncentruje się na automatyzacji przepływu pracy i upewnieniu się, że wszelka dokumentacja, tak jak umowy, certyfikaty czy inne ważne dokumenty są aktualizowane zgodnie z wymaganiami prawnymi oraz standardami branży hotelowej.
                </div>
            </div>


            <div class="mt-8   overflow-hidden ">
                <slot></slot>
            </div>

            <GuestFooter></GuestFooter>
        </div>
    </div>
</template>

<style scoped>


</style>



