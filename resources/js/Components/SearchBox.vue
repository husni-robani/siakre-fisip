<script setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
</script>

<template>
    <form class="flex md:ml-0" action="#" method="GET">
        <div class="relative w-full text-gray-400 focus-within:text-gray-600">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center"
            >
                <MagnifyingGlassIcon class="h-5 w-5" />
            </div>
            <input
                id="search"
                class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm"
                placeholder="Pencarian"
                type="search"
                name="search"
            />
        </div>
    </form>
</template>
