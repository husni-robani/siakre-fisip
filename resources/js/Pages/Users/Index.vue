<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { computed, ref, watch } from "vue";
import { router, usePage, Link } from "@inertiajs/vue3";
import Badge from "../../Components/Badge.vue";
import { useConfirmDialog } from "@vueuse/core";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";
import Pagination from "../../Components/Pagination.vue";
import TextInput from "../../Components/TextInput.vue";

const props = defineProps({
    users: Object,
    filters: Object,
});

const keyword = ref(props.filters.keyword);

const permissions = computed(() => {
    return usePage().props.auth.permissions;
});

const deleteSelected = ref(null);
const deleteRevealed = ref(false);
const deleteModalDialog = useConfirmDialog(deleteRevealed);
deleteModalDialog.onConfirm(() => {
    router.delete(route("users.destroy", deleteSelected.value));
});
deleteModalDialog.onReveal((id) => {
    deleteSelected.value = id;
});

watch(keyword, (newValue) => {
    router.get(
        route("users.index"),
        {
            keyword: newValue,
        },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>

<template>
    <AppLayout title="Pengguna">
        <Teleport to="body">
            <ModalConfirmation
                :cancel="deleteModalDialog.cancel"
                :confirm="deleteModalDialog.confirm"
                v-model="deleteRevealed"
            />
        </Teleport>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Pengguna</h1>
                <p class="mt-2 text-sm text-gray-700">
                    List seluruh pengguna yang ada dan aktif di dalam sistem.
                </p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <Link
                    method="GET"
                    :href="route('users.create')"
                    class="flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Tambahkan Pengguna
                </Link>
            </div>
        </div>
        <div class="mt-3 max-w-sm">
            <TextInput
                id="search"
                placeholder="Pencarian"
                name="search"
                type="text"
                v-model="keyword"
                class="block w-full"
            />
        </div>
        <div class="mt-3 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                >
                    <div
                        class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                    >
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
                                        Program Studi
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Hak Akses
                                    </th>
                                    <th
                                        scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                    ></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6"
                                    >
                                        <div class="flex items-center">
                                            <div
                                                class="h-10 w-10 flex-shrink-0"
                                            >
                                                <img
                                                    class="h-10 w-10 rounded-full"
                                                    :src="`https://ui-avatars.com/api/?name=${user.name}`"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="ml-4">
                                                <div
                                                    class="font-medium text-gray-900"
                                                >
                                                    {{ user.name }}
                                                </div>
                                                <div class="text-gray-500">
                                                    {{ user.email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                    >
                                        <div class="text-gray-900">FISIP</div>
                                        <div class="text-gray-500">
                                            {{
                                                user.major_name
                                                    ? user.major_name
                                                    : "Tidak Terkait"
                                            }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 space-x-2"
                                    >
                                        <Badge
                                            v-for="role in user.roles"
                                            class="capitalize"
                                            :key="role"
                                        >
                                            {{ role }}
                                        </Badge>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                    >
                                        <span
                                            @click="
                                                () =>
                                                    deleteModalDialog.reveal(
                                                        user.id
                                                    )
                                            "
                                            class="cursor-pointer text-red-600 hover:text-red-900"
                                            >Hapus</span
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :data="users" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
