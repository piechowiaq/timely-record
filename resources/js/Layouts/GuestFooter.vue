<script setup>

import { Link } from '@inertiajs/vue3';

</script>


<template>
    <div class="flex justify-center my-4 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
            <div class="flex items-center">
                <div>
                    <a href="https://linkedin.com/company/timely-record/" target="_blank">
                        <svg class="fill-gray-500 hover:fill-cyan-600" xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M20.47 2H3.53a1.45 1.45 0 0 0-1.47 1.43v17.14A1.45 1.45 0 0 0 3.53 22h16.94a1.45 1.45 0 0 0 1.47-1.43V3.43A1.45 1.45 0 0 0 20.47 2ZM8.09 18.74h-3v-9h3ZM6.59 8.48a1.56 1.56 0 1 1 0-3.12a1.57 1.57 0 1 1 0 3.12Zm12.32 10.26h-3v-4.83c0-1.21-.43-2-1.52-2A1.65 1.65 0 0 0 12.85 13a2 2 0 0 0-.1.73v5h-3v-9h3V11a3 3 0 0 1 2.71-1.5c2 0 3.45 1.29 3.45 4.06Z"/>
                        </svg>
                    </a>
                </div>
                <div class="ml-2">
                    <a href="https://facebook.com/people/Timely-Record/61550085031784/" target="_blank">
                        <svg class="fill-gray-500 hover:fill-cyan-600" xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24">
                            <path id="feFacebook2"
                                  d="M15.725 22v-7.745h2.6l.389-3.018h-2.99V9.31c0-.874.243-1.47 1.497-1.47h1.598v-2.7a21.391 21.391 0 0 0-2.33-.12c-2.304 0-3.881 1.407-3.881 3.99v2.227H10v3.018h2.607V22H3.104C2.494 22 2 21.506 2 20.896V3.104C2 2.494 2.494 2 3.104 2h17.792C21.506 2 22 2.494 22 3.104v17.792c0 .61-.494 1.104-1.104 1.104h-5.171Z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="ml-4 text-center items-center sm:text-right sm:ml-0 flex">
            <Link
                :href="route('contact')"
                class="text-xs text-gray-600 hover:text-cyan-700 rounded-md "
                :class="{ isDisabled: $page.props.route === 'contact' }"
                preserve-scroll
            >
                contact@timelyrecord.com
            </Link>
        </div>
    </div>
</template>

<style scoped>

.isDisabled {
    pointer-events: none;
}

</style>
