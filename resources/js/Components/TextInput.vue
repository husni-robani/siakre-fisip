<script setup>
defineProps({
    modelValue: String,
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <input
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
    />
</template>
