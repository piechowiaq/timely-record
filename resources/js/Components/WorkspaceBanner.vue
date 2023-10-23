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
    <div class="bg-gray-100 px-4 py-3  sm:flex sm:flex-grow sm:overflow-hidden items-center justify-between font-bold mb-2">
        <div class="flex truncate pr-2">
            <Link :href="href" class="text-cyan-600">Registries</Link>
            <p class="text-gray-600 truncate ... ">&nbsp|&nbsp{{ name }}</p>
        </div>
        <FlashMessages/>
    </div>
</template>
