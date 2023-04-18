<script setup>
defineProps({
    header: {
        type: Boolean,
        default: false,
    },
    footer: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div
        class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow"
    >
        <div class="px-4 py-5 sm:px-6" v-if="header">
            <slot name="header" />
        </div>
        <div class="px-4 py-5 sm:p-6 space-y-5">
            <slot />
        </div>
        <div class="px-4 py-4 sm:px-6" v-if="footer">
            <slot name="footer" />
        </div>
    </div>
</template>
