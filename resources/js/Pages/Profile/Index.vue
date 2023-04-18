<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import TextLabel from "../../Components/TextLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import SelectOption from "../../Components/SelectOption.vue";
import { useForm } from "@inertiajs/vue3";
import AlertFormError from "../../Components/AlertFormError.vue";
import { useConfirmDialog } from "@vueuse/core";
import { ref } from "vue";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";

const props = defineProps({
    user: Object,
    majors: Array,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    major_id: props.user.major ? props.user.major_id : 0,
});

const formPassword = useForm({
    password: "",
    newPassword: "",
    confirmPassword: "",
});

const handleSubmit = () => {
    form.patch(route("profile.update"));
};

const handleSubmitPassword = () => {
    formPassword.patch(route("profile.password"), {
        onSuccess: () => formPassword.reset(),
    });
};

const profileRevealed = ref(false);
const profileModalDialog = useConfirmDialog(profileRevealed);
profileModalDialog.onConfirm(() => {
    handleSubmit();
});

const passwordRevealed = ref(false);
const passwordModalDialog = useConfirmDialog(passwordRevealed);
passwordModalDialog.onConfirm(() => {
    handleSubmitPassword();
});
</script>

<template>
    <AppLayout title="Profile">
        <Teleport to="body">
            <ModalConfirmation
                v-model="profileRevealed"
                :cancel="profileModalDialog.cancel"
                :confirm="profileModalDialog.confirm"
            />
        </Teleport>
        <AlertFormError
            class="mb-5"
            :errors="$page.props.errors"
            v-if="Object.keys($page.props.errors).length > 0"
        />
        <div class="overflow-hidden rounded-md bg-white p-5 shadow">
            <form
                @submit.prevent="profileModalDialog.reveal"
                class="space-y-8 divide-y divide-gray-200"
            >
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div>
                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Informasi Dasar
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Informasi Dasar pengguna meliputi nama, email
                                dan program studi.
                            </p>
                        </div>

                        <div class="mt-6 space-y-6 sm:mt-5 sm:space-y-5">
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <TextLabel
                                    for="name"
                                    class="block sm:mt-px sm:pt-2"
                                >
                                    Nama
                                </TextLabel>
                                <TextInput
                                    id="name"
                                    name="name"
                                    type="text"
                                    v-model="form.name"
                                />
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
                                <TextInput
                                    id="email"
                                    type="email"
                                    name="email"
                                    v-model="form.email"
                                    class="block w-full"
                                />
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <TextLabel for="major_id" block sm:mt-px sm:pt-2
                                    >Program Studi
                                </TextLabel>
                                <SelectOption
                                    v-model="form.major_id"
                                    disabled
                                    :options="majors"
                                    name="major_id"
                                    id="major_id"
                                    class="block w-full disabled:opacity-30"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-5 overflow-hidden rounded-md bg-white p-5 shadow">
            <form
                @submit.prevent="handleSubmitPassword"
                class="space-y-8 divide-y divide-gray-200"
            >
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div>
                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Update Password
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Pastikan password baru anda lebih aman dari
                                password sebelumnya.
                            </p>
                        </div>

                        <div class="mt-6 space-y-6 sm:mt-5 sm:space-y-5">
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <TextLabel
                                    for="password"
                                    class="block sm:mt-px sm:pt-2"
                                >
                                    Password Saat Ini
                                </TextLabel>
                                <TextInput
                                    id="password"
                                    name="password"
                                    v-model="formPassword.password"
                                    type="password"
                                />
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <TextLabel
                                    for="newPassword"
                                    class="block sm:mt-px sm:pt-2"
                                >
                                    Password Baru
                                </TextLabel>
                                <TextInput
                                    id="newPassword"
                                    name="newPassword"
                                    v-model="formPassword.newPassword"
                                    type="password"
                                    class="block w-full"
                                />
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <TextLabel
                                    for="confirmPassword"
                                    class="block sm:mt-px sm:pt-2"
                                >
                                    Konfirmasi Password Baru
                                </TextLabel>
                                <TextInput
                                    id="confirmPassword"
                                    name="confirmPassword"
                                    v-model="formPassword.confirmPassword"
                                    type="password"
                                    class="block w-full"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
