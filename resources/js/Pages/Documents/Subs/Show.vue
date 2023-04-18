<script setup>
import AppLayout from "../../../Layouts/AppLayout.vue";
import Card from "../../../Components/Card.vue";
import { PaperClipIcon } from "@heroicons/vue/24/outline";
import { computed, ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { useConfirmDialog } from "@vueuse/core";
import ModalConfirmation from "../../../Components/ModalConfirmation.vue";
import CardHeading from "../../../Components/CardHeading.vue";

defineProps({
    standard: Object,
    sub: Object,
    documents: Array,
    timelines: Array,
});

const permissions = computed(() => {
    return usePage().props.auth.permissions;
});

const user = computed(() => {
    return usePage().props.auth.user;
});

const selectedDelete = ref(null);
const deleteRevealed = ref(false);
const deleteConfirmDialog = useConfirmDialog(deleteRevealed);
deleteConfirmDialog.onConfirm(() => {
    router.delete(route("documents.subs.destroy", selectedDelete.value));
});
deleteConfirmDialog.onReveal((documentId) => {
    selectedDelete.value = documentId;
});
deleteConfirmDialog.onCancel(() => {
    selectedDelete.value = null;
});
</script>

<template>
    <AppLayout :title="sub.name">
        <Teleport to="body">
            <ModalConfirmation
                :cancel="deleteConfirmDialog.cancel"
                :confirm="deleteConfirmDialog.confirm"
                v-model="deleteRevealed"
            />
        </Teleport>
        <div class="grid grid-cols-6 items-start gap-5">
            <Card header class="col-span-6 sm:col-span-4">
                <template #header>
                    <CardHeading>
                        <template #title>Detail Sub {{ sub.number }}</template>
                        <template #description>
                            Seluruh dokumen yang ada pada sub {{ sub.number }}.
                        </template>
                    </CardHeading>
                </template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Nomor Butir
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ sub.number }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Nama Sub
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ sub.name }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Total Dokumen
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ documents.length }}
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">
                            Deskripsi Tentang Sub
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ sub.description }}
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">
                            List Dokumen
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul
                                v-if="documents.length > 0"
                                role="list"
                                class="divide-y divide-gray-200 rounded-md border border-gray-200"
                            >
                                <li
                                    v-for="document in documents"
                                    :key="document.id"
                                    class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
                                >
                                    <div class="flex w-0 flex-1 items-center">
                                        <PaperClipIcon
                                            class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            aria-hidden="true"
                                        />
                                        <span class="ml-2 w-0 flex-1 truncate">
                                            {{ document.name }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0 space-x-3">
                                        <span
                                            v-if="
                                                permissions.includes(
                                                    'delete document'
                                                ) ||
                                                document.user_id === user.id
                                            "
                                            @click="
                                                deleteConfirmDialog.reveal(
                                                    document.id
                                                )
                                            "
                                            class="cursor-pointer text-red-600 hover:text-red-500"
                                        >
                                            Hapus
                                        </span>
                                        <a
                                            :href="
                                                route('download', document.id)
                                            "
                                            class="font-medium text-blue-600 hover:text-blue-500"
                                        >
                                            Unduh
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </Card>
            <Card header class="col-span-6 sm:col-span-2">
                <template #header>
                    <CardHeading>
                        <template #title>Riwayat Sub</template>
                        <template #description>10 riwayat terbaru pada sub ini</template>
                    </CardHeading>
                </template>
                <div v-if="timelines.length > 0">
                    <ul role="list" class="space-y-3 divide-y">
                        <li v-for="timeline in timelines" :key="timeline.id">
                            <div class="flex space-x-3 mt-2">
                                <img
                                    class="h-6 w-6 rounded-full"
                                    :src="`https://ui-avatars.com/api/?name=${timeline.user.name}`"
                                    alt=""
                                />
                                <div class="flex-1 space-y-1">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <h3 class="text-sm font-medium">
                                            {{ timeline.user.name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            {{ timeline.updated_at }}
                                        </p>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ timeline.content }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <p class="text-sm text-gray-500">
                        Tidak ada riwayat pada sub ini.
                    </p>
                </div>
            </Card>
        </div>
    </AppLayout>
</template>
