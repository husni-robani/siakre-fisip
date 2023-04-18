<script setup>
import { HomeIcon } from "@heroicons/vue/24/solid";
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const links = computed(() => {
    return usePage().props.breadcrumbs;
});
</script>

<template>
    <nav class="flex border-b border-gray-200 bg-white" aria-label="Breadcrumb">
        <ol role="list" class="flex w-full space-x-4 px-4 sm:px-6 lg:px-8">
            <li class="flex">
                <div class="flex items-center">
                    <Link
                        method="GET"
                        :href="route('dashboard')"
                        class="text-gray-400 hover:text-gray-500"
                    >
                        <HomeIcon class="h-5 w-5 flex-shrink-0" />
                    </Link>
                </div>
            </li>
            <li v-for="link in links" :key="link.url" class="flex">
                <div class="flex items-center">
                    <svg
                        class="h-full w-6 flex-shrink-0 text-gray-200"
                        viewBox="0 0 24 44"
                        preserveAspectRatio="none"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true"
                    >
                        <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                    </svg>
                    <Link
                        method="GET"
                        :href="link.url"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        >{{ link.title }}
                    </Link>
                </div>
            </li>
        </ol>
    </nav>
</template>
