<script setup></script>

<template>
    <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            <slot name="title" />
        </h3>
        <p class="mt-1 text-sm text-gray-500">
            <slot name="description" />
        </p>
    </div>
</template>
