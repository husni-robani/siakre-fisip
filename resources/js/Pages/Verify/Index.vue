<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { useConfirmDialog } from "@vueuse/core";
import { ref } from "vue";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";
import { router } from "@inertiajs/vue3";

defineProps({
    documents: Array,
});

const verifySelected = ref(null);
const verifyRevealed = ref(false);
const verifyModalDialog = useConfirmDialog(verifyRevealed);
verifyModalDialog.onReveal((id) => {
    verifySelected.value = id;
});
verifyModalDialog.onConfirm(() => {
    router.post(route("verify.document", verifySelected.value));
});
</script>

<template>
    <AppLayout title="Verifikasi Dokumen">
        <Teleport to="body">
            <ModalConfirmation
                :confirm="verifyModalDialog.confirm"
                :cancel="verifyModalDialog.cancel"
                v-model="verifyRevealed"
            />
        </Teleport>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">
                    Verifikasi Dokumen
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Seluruh dokumen yang bisa anda verifikasi.
                </p>
            </div>
        </div>
        <div
            class="-mx-4 mt-5 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg"
        >
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                        >
                            Sub
                        </th>
                        <th
                            scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell"
                        >
                            Judul
                        </th>
                        <th
                            scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"
                        >
                            Diupload Oleh
                        </th>
                        <th
                            scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                        >
                            Waktu
                        </th>
                        <th
                            scope="col"
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                        ></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr
                        v-for="document in documents"
                        :key="document.id"
                        v-if="documents.length > 0"
                    >
                        <td
                            class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6"
                        >
                            {{ document.sub.number }}
                            <dl class="font-normal lg:hidden">
                                <dd class="mt-1 truncate text-gray-700">
                                    {{ document.name }}
                                </dd>
                                <dd
                                    class="mt-1 truncate text-gray-500 sm:hidden"
                                >
                                    {{ document.sub.number }}
                                </dd>
                            </dl>
                        </td>
                        <td
                            class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell"
                        >
                            {{ document.name }}
                        </td>
                        <td
                            class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell"
                        >
                            {{ document.user.name }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500">
                            {{ document.updated_at }}
                        </td>
                        <td
                            class="space-x-3 py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                        >
                            <a
                                :href="route('download', document.id)"
                                class="font-medium text-blue-600 hover:text-blue-500"
                            >
                                Unduh
                            </a>

                            <span
                                @click="
                                    () => verifyModalDialog.reveal(document.id)
                                "
                                class="cursor-pointer text-green-600 hover:text-green-500"
                            >
                                Verifikasi
                            </span>
                        </td>
                    </tr>
                    <tr v-else>
                        <td
                            colspan="5"
                            class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6"
                        >
                            Tidak ada dokumen yang perlu diverifikasi.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
