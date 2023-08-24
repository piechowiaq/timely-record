<script setup>

import {Link} from "@inertiajs/vue3";
import {defineProps} from "vue";

defineProps({
    links: Array,
})


</script>

<template>
    <div>

        <template v-for="(link, index) in links" :key="index">
            <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border-gray-400 rounded"
                 v-html="link.label" />
            <Link v-else
                          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-cyan-700 hover:text-white border-cyan-700 focus:text-cyan-700"
                          :class="{ 'bg-gray-700 text-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
    </div>
</template>

