<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { BellIcon, Bars3CenterLeftIcon } from "@heroicons/vue/24/outline";
import SearchBox from "./SearchBox.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    modelValue: Boolean,
});

defineEmits(["update:modelValue"]);

const user = computed(() => {
    return usePage().props.auth.user;
});
</script>

<template>
    <div
        class="sticky top-0 z-10 flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:border-none"
    >
        <button
            type="button"
            class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden"
            @click="$emit('update:modelValue', true)"
        >
            <Bars3CenterLeftIcon class="h-6 w-6" />
        </button>
        <div
            class="lg:max-w-8xl flex flex-1 justify-between px-4 sm:px-6 lg:mx-auto lg:px-8"
        >
            <div class="flex flex-1">
                <SearchBox class="w-full" />
            </div>
            <div class="ml-4 flex items-center md:ml-6">
                <!-- Profile dropdown -->
                <Menu as="div" class="relative ml-3">
                    <div>
                        <MenuButton
                            class="flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            <img
                                class="h-8 w-8 rounded-full"
                                :src="`https://ui-avatars.com/api/?name=${user.name}`"
                                alt=""
                            />
                        </MenuButton>
                    </div>
                    <transition
                        enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <MenuItems
                            class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <MenuItem v-slot="{ active }">
                                <Link
                                    as="div"
                                    method="GET"
                                    :href="route('profile.index')"
                                    :class="[
                                        active ? 'bg-gray-100' : '',
                                        'block cursor-pointer py-2 px-4 text-sm text-gray-700',
                                    ]"
                                >
                                    Profile
                                </Link>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <Link
                                    as="div"
                                    method="POST"
                                    :href="route('logout')"
                                    :class="[
                                        active ? 'bg-gray-100' : '',
                                        'block cursor-pointer py-2 px-4 text-sm text-gray-700',
                                    ]"
                                >
                                    Logout
                                </Link>
                            </MenuItem>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
    </div>
</template>
