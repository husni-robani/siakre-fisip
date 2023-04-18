<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { useConfirmDialog } from "@vueuse/core";
import { ref } from "vue";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";
import Card from "../../Components/Card.vue";
import CardHeading from "../../Components/CardHeading.vue";
import AlertFormError from "../../Components/AlertFormError.vue";
import TextLabel from "../../Components/TextLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import TextArea from "../../Components/TextArea.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SelectOption from "../../Components/SelectOption.vue";

defineProps({
    standards: Array,
});

const form = useForm({
    standard_id: null,
    name: "",
    number: "",
    description: "",
});

const storeRevealed = ref(false);
const storeModalDialog = useConfirmDialog(storeRevealed);
storeModalDialog.onConfirm(() => {
    form.post(route('subs.store'));
});
</script>

<template>
    <AppLayout title="Tambah Sub">
        <Teleport to="body">
            <ModalConfirmation
                v-model="storeRevealed"
                :confirm="storeModalDialog.confirm"
                :cancel="storeModalDialog.cancel"
            />
        </Teleport>
        <Card class="max-w-xl" header>
            <template #header>
                <CardHeading>
                    <template #title>Tambah Sub</template>
                    <template #description>
                        Silahkan tambahkan sub baru dengan teliti agar pengguna
                        yang lain nyaman.
                    </template>
                </CardHeading>
            </template>
            <AlertFormError
                :errors="$page.props.errors"
                v-if="Object.keys($page.props.errors).length > 0"
            />
            <form
                @submit.prevent="storeModalDialog.reveal()"
                class="flex w-full flex-col space-y-3"
            >
                <div class="w-full">
                    <TextLabel for="standard_id">Standar</TextLabel>
                    <SelectOption
                        name="standard_id"
                        for="standard_id"
                        class="w-full block"
                        v-model="form.standard_id"
                        :options="standards"
                        :with-space="true"
                    />
                </div>
                <div class="w-full">
                    <TextLabel for="name">Nama Sub</TextLabel>
                    <TextInput
                        v-model="form.name"
                        id="name"
                        name="name"
                        type="text"
                        class="block w-full"
                    />
                </div>
                <div class="w-full max-w-sm">
                    <TextLabel for="number">Nomor Sub</TextLabel>
                    <TextInput
                        v-model="form.number"
                        id="number"
                        name="number"
                        type="text"
                        class="block w-full"
                    />
                </div>
                <div>
                    <TextLabel for="description" v-model="form.description"
                        >Deskripsi Sub
                    </TextLabel>
                    <TextArea
                        name="description"
                        v-model="form.description"
                        id="description"
                    />
                </div>
                <div class="flex justify-end">
                    <PrimaryButton type="submit">Update</PrimaryButton>
                </div>
            </form>
        </Card>
    </AppLayout>
</template>
