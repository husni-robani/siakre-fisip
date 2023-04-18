<script setup>
import AppLayout from "../Layouts/AppLayout.vue";
import { DocumentIcon, UsersIcon, FolderIcon } from "@heroicons/vue/24/outline";
import Card from "../Components/Card.vue";
import CardHeading from "../Components/CardHeading.vue";
import Pagination from "../Components/Pagination.vue";

import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";
import { ChevronDownIcon, FunnelIcon } from "@heroicons/vue/24/solid";
import { computed, reactive, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    count: Object,
    documents: Object,
    filters: Object,
});

const initialFilterState = {
    majorId: [],
    standardId: [],
};

const filterState = reactive({
    majorId: props.filters.majorIds,
    standardId: props.filters.standardIds,
});

const resetFilterState = () => {
    Object.assign(filterState, initialFilterState);
};

const totalFilter = computed(() => {
    return filterState.majorId.length + filterState.standardId.length;
});

watch(filterState, (newValue) => {
    router.get(
        route("dashboard"),
        {
            majorId: newValue.majorId,
            standardId: newValue.standardId,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
});

const filters = {
    majors: props.filters.majors,
    standards: props.filters.standards,
};
</script>

<template>
    <AppLayout title="Dashboard">
        <div>
            <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    class="relative overflow-hidden rounded-lg bg-white px-4 py-6 shadow sm:px-6"
                >
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <UsersIcon class="h-6 w-6 text-white" />
                        </div>
                        <p
                            class="ml-16 truncate text-sm font-medium text-gray-500"
                        >
                            Total Pengguna
                        </p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ count.user }}
                        </p>
                    </dd>
                </div>
                <div
                    class="relative overflow-hidden rounded-lg bg-white px-4 py-6 shadow sm:px-6"
                >
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <DocumentIcon class="h-6 w-6 text-white" />
                        </div>
                        <p
                            class="ml-16 truncate text-sm font-medium text-gray-500"
                        >
                            Total Dokumen
                        </p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ count.document }}
                        </p>
                    </dd>
                </div>
                <div
                    class="relative overflow-hidden rounded-lg bg-white px-4 py-6 shadow sm:px-6"
                >
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <FolderIcon class="h-6 w-6 text-white" />
                        </div>
                        <p
                            class="ml-16 truncate text-sm font-medium text-gray-500"
                        >
                            Total Standar
                        </p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ count.standard }}
                        </p>
                    </dd>
                </div>
                <div
                    class="relative overflow-hidden rounded-lg bg-white px-4 py-6 shadow sm:px-6"
                >
                    <dt>
                        <div class="absolute rounded-md bg-indigo-500 p-3">
                            <FolderIcon class="h-6 w-6 text-white" />
                        </div>
                        <p
                            class="ml-16 truncate text-sm font-medium text-gray-500"
                        >
                            Total Sub Standar
                        </p>
                    </dt>
                    <dd class="ml-16 flex items-baseline">
                        <p class="text-2xl font-semibold text-gray-900">
                            {{ count.sub }}
                        </p>
                    </dd>
                </div>
            </dl>
        </div>
        <Card header class="mt-8">
            <template #header>
                <CardHeading>
                    <template #title>Aktivitas terbaru</template>
                    <template #description
                        >Aktifitas terbaru dalam sistem dari seluruh program
                        studi.
                    </template>
                </CardHeading>
            </template>
            <div class="flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                        >
                            <Disclosure
                                as="section"
                                aria-labelledby="filter-heading"
                                class="relative z-0 grid items-center border-gray-200"
                            >
                                <div
                                    class="relative col-start-1 row-start-1 py-4 px-4"
                                >
                                    <div
                                        class="mx-auto flex space-x-6 divide-x divide-gray-200 py-4 text-sm sm:py-0"
                                    >
                                        <div>
                                            <DisclosureButton
                                                class="group flex items-center font-medium text-gray-700"
                                            >
                                                <FunnelIcon
                                                    class="mr-2 h-5 w-5 flex-none text-gray-400 group-hover:text-gray-500"
                                                />
                                                {{ totalFilter }} Filter
                                            </DisclosureButton>
                                        </div>
                                        <div class="pl-6">
                                            <button
                                                @click="resetFilterState"
                                                type="button"
                                                class="text-gray-500"
                                            >
                                                Clear all
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <DisclosurePanel
                                    class="border-t border-gray-200 py-10"
                                >
                                    <div
                                        class="mx-auto grid max-w-7xl grid-cols-2 gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8"
                                    >
                                        <fieldset>
                                            <legend class="block font-medium">
                                                Program Studi
                                            </legend>
                                            <div
                                                class="space-y-6 pt-6 sm:space-y-4 sm:pt-4"
                                            >
                                                <div
                                                    v-for="(
                                                        option, optionIdx
                                                    ) in filters.majors"
                                                    :key="option.id"
                                                    class="flex items-center text-base sm:text-sm"
                                                >
                                                    <input
                                                        :id="`major-${optionIdx}`"
                                                        name="major"
                                                        v-model="
                                                            filterState.majorId
                                                        "
                                                        :value="option.id"
                                                        :true-value="[]"
                                                        type="checkbox"
                                                        class="h-4 w-4 flex-shrink-0 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    />
                                                    <label
                                                        :for="`major-${optionIdx}`"
                                                        class="ml-3 min-w-0 flex-1 text-gray-600"
                                                    >
                                                        {{ option.name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend class="block font-medium">
                                                Standar
                                            </legend>
                                            <div
                                                class="space-y-6 pt-6 sm:space-y-4 sm:pt-4"
                                            >
                                                <div
                                                    v-for="(
                                                        option, optionIdx
                                                    ) in filters.standards"
                                                    :key="option.id"
                                                    class="flex items-center text-base sm:text-sm"
                                                >
                                                    <input
                                                        :id="`standard-${optionIdx}`"
                                                        name="standard[]"
                                                        :value="option.id"
                                                        v-model="
                                                            filterState.standardId
                                                        "
                                                        type="checkbox"
                                                        class="h-4 w-4 flex-shrink-0 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    />
                                                    <label
                                                        :for="`standard-${optionIdx}`"
                                                        class="ml-3 min-w-0 flex-1 text-gray-600"
                                                    >
                                                        {{ option.name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </DisclosurePanel>
                            </Disclosure>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                        >
                                            Nama
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Sub
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Program Studi
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Status
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Terakhir Update
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr
                                        v-for="document in documents.data"
                                        :key="document.id"
                                    >
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 flex-shrink-0"
                                                >
                                                    <img
                                                        class="h-10 w-10 rounded-full"
                                                        :src="`https://ui-avatars.com/api/?name=${document.user.name}`"
                                                        alt=""
                                                    />
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="font-medium text-gray-900"
                                                    >
                                                        {{ document.user.name }}
                                                    </div>
                                                    <div class="text-gray-500">
                                                        {{
                                                            document.user.email
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            <div class="text-gray-900">
                                                <strong>
                                                    {{ document.sub.number }}
                                                </strong>
                                            </div>
                                            <div class="text-gray-500">
                                                {{ document.sub.name }}
                                            </div>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            {{ document.major.name }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            <span
                                                v-if="document.status === 'Terverifikasi'"
                                                class="inline-flex items-center rounded bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800"
                                            >
                                                <svg
                                                    class="mr-1.5 h-2 w-2 text-green-400"
                                                    fill="currentColor"
                                                    viewBox="0 0 8 8"
                                                >
                                                    <circle
                                                        cx="4"
                                                        cy="4"
                                                        r="3"
                                                    />
                                                </svg>
                                                {{ document.status }}
                                            </span>
                                            <span
                                                v-else
                                                class="inline-flex items-center rounded bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800"
                                            >
                                                <svg
                                                    class="mr-1.5 h-2 w-2 text-yellow-400 animate-ping"
                                                    fill="currentColor"
                                                    viewBox="0 0 8 8"
                                                >
                                                    <circle
                                                        cx="4"
                                                        cy="4"
                                                        r="3"
                                                    />
                                                </svg>
                                                {{ document.status }}
                                            </span>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            {{ document.updated_at }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :data="documents" />
                        </div>
                    </div>
                </div>
            </div>
        </Card>
    </AppLayout>
</template>
