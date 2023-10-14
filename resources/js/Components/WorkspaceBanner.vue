<script setup>
import { Link } from "@inertiajs/vue3";
import FlashMessages from "@/Components/FlashMessages.vue";

defineProps({
    href: {
        type: String,
    },
    name: {
        type: String,
    },

})


</script>

<template>
    <div class="flex-grow bg-gray-100 py-2 px-3 md:h-12 items-center flex  justify-between font-bold mb-2">
        <div class="flex">
            <Link :href="href" class="text-cyan-600">Registries</Link>
            <p class="text-gray-600">&nbsp|&nbsp{{ name }}</p>
        </div>
        <FlashMessages/>
    </div>
</template>
