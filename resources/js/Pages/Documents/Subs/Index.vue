<script setup>
import AppLayout from "../../../Layouts/AppLayout.vue";
import TextLink from "../../../Components/TextLink.vue";
import SelectOption from "../../../Components/SelectOption.vue";
import { computed, ref, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import TextLabel from "../../../Components/TextLabel.vue";

const props = defineProps({
    standard: Object,
    subs: Array,
    majors: Array,
    filters: Object,
});

const selectedMajor = ref(props.filters.majorId);

const user = computed(() => {
    return usePage().props.auth.user;
});

watch(selectedMajor, (newValue) => {
    router.get(
        route("documents.subs.index", props.standard.id),
        {
            majorId: newValue,
        },
        {
            preserveState: true,
        }
    );
});
</script>

<template>
    <AppLayout :title="standard.name">
        <div class="gap-5 sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">
                    {{ standard.name }}
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    {{ standard.description }}
                </p>
            </div>
            <div class="space-y-2 sm:flex-auto" v-if="!user.major_id">
                <TextLabel for="major_id">Program Studi</TextLabel>
                <SelectOption
                    name="major_id"
                    id="major_id"
                    :options="majors"
                    v-model="selectedMajor"
                />
            </div>
        </div>
        <div
            class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg"
        >
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                        >
                            Nomor Butir
                        </th>
                        <th
                            scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell"
                        >
                            Nama Sub
                        </th>
                        <th
                            scope="col"
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                        >
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr
                        v-for="sub in subs"
                        :key="sub.id"
                        v-if="subs.length > 0"
                    >
                        <td
                            class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6"
                        >
                            {{ sub.number }}
                            <dl class="font-normal lg:hidden">
                                <dd class="mt-1 truncate text-gray-700">
                                    {{ sub.number }}
                                </dd>
                                <dd
                                    class="mt-1 truncate text-gray-500 sm:hidden"
                                >
                                    {{ sub.name }}
                                </dd>
                            </dl>
                        </td>
                        <td
                            class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell"
                        >
                            {{ sub.name }}
                        </td>
                        <td
                            class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                        >
                            <TextLink
                                method="GET"
                                :href="
                                    route('documents.subs.show', {
                                        standard: standard.number,
                                        sub: sub.number,
                                        majorId: selectedMajor,
                                    })
                                "
                                class="text-indigo-600 hover:text-indigo-900"
                                >Detail
                            </TextLink>
                        </td>
                    </tr>
                    <tr v-else>
                        <td
                            colspan="5"
                            class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6"
                        >
                            Belum ada dokumen pada standar ini.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
