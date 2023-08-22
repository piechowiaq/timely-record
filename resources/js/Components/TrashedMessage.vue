<template>
    <div class="flex items-center justify-between p-2 bg-yellow-400 rounded">
        <div class="flex items-center">
            <icon name="trash" class="flex-shrink-0 mr-2 w-4 h-4 fill-yellow-800" />
            <div class="text-yellow-800 text-sm font-medium">
                <slot />
            </div>
        </div>
        <button class="text-yellow-800 hover:underline ml-6 text-sm" tabindex="-1" type="button" @click="$emit('restore')">Restore</button>
    </div>
</template>

<script>
import Icon from '@/Components/Icon.vue'

export default {
    components: {
        Icon,
    },
    emits: ['restore'],
}
</script>
