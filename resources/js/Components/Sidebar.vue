<script setup>
import { computed, onMounted, ref } from "vue";
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    FolderIcon,
    HomeIcon,
    UsersIcon,
    XMarkIcon,
    DocumentIcon,
    DocumentCheckIcon, DocumentTextIcon,
} from "@heroicons/vue/24/outline";
import ApplicationLogo from "../Components/ApplicationLogo.vue";
import { usePage, Link } from "@inertiajs/vue3";

const permissions = computed(() => {
    return usePage().props.auth.permissions;
});

const navigation = ref([
    {
        name: "Dashboard",
        href: route("dashboard"),
        icon: HomeIcon,
        current: route().current("dashboard"),
    },
]);

const addNavigation = (newNavigation) => {
    navigation.value.push(newNavigation);
};

onMounted(() => {
    if (permissions.value.includes("access documents")) {
        addNavigation({
            name: "Dokumen",
            href: route("documents.index"),
            icon: DocumentIcon,
            current: route().current("documents.index"),
        });
    }
    if (permissions.value.includes("verify document")) {
        addNavigation({
            name: "Verifikasi Dokumen",
            href: route("verify.index"),
            icon: DocumentCheckIcon,
            current: route().current("verify.index"),
        });
    }
    if (permissions.value.includes("access subs")) {
        addNavigation({
            name: "Sub",
            href: route("subs.index"),
            icon: FolderIcon,
            current: route().current("subs.index"),
        });
    }
    if (permissions.value.includes("access standards")) {
        addNavigation({
            name: "Standar",
            href: route("standard.index"),
            icon: FolderIcon,
            current: route().current("standard.index"),
        });
    }
    if (permissions.value.includes("access users")) {
        addNavigation({
            name: "Pengguna",
            href: route("users.index"),
            icon: UsersIcon,
            current: route().current("users.index"),
        });
    }
});

defineProps({
    modelValue: Boolean,
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <div>
        <TransitionRoot as="template" :show="modelValue">
            <Dialog
                as="div"
                class="fixed inset-0 z-40 flex md:hidden"
                @close="$emit('update:modelValue', false)"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-600 bg-opacity-75"
                    />
                </TransitionChild>
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <div
                        class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    type="button"
                                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="$emit('update:modelValue', false)"
                                >
                                    <XMarkIcon class="h-6 w-6 text-white" />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex flex-shrink-0 items-center px-4">
                            <ApplicationLogo />
                        </div>
                        <div class="mt-5 h-0 flex-1 overflow-y-auto">
                            <nav class="space-y-1 px-2">
                                <Link
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    :class="[
                                        item.current
                                            ? 'bg-gray-100 text-gray-900'
                                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
                                        'group flex items-center rounded-md py-2 px-2 text-base font-medium',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        :class="[
                                            item.current
                                                ? 'text-gray-500'
                                                : 'text-gray-400 group-hover:text-gray-500',
                                            'mr-4 h-6 w-6 flex-shrink-0',
                                        ]"
                                    />
                                    {{ item.name }}
                                </Link>
                            </nav>
                        </div>
                    </div>
                </TransitionChild>
                <div class="w-14 flex-shrink-0">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>
        <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
            <div
                class="flex flex-grow flex-col overflow-y-auto border-r border-gray-200 bg-white pt-5"
            >
                <div class="flex flex-shrink-0 items-center px-4">
                    <ApplicationLogo />
                </div>
                <div class="mt-5 flex flex-grow flex-col">
                    <nav class="flex-1 space-y-1 px-2 pb-4">
                        <Link
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            :class="[
                                item.current
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
                                'group flex items-center rounded-md py-2 px-2 text-sm font-medium',
                            ]"
                        >
                            <component
                                :is="item.icon"
                                :class="[
                                    item.current
                                        ? 'text-gray-500'
                                        : 'text-gray-400 group-hover:text-gray-500',
                                    'mr-3 h-6 w-6 flex-shrink-0',
                                ]"
                                aria-hidden="true"
                            />
                            {{ item.name }}
                        </Link>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
