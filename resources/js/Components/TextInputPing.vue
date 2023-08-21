<template>
    <div :class="$attrs.class">
        <label v-if="label" :for="id" class="form-label">{{ label }}:</label>
        <input :id="id" ref="input" v-bind="{ ...$attrs, class: null }" :type="type" :class="{ error: error }"  class="form-input" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>

import { v4 as uuid } from 'uuid'

export default {
    inheritAttrs: false,
    props: {
        label: String,
        type: {
            type: String,
            default: 'text',
        },
        id: {
            type: String,
            default() {
                return `text-input-${uuid()}`
            }
        },
        modelValue: String,
        error: String,
    },
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end)
        },
    }
}
</script>
