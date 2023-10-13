<script setup>

defineProps({
    name: {
        type: String,
        required: true,
    },
})

</script>


<template>

    <svg v-if="name === 'logo'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="stroke-cyan-600 fill-gray-600 stroke-1">
        <path
            d="M12 22c-1.02 0-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991v-1.574c0-3.198 0-4.797.378-5.334C3.755 4.545 5.258 4.03 8.265 3l.573-.196C10.405 2.268 11.188 2 12 2"/>
        <path
            d="M12 22c1.02 0 1.38-.158 2.101-.473c2.66-1.162 6.9-3.898 6.9-9.536v-1.574c0-3.198 0-4.797-.378-5.334c-.378-.538-1.881-1.053-4.888-2.082l-.573-.196C13.595 2.268 12.812 2 12 2"
            opacity=".5"/>
    </svg>

    <!--Navigation Icons-->

    <svg v-else-if="name === 'dashboard'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path
            d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm-5.6-4.29a9.95 9.95 0 0 1 11.2 0 8 8 0 1 0-11.2 0zm6.12-7.64l3.02-3.02 1.41 1.41-3.02 3.02a2 2 0 1 1-1.41-1.41z"></path>
    </svg>
    <svg v-else-if="name === 'registries'" viewBox="0 0 20 20"
         class="w-4 h-4 mr-2 fill-zinc-400 group-hover:fill-white">
        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/>
        <path fill-rule="evenodd"
              d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
              clip-rule="evenodd"/>
    </svg>
    <svg v-else-if="name === 'workspace'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <path fill-rule="evenodd"
              d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"></path>
    </svg>
    <svg v-else-if="name === 'admin'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path
            d="M12 23C6.443 21.765 2 16.522 2 11V5l10-4l10 4v6c0 5.524-4.443 10.765-10 12ZM4 6v5a10.58 10.58 0 0 0 8 10a10.58 10.58 0 0 0 8-10V6l-8-3Z"/>
        <circle cx="12" cy="8.5" r="2.5"/>
        <path d="M7 15a5.782 5.782 0 0 0 5 3a5.782 5.782 0 0 0 5-3c-.025-1.896-3.342-3-5-3c-1.667 0-4.975 1.104-5 3Z"/>
    </svg>



    <svg v-else-if="name === 'cheveron-down'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
    </svg>
    <svg v-else-if="name === 'cheveron-right'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"/>
    </svg>



    <svg v-else-if="name === 'office'" xmlns="http://www.w3.org/2000/svg" width="100" height="100"
         viewBox="0 0 100 100">
        <path fill-rule="evenodd"
              d="M7 0h86v100H57.108V88.418H42.892V100H7V0zm9 64h11v15H16V64zm57 0h11v15H73V64zm-19 0h11v15H54V64zm-19 0h11v15H35V64zM16 37h11v15H16V37zm57 0h11v15H73V37zm-19 0h11v15H54V37zm-19 0h11v15H35V37zM16 11h11v15H16V11zm57 0h11v15H73V11zm-19 0h11v15H54V11zm-19 0h11v15H35V11z"/>
    </svg>
    <svg v-else-if="name === 'printer'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z"/>
    </svg>
    <svg v-else-if="name === 'trash'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
    </svg>
    <svg v-else-if="name === 'users'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path
            d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"/>
    </svg>
    <svg v-else-if="name === 'download'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
              clip-rule="evenodd"/>
    </svg>
    <svg v-else-if="name === 'expired'" xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 20 20"
         fill="currentColor">
        <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
              clip-rule="evenodd"/>
    </svg>
    <svg v-else-if="name === 'due'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>


    <svg v-else-if="name === 'venues'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
    </svg>
    <svg v-else-if="name === 'sorting'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
    </svg>
    <svg v-else-if="name === 'up-to-date'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
         class="">
        <path fill-rule="evenodd"
              d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
              clip-rule="evenodd"/>
    </svg>

</template>


