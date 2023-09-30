<script setup>

import {Head, Link} from '@inertiajs/vue3'
import GuestFooter from "@/Layouts/GuestFooter.vue";

defineProps({
    canLogin: Boolean,
})

</script>

<template>

    <Head title="Welcome"/>

    <div class="relative flex items-top justify-center min-h-screen min-w-fit bg-gray-100 dark:bg-gray-900">

        <div v-if="canLogin && $page.props.auth.user" class=" absolute top-0 right-0 px-6 py-4 block">
            <Link :href="route('workspace.selector')" class=" text-sm text-gray-700 underline mr-1">
                Dashboard
            </Link>
            <Link :href="route('logout')" method="post" as="button" class=" text-sm text-gray-700 underline">
                Logout
            </Link>
        </div>
        <div v-if="canLogin && !$page.props.auth.user" class=" absolute xl:fixed top-0 right-0 px-6 py-4 block">
            <Link :href="route('login')" class=" text-sm text-gray-700 underline mr-1">
                Login
            </Link>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="pt-6 px-20">
                <div class="pt-8 sm:pt-0 flex items-center justify-center md:justify-start">

                    <Link :href="route('welcome')" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="88" height="88" viewBox="0 0 24 24"
                             class="stroke-cyan-600 fill-gray-600 stroke-1">
                            <path
                                d="M12 22c-1.02 0-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991v-1.574c0-3.198 0-4.797.378-5.334C3.755 4.545 5.258 4.03 8.265 3l.573-.196C10.405 2.268 11.188 2 12 2"/>
                            <path
                                d="M12 22c1.02 0 1.38-.158 2.101-.473c2.66-1.162 6.9-3.898 6.9-9.536v-1.574c0-3.198 0-4.797-.378-5.334c-.378-.538-1.881-1.053-4.888-2.082l-.573-.196C13.595 2.268 12.812 2 12 2"
                                opacity=".5"/>
                        </svg>
                    </Link>

                    <p class="ml-2 text-2xl font-bold whitespace-nowrap tracking-widest text-gray-600"><span
                        class="text-cyan-600 ">TIMELY</span> RECORD</p>
                </div>
                <div class="mt-8 text-xl dark:text-white">
                    Welcome to your Timely Record application!
                </div>
                <div class="mt-6 text-gray-500 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tristique, libero vel fringilla
                    cursus, dolor tortor varius nisl, eu volutpat nulla ex nec sapien. Sed dictum, arcu sed bibendum
                    imperdiet, lorem est bibendum tellus, eu varius libero turpis at est.
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



