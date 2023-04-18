<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { router, usePage, Link } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";
import { useConfirmDialog } from "@vueuse/core";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";
import Pagination from "../../Components/Pagination.vue";
import SelectOption from "../../Components/SelectOption.vue";
import PrimaryLink from "../../Components/PrimaryLink.vue";

const props = defineProps({
    subs: Object,
    standards: Array,
    filters: Object,
});

const permissions = computed(() => {
    return usePage().props.auth.permissions;
});

const standardId = ref(Number(props.filters.standardId));

const deleteSelected = ref(null);
const deleteRevealed = ref(false);
const deleteModalDialog = useConfirmDialog(deleteRevealed);
deleteModalDialog.onConfirm(() => {
    router.delete(route("subs.destroy", deleteSelected.value));
});
deleteModalDialog.onReveal((id) => {
    deleteSelected.value = id;
});

watch(standardId, (newValue) => {
    router.get(
        route("subs.index"),
        {
            standardId: standardId.value,
        },
        {
            preserveState: true,
        }
    );
});
</script>

<template>
    <AppLayout title="Sub Standar">
        <Teleport to="body">
            <ModalConfirmation
                :confirm="deleteModalDialog.confirm"
                :cancel="deleteModalDialog.cancel"
                v-model="deleteRevealed"
            />
        </Teleport>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Sub</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Seluruh sub yang tersedia pada sistem.
                </p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <PrimaryLink
                    method="GET"
                    :href="route('subs.create')"
                    v-if="permissions.includes('store sub')"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                >
                    Tambahkan Sub
                </PrimaryLink>
            </div>
        </div>
        <div class="mt-3 flex w-full max-w-sm">
            <SelectOption
                v-model="standardId"
                id="standard_id"
                name="standard_id"
                :options="standards"
                :with-space="true"
            />
        </div>
        <div
            class="-mx-4 mt-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg"
        >
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                        >
                            Nomor Sub
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
                        ></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr
                        v-for="sub in subs.data"
                        :key="sub.id"
                        v-if="subs.data.length > 0"
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
                            class="space-x-3 py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                        >
                            <Link
                                method="GET"
                                v-if="permissions.includes('update sub')"
                                :href="route('subs.edit', sub.number)"
                                class="cursor-pointer text-yellow-600 hover:text-yellow-900"
                            >
                                Ubah
                            </Link>
                            <span
                                v-if="permissions.includes('delete sub')"
                                class="cursor-pointer text-red-600 hover:text-red-900"
                                @click="
                                    () => deleteModalDialog.reveal(sub.number)
                                "
                                >Hapus</span
                            >
                        </td>
                    </tr>
                    <tr v-else>
                        <td
                            colspan="3"
                            class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6"
                        >
                            Tidak ada sub pada standar ini.
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data="subs" />
        </div>
    </AppLayout>
</template>
