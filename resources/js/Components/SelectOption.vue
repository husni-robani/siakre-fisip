<script setup>
defineProps({
    modelValue: Number,
    options: Array,
    withSpace: {
        type: Boolean,
        default: false,
    },
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <select
        @input="$emit('update:modelValue', Number($event.target.value))"
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
    >
        <option v-if="withSpace" :selected="modelValue === null"></option>
        <option
            v-for="option in options"
            :selected="modelValue === option.id"
            :key="option.id"
            :value="option.id"
        >
            {{ option.name }}
        </option>
    </select>
</template>
