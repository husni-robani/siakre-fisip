<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import StepperForm from "../../Components/StepperForm.vue";
import { computed, ref, watch } from "vue";
import CardHeading from "../../Components/CardHeading.vue";
import Card from "../../Components/Card.vue";
import TextLabel from "../../Components/TextLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SelectOption from "../../Components/SelectOption.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import AlertFormError from "../../Components/AlertFormError.vue";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";
import { useConfirmDialog } from "@vueuse/core";

const props = defineProps({
    standards: Array,
    majors: Array,
    subs: Array,
    filters: Object,
});

const steps = [
    {
        id: 1,
        name: "Informasi Pengguna",
    },
    {
        id: 2,
        name: "Standar & Sub",
    },
    {
        id: 3,
        name: "Informasi Dokumen",
    },
];

const user = computed(() => {
    return usePage().props.auth.user;
});

const status = computed(() => {
    return usePage().props.auth.roles.includes("dosen")
        ? "Proses Verifikasi"
        : "Terverifikasi";
});

const detailUpload = computed(() => {
    const majorName = props.majors.find((major) => major.id === form.major_id);

    const standardName = props.standards.find(
        (standard) => standard.id === form.standard_id
    );

    const subName = props.subs.find((sub) => sub.id === form.sub_id);

    return {
        name: form.user_name,
        major_name: majorName ? majorName.name : "?",
        standard_name: standardName ? standardName.name : "?",
        sub_name: subName ? subName.name : "?",
        title: form.name,
    };
});

const step = ref(1);

const form = useForm({
    standard_id: props.filters.standardId
        ? Number(props.filters.standardId)
        : null,
    sub_id: null,
    user_name: user.value.name,
    user_email: user.value.email,
    major_id: user.value.major_id ? user.value.major_id : null,
    status: status.value,
    name: "",
    file: null,
});

watch(
    () => form.standard_id,
    (newValue) => {
        form.reset("sub_id");
        router.get(
            route("documents.create"),
            {
                standardId: newValue,
            },
            { preserveState: true }
        );
    }
);

function handleSubmit() {
    form.post(route("documents.store"), {
        onSuccess: () => {
            form.reset();
            step.value = 1;
        },
    });
}

const storeRevealed = ref(false);
const storeConfirmDialog = useConfirmDialog(storeRevealed);
storeConfirmDialog.onConfirm(() => {
    handleSubmit();
});
</script>

<template>
    <AppLayout title="Tambah Dokumen">
        <Teleport to="body">
            <ModalConfirmation
                v-model="storeRevealed"
                :confirm="storeConfirmDialog.confirm"
                :cancel="storeConfirmDialog.cancel"
            />
        </Teleport>
        <div class="grid grid-cols-6 gap-5">
            <div class="col-span-6 space-y-5 md:col-span-4">
                <AlertFormError
                    :errors="$page.props.errors"
                    v-if="Object.keys($page.props.errors).length > 0"
                />
                <Card header>
                    <template #header>
                        <CardHeading>
                            <template #title>Upload Dokumen Baru</template>
                            <template #description>
                                Ikuti beberapa langkah dibawah ini untuk
                                melakukan upload dokumen baru.
                            </template>
                        </CardHeading>
                    </template>
                    <!-- Stepper Form -->
                    <StepperForm
                        :now="step"
                        :steps="steps"
                        @change-step="(number) => (step = number)"
                    />
                    <form
                        class="transition-all duration-500"
                        @submit.prevent="storeConfirmDialog.reveal"
                    >
                        <TransitionGroup
                            tag="div"
                            enter-active-class="transform transition ease-in-out duration-700"
                            enter-from-class="translate-x-full"
                            enter-to-class="translate-x-0"
                            leave-active-class="transform transition ease-in-out duration-700"
                            leave-from-class="translate-x-0"
                            leave-to-class="translate-x-full"
                        >
                            <div v-if="step === 1" :key="1">
                                <div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Hal yang perlu untuk diperhatikan pada
                                        informasi pengguna adalah Nama Lengkap,
                                        Email dan Program Studi. Pastikan
                                        seluruh data yang ada sesuai dengan
                                        profile pengguna anda.
                                    </p>
                                </div>

                                <div
                                    class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                                >
                                    <div class="sm:col-span-3">
                                        <TextLabel for="name" class="block"
                                            >Nama Lengkap
                                        </TextLabel>
                                        <div class="mt-1">
                                            <TextInput
                                                disabled
                                                v-model="form.user_name"
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="block w-full disabled:opacity-30"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <TextLabel for="email" class="block"
                                            >Email
                                        </TextLabel>
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.user_email"
                                                disabled
                                                type="email"
                                                name="name"
                                                id="name"
                                                class="block w-full disabled:opacity-30"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <TextLabel for="major_id" class="block">
                                            Program Studi
                                        </TextLabel>
                                        <div class="mt-1">
                                            <SelectOption
                                                v-model="form.major_id"
                                                :disabled="
                                                    user.major_id !== null
                                                "
                                                class="block w-full disabled:opacity-30"
                                                :options="majors"
                                                with-space
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="step === 2" :key="2">
                                <div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Silahkan pilih standar dan sub yang
                                        sesuai dengan dokumen yang akan di
                                        upload.
                                    </p>
                                </div>
                                <div
                                    class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                                >
                                    <div class="sm:col-span-3">
                                        <TextLabel
                                            for="standard_id"
                                            class="block"
                                        >
                                            Standar
                                        </TextLabel>
                                        <div class="mt-1">
                                            <SelectOption
                                                class="block w-full"
                                                :options="standards"
                                                with-space
                                                v-model="form.standard_id"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <TextLabel
                                            for="standard_id"
                                            class="block"
                                        >
                                            Sub Standar
                                        </TextLabel>
                                        <div class="mt-1">
                                            <SelectOption
                                                v-model="form.sub_id"
                                                class="block w-full"
                                                :options="subs"
                                                with-space
                                            />
                                        </div>
                                    </div>
                                    <p
                                        class="col-span-4 mt-2 text-sm text-gray-500"
                                    >
                                        Jika standar dan sub yang akan di upload
                                        tidak tersedia, silahkan hubungi
                                        <strong>operator</strong> terkait.
                                    </p>
                                </div>
                            </div>

                            <div v-if="step === 3" :key="3">
                                <div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Silahkan beri nama dokumen dan upload
                                        file lampiran yang akan dimasukan ke
                                        dalam sistem.
                                    </p>
                                </div>
                                <div
                                    class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                                >
                                    <div class="sm:col-span-3">
                                        <TextLabel for="name" class="block"
                                            >Judul Dokumen
                                        </TextLabel>
                                        <div class="mt-1">
                                            <TextInput
                                                v-model="form.name"
                                                type="text"
                                                name="name"
                                                id="name"
                                                class="block w-full"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <TextLabel for="file" class=""
                                            >File
                                        </TextLabel>
                                        <div class="mt-1">
                                            <input
                                                type="file"
                                                name="file"
                                                id="file"
                                                @input="
                                                    form.file =
                                                        $event.target.files[0]
                                                "
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </TransitionGroup>
                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button
                                    type="button"
                                    v-if="step > 1"
                                    @click="step--"
                                    class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    Kembali
                                </button>
                                <PrimaryButton
                                    type="button"
                                    v-if="step < 3"
                                    @click="step++"
                                    class="ml-3"
                                >
                                    Berikutnya
                                </PrimaryButton>
                                <PrimaryButton
                                    type="submit"
                                    v-if="step === 3"
                                    class="ml-3"
                                >
                                    Upload
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </Card>
            </div>

            <!-- Sideform -->
            <div class="col-span-6 md:col-span-2">
                <Card header>
                    <template #header>
                        <CardHeading>
                            <template #title>Detail Upload</template>
                            <template #description>
                                Ulasan singkat formulir upload dokumen baru.
                            </template>
                        </CardHeading>
                    </template>
                    <div class="sm:flex">
                        <p class="text-sm text-gray-500">
                            Nama <strong>{{ detailUpload.name }}</strong> akan
                            melakukan upload dokumen baru ke program studi
                            <strong> {{ detailUpload.major_name }}</strong> pada
                            standar
                            <strong>{{ detailUpload.standard_name }}</strong>
                            dengan sub
                            <strong>{{ detailUpload.sub_name }}</strong> dengan
                            judul dokumen
                            <strong>{{ detailUpload.title }}</strong>
                        </p>
                    </div>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
