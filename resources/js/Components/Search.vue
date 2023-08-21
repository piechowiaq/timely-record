<template>
    <div>
    <div class="flex w-full bg-white shadow rounded">

        <div>
            <button @click="isOpen = !isOpen"  class="flex h-full w-full bg-white shadow rounded py-4 px-4 ">
                <span>Filter</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="w-5 h-5 group-hover:fill-indigo-600 fill-gray-700 focus:fill-indigo-600"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </button>
            <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 w-full h-full bg-black opacity-20 cursor-default"></button>
            <div v-if="isOpen" class="absolute mt-2 px-4 py-6 w-screen bg-white text-sm rounded shadow-xl" style="max-width: 300px">
                <label class="block text-gray-700">Trashed:</label>
                <select @input="$emit('update:trashed', $event.target.value)" class="form-select text-sm mt-1 w-full px-6 py-2">
                    <option :value="null" />
                    <option value="with">With Trashed</option>
                    <option value="only">Only Trashed</option>
                </select>
            </div>
        </div>
            <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"  type="text" name="search" placeholder="Search…" class="w-full px-6 py-3 rounded-r focus:ring">
             </div>
        <button type="button" class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"   @click="$emit('reset')">Reset</button>
        </div>
</template>

<script>
import {onUnmounted} from 'vue';

export default {

    data(){
        return{
            isOpen: false,
        }
    },

    props: {
        modelValue: String,
        trashed: String,
    },
    emits: ['update:modelValue', 'update:trashed','reset'],
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
}
</script>
