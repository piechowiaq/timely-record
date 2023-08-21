<template>
    <div class="relative">
        <div class="relative">
            <button @click="isOpen = !isOpen"  class="flex z-10 block focus:outline-none">
                <slot></slot>
            </button>
            <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 w-full h-full bg-black opacity-20 cursor-default"></button>
            <div v-if="isOpen" class="absolute right-0 mt-2 py-2 w-40 bg-white rounded text-sm shadow-xl">
                <slot name="dropdown" />
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent, onUnmounted, computed } from 'vue'
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

export default defineComponent({

    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        return { user }
    },
    components: {
        Link,
    },
    data(){
        return {
            isOpen: false
        }
    },
    props: {
        auth: Object,
    },
    mounted() {
        const onEscape = (e) => {
            if (!this.isOpen || e.key !== 'Escape') {
                return
            }
            this.isOpen = false
        }
        document.addEventListener('keydown', onEscape)
        onUnmounted(() => document.removeEventListener('keydown', onEscape))
    },
})
</script>
