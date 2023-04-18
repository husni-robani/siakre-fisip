<script setup>
import { CheckCircleIcon } from "@heroicons/vue/20/solid";
import { XCircleIcon } from "@heroicons/vue/20/solid";
import { onMounted } from "vue";

const props = defineProps({
    show: Boolean,
    message: String,
    type: String,
    duration: {
        type: Number,
        default: 1500,
    },
});

const emits = defineEmits(["remove"]);

onMounted(() => {
    setTimeout(() => emits("remove"), props.duration);
});
</script>

<template>
    <div
        v-if="show"
        class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
    >
        <div class="p-4" v-if="type === 'success'">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <CheckCircleIcon class="h-6 w-6 text-green-400" />
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                        Berhasil
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        {{message}}
                    </p>
                </div>
                <div class="ml-4 flex flex-shrink-0">
                    <button
                        @click="$emit('remove')"
                        class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <XCircleIcon class="h-5 w-5" />
                    </button>
                </div>
            </div>
        </div>
        <div class="p-4" v-if="type === 'failed'">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <CheckCircleIcon class="h-6 w-6 text-green-400" />
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                        Gagal
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        {{message}}
                    </p>
                </div>
                <div class="ml-4 flex flex-shrink-0">
                    <button
                        @click="$emit('remove')"
                        class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <XCircleIcon class="h-5 w-5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
