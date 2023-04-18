<script setup>
import { ref } from "vue";
import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";

const open = ref(true);
</script>

<template>
    <TransitionRoot as="template" :show="open">
        <Dialog
            as="div"
            class="fixed inset-0 z-50 overflow-hidden"
            @close="open = false"
        >
            <div class="absolute inset-0 overflow-hidden">
                <DialogOverlay class="absolute inset-0" />

                <div
                    class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                >
                    <TransitionChild
                        as="template"
                        enter="transform transition ease-in-out duration-500 sm:duration-700"
                        enter-from="translate-x-full"
                        enter-to="translate-x-0"
                        leave="transform transition ease-in-out duration-500 sm:duration-700"
                        leave-from="translate-x-0"
                        leave-to="translate-x-full"
                    >
                        <div class="pointer-events-auto w-screen max-w-md">
                            <div
                                class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl"
                            >
                                <div
                                    class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6"
                                >
                                    <div class="px-4 sm:px-6">
                                        <div
                                            class="flex items-start justify-between"
                                        >
                                            <DialogTitle
                                                class="text-lg font-medium text-gray-900"
                                            >
                                                <slot name="title" />
                                            </DialogTitle>
                                            <div
                                                class="ml-3 flex h-7 items-center"
                                            >
                                                <button
                                                    type="button"
                                                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    @click="open = false"
                                                >
                                                    <XMarkIcon
                                                        class="h-6 w-6"
                                                        aria-hidden="true"
                                                    />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="relative mt-6 flex-1 px-4 sm:px-6"
                                    >
                                        <slot name="content" />
                                    </div>
                                </div>
                                <div
                                    class="flex flex-shrink-0 justify-end px-4 py-4"
                                >
                                    <button
                                        type="button"
                                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        @click="open = false"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
