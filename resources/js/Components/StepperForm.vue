<script setup>
defineProps({
    now: Number,
    steps: Array,
});

defineEmits(["changeStep"]);
</script>

<template>
    <nav>
        <ol role="list" class="space-y-4 md:flex md:space-y-0 md:space-x-8">
            <li v-for="step in steps" :key="step.name" class="md:flex-1">
                <div
                    v-if="now > step.id"
                    @click="$emit('changeStep', step.id)"
                    class="group flex flex-col border-l-4 hover:cursor-pointer border-indigo-600 py-2 pl-4 hover:border-indigo-800 md:border-l-0 md:border-t-4 md:pl-0 md:pt-4 md:pb-0"
                >
                    <span
                        class="text-xs font-semibold uppercase tracking-wide text-indigo-600 group-hover:text-indigo-800"
                        >{{ step.id }}</span
                    >
                    <span class="text-sm font-medium">{{ step.name }}</span>
                </div>
                <div
                    @click="$emit('changeStep', step.id)"
                    v-else-if="now === step.id"
                    class="flex flex-col hover:cursor-pointer border-l-4 border-indigo-600 py-2 pl-4 md:border-l-0 md:border-t-4 md:pl-0 md:pt-4 md:pb-0"
                >
                    <span
                        class="text-xs font-semibold uppercase tracking-wide text-indigo-600"
                        >{{ step.id }}</span
                    >
                    <span class="text-sm font-medium">{{ step.name }}</span>
                </div>
                <div
                    @click="$emit('changeStep', step.id)"
                    v-else
                    class="group flex flex-col hover:cursor-pointer border-l-4 border-gray-200 py-2 pl-4 hover:border-gray-300 md:border-l-0 md:border-t-4 md:pl-0 md:pt-4 md:pb-0"
                >
                    <span
                        class="text-xs font-semibold uppercase tracking-wide text-gray-500 group-hover:text-gray-700"
                        >{{ step.id }}</span
                    >
                    <span class="text-sm font-medium">{{ step.name }}</span>
                </div>
            </li>
        </ol>
    </nav>
</template>
