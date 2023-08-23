<script setup>

defineProps({
    links: Array
})

</script>

<template>
    <div>
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="mr-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500 bg-white"
            :class="{ 'text-gray-200': ! link.url, 'font-bold' : link.active }"
        ></Component>
</div>
</template>

