<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    data: Object,
});
</script>

<template>
    <nav
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
        aria-label="Pagination"
    >
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Menampilkan
                {{ " " }}
                <span class="font-medium">{{ data.from }}</span>
                {{ " " }}
                -
                {{ " " }}
                <span class="font-medium">{{ data.to }}</span>
                {{ " " }}
                dari
                {{ " " }}
                <span class="font-medium">{{ data.total }}</span>
                {{ " " }}
                hasil.
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <Link
                v-if="data.prev_page_url"
                :href="data.prev_page_url"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Sebelumnya
            </Link>
            <Link
                v-if="data.next_page_url"
                :href="data.next_page_url"
                href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Berikutnya
            </Link>
        </div>
    </nav>
</template>
