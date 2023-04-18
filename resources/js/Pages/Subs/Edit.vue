<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import CardHeading from "../../Components/CardHeading.vue";
import TextLabel from "../../Components/TextLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import TextArea from "../../Components/TextArea.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { useConfirmDialog } from "@vueuse/core";
import { ref } from "vue";
import ModalConfirmation from "../../Components/ModalConfirmation.vue";
import AlertFormError from "../../Components/AlertFormError.vue";

const props = defineProps({
    sub: Object,
});

const form = useForm({
    name: props.sub.name,
    number: props.sub.number,
    description: props.sub.description,
});

const updateRevealed = ref(false);
const updateModalDialog = useConfirmDialog(updateRevealed);
updateModalDialog.onConfirm(() => {
    form.patch(route("subs.update", props.sub.number));
});
</script>

<template>
    <AppLayout title="Edit Sub">
        <Teleport to="body">
            <ModalConfirmation
                v-model="updateRevealed"
                :confirm="updateModalDialog.confirm"
                :cancel="updateModalDialog.cancel"
            />
        </Teleport>
        <Card class="max-w-xl" header>
            <template #header>
                <CardHeading>
                    <template #title>Update Sub {{ sub.number }}</template>
                    <template #description
                        >Lakukan sesuai dengan yang anda harapkan dan lakukan
                        pengecekan kembali demi kenyamanan pengguna lain di
                        sistem.
                    </template>
                </CardHeading>
            </template>
            <AlertFormError
                :errors="$page.props.errors"
                v-if="Object.keys($page.props.errors).length > 0"
            />
            <form
                @submit.prevent="updateModalDialog.reveal()"
                class="flex w-full flex-col space-y-3"
            >
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
                        class="block w-full disabled:opacity-30"
                        disabled
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
