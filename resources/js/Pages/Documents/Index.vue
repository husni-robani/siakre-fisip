<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import CardHeading from "../../Components/CardHeading.vue";
import Tabs from "../../Components/Tabs.vue";
import { FolderIcon } from "@heroicons/vue/24/outline";
import { computed, ref, watch } from "vue";
import { router, usePage } from "@inertiajs/vue3";

const props = defineProps({
    standards: Array,
    filters: Object,
    documents: Array,
});

const selectedInformation = ref(props.filters.standardId);
const detailInformation = computed(() => {
    const verified = props.documents.filter(
        (document) => document.status === "Terverifikasi"
    );

    if (props.documents.length === 0) {
        return {
            "Total Dokumen": "-",
            "Terakhir Update": "-",
            Oleh: "-",
            "Dokumen Terverifikasi": "-",
            "Dokumen Proses Verifikasi": "-",
        };
    }

    return {
        "Total Dokumen": props.documents.length,
        "Terakhir Update": props.documents[0].updated_at,
        Oleh: props.documents[0].user.name,
        "Dokumen Proses Verifikasi": props.documents.length - verified.length,
        "Dokumen Terverifikasi": verified.length,
    };
});

const user = computed(() => {
    return usePage().props.auth.user;
});

watch(selectedInformation, (newValue) => {
    router.get(
        route("documents.index"),
        {
            standardId: newValue,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
});

function handleDoubleClick(standardNumber) {
    router.get(route("documents.subs.index", standardNumber));
}
</script>

<template>
    <AppLayout title="Seluruh Dokumen">
        <main class="grid grid-cols-6 items-start gap-5">
            <Card header class="col-span-6 lg:col-span-4">
                <template #header>
                    <CardHeading>
                        <template #title>Standar</template>
                        <template #description>
                            <span v-if="user.major_name">
                                Seluruh standar yang tersedia pada program studi
                                <strong>{{ user.major_name }}</strong>
                            </span>
                            <span v-else>
                                Seluruh standar yang tersedia di dalam sistem.
                            </span>
                        </template>
                    </CardHeading>
                </template>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    <div
                        class="flex select-none rounded border p-2 hover:cursor-pointer hover:border hover:border-gray-300"
                        v-for="standard in standards"
                        :key="standard.id"
                        @click="selectedInformation = standard.id"
                        @dblclick="() => handleDoubleClick(standard.number)"
                        :class="
                            selectedInformation == standard.id
                                ? 'border-gray-300'
                                : 'border-transparent'
                        "
                    >
                        <div class="mr-4 flex-shrink-0 self-center">
                            <FolderIcon
                                class="h-8 w-8 bg-white text-gray-800"
                            />
                        </div>
                        <div class="self-center">
                            <h4 class="text-sm text-gray-500">
                                {{ standard.name }}
                            </h4>
                        </div>
                    </div>
                </div>
            </Card>
            <Card header class="col-span-6 lg:col-span-2">
                <template #header>
                    <CardHeading>
                        <template #title>
                            {{ standards[selectedInformation - 1].name }}
                        </template>
                        <template #description>
                            {{ standards[selectedInformation - 1].description }}
                        </template>
                    </CardHeading>
                </template>
                <div>
                    <div>
                        <h3 class="font-medium text-gray-900">
                            Informasi Standar
                        </h3>
                        <dl
                            class="mt-2 divide-y divide-gray-200 border-t border-b border-gray-200"
                        >
                            <div
                                v-for="(value, key) in detailInformation"
                                :key="key"
                                class="flex justify-between py-3 text-sm font-medium"
                            >
                                <dt class="text-gray-500">{{ key }}</dt>
                                <dd class="text-gray-900">
                                    {{ value }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </Card>
        </main>
    </AppLayout>
</template>
