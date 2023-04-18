<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";
import TextInput from "../../Components/TextInput.vue";
import TextLabel from "../../Components/TextLabel.vue";
import SelectOption from "../../Components/SelectOption.vue";
import AlertFormError from "../../Components/AlertFormError.vue";

defineProps({
    majors: Array,
});

const form = useForm({
    name: "",
    email: "",
    major_id: 0,
    roles: [],
});

watch(
    () => form.major_id,
    () => {
        form.reset("roles");
    }
);

const handleSubmit = () => {
    if (form.processing) {
        return false;
    }
    form.post(route("users.store"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Tambahkan Pengguna">
        <AlertFormError
            :errors="$page.props.errors"
            v-if="Object.keys($page.props.errors).length > 0"
        />
        <form
            class="space-y-8 divide-y divide-gray-200 mt-2 bg-white p-5 rounded shadow"
            @submit.prevent="handleSubmit"
        >
            <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                <div>
                    <div class="space-y-6 sm:space-y-5">
                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Informasi Dasar
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Informasi dasar yang perlu diisi meliputi nama
                                lengkap dan email. Pastikan untuk mengisi
                                informasi yang benar dan valid agar dapat
                                digunakan untuk login ke sistem.
                            </p>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                        >
                            <TextLabel
                                for="name"
                                class="block sm:mt-px sm:pt-2"
                            >
                                Nama
                            </TextLabel>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <TextInput
                                    class="w-full max-w-sm"
                                    id="name"
                                    name="name"
                                    type="text"
                                    v-model="form.name"
                                />
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                        >
                            <TextLabel
                                for="email"
                                class="block sm:mt-px sm:pt-2"
                            >
                                Email
                            </TextLabel>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <TextInput
                                    type="email"
                                    class="w-full max-w-md"
                                    id="email"
                                    name="email"
                                    v-model="form.email"
                                />
                                <p class="mt-3 max-w-md text-sm text-gray-500">
                                    Pastikan email yang akan didaftarkan benar,
                                    karena password pengguna akan dikirimkan
                                    melalui email pengguna yang terdaftar.
                                </p>
                            </div>
                        </div>

                        <div
                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                        >
                            <TextLabel
                                for="major_id"
                                class="block sm:mt-px sm:pt-2"
                            >
                                Program Studi
                            </TextLabel>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <SelectOption
                                    v-model="form.major_id"
                                    name="major_id"
                                    id="major_id"
                                    :options="majors"
                                    :with-space="true"
                                />
                                <p class="mt-3 max-w-sm text-sm text-gray-500">
                                    Kosongkan program studi jika pengguna tidak
                                    terkait dengan program studi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="space-y-6 divide-y divide-gray-200 pt-8 sm:space-y-5 sm:pt-10"
                >
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Hak Akses
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Anda dapat menambahkan pengguna baru ke sistem dan
                            memberikan hak akses yang sesuai dengan tugas dan
                            tanggung jawab mereka.
                        </p>
                    </div>
                    <div
                        class="space-y-6 divide-y divide-gray-200 sm:space-y-5"
                    >
                        <div class="pt-6 sm:pt-5">
                            <div role="group" aria-labelledby="label-email">
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4"
                                >
                                    <div>
                                        <TextLabel for="role">
                                            Jabatan</TextLabel
                                        >
                                    </div>
                                    <div class="mt-4 sm:col-span-2 sm:mt-0">
                                        <div class="max-w-lg space-y-4">
                                            <div
                                                class="relative flex items-start"
                                                v-if="
                                                    $page.props.auth.permissions.includes(
                                                        'store user operator'
                                                    ) && form.major_id === 0
                                                "
                                            >
                                                <div
                                                    class="flex h-5 items-center"
                                                >
                                                    <input
                                                        type="checkbox"
                                                        name="operator"
                                                        id="operator"
                                                        value="operator"
                                                        v-model="form.roles"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    />
                                                </div>
                                                <label
                                                    class="ml-3 text-sm"
                                                    for="operator"
                                                >
                                                    <span
                                                        class="block font-medium text-gray-700"
                                                        >Operator</span
                                                    >
                                                    <span class="text-gray-500">
                                                        Memiliki hak akses pada
                                                        keseluruhan sistem.
                                                    </span>
                                                </label>
                                            </div>
                                            <div>
                                                <div
                                                    class="relative flex items-start"
                                                    v-if="form.major_id === 0"
                                                >
                                                    <div
                                                        class="flex h-5 items-center"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            name="dekan"
                                                            id="dekan"
                                                            value="dekan"
                                                            v-model="form.roles"
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                        />
                                                    </div>
                                                    <label
                                                        class="ml-3 text-sm"
                                                        for="dekan"
                                                    >
                                                        <span
                                                            class="block font-medium text-gray-700"
                                                            >Dekan</span
                                                        >
                                                        <span
                                                            class="text-gray-500"
                                                        >
                                                            Memiliki hak akses
                                                            pada keseluruhan
                                                            program studi akan
                                                            tetapi tidak bisa
                                                            menambahkan pengguna
                                                            baru.
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div
                                                    class="relative flex items-start"
                                                    v-if="form.major_id !== 0"
                                                >
                                                    <div
                                                        class="flex h-5 items-center"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            name="kaprodi"
                                                            id="kaprodi"
                                                            value="kaprodi"
                                                            v-model="form.roles"
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                        />
                                                    </div>
                                                    <label
                                                        class="ml-3 text-sm"
                                                        for="kaprodi"
                                                    >
                                                        <span
                                                            class="block font-medium text-gray-700"
                                                            >Ketua Program
                                                            Studi</span
                                                        >
                                                        <span
                                                            class="text-gray-500"
                                                        >
                                                            Memiliki hak akses
                                                            penuh pada program
                                                            studinya sendiri.
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div
                                                    class="relative flex items-start"
                                                    v-if="form.major_id !== 0"
                                                >
                                                    <div
                                                        class="flex h-5 items-center"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            name="dosen"
                                                            id="dosen"
                                                            value="dosen"
                                                            v-model="form.roles"
                                                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                        />
                                                    </div>
                                                    <label
                                                        class="ml-3 text-sm"
                                                        for="dosen"
                                                    >
                                                        <span
                                                            class="block font-medium text-gray-700"
                                                            >Dosen</span
                                                        >
                                                        <span
                                                            class="text-gray-500"
                                                        >
                                                            Memiliki hak akses
                                                            terbatas pada
                                                            sistem.
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button
                        type="button"
                        @click="() => form.reset()"
                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Clear
                    </button>
                    <button
                        type="submit"
                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>
