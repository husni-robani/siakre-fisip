<script setup>
import GuestLayout from "../../Layouts/GuestLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import TextLabel from "../../Components/TextLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import Checkbox from "../../Components/Checkbox.vue";
import TextLink from "../../Components/TextLink.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import AlertFormError from "../../Components/AlertFormError.vue";
import { computed } from "vue";
import ApplicationLogo from "../../Components/ApplicationLogo.vue";

const form = useForm({
    email: "",
    password: "",
    remember: "",
});

function handleSubmit() {
    form.post("/login", {
        onSuccess: () => form.reset(),
        onError: () => form.reset("password"),
    });
}

const errors = computed(() => {
    return usePage().props.errors;
});
</script>

<template>
    <GuestLayout>
        <Head>
            <title>Login</title>
        </Head>
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
                <ApplicationLogo/>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Masuk ke akun anda
                </h2>
                <p class="mt-2 w-full max-w-xs text-sm text-gray-600">
                    Atau jika belum memiliki akun silahkan hubungi admin terkait
                </p>
            </div>

            <div class="mt-2">
                <AlertFormError
                    v-if="Object.keys(errors).length > 0"
                    :errors="errors"
                />
                <div class="mt-3">
                    <form
                        @submit.prevent="handleSubmit"
                        method="POST"
                        class="space-y-6"
                    >
                        <div>
                            <TextLabel for="email" class="block">
                                Email
                            </TextLabel>
                            <div class="mt-1">
                                <TextInput
                                    id="email"
                                    name="email"
                                    type="email"
                                    v-model="form.email"
                                    autocomplete="email"
                                    required=""
                                    class="block w-full"
                                />
                            </div>
                        </div>

                        <div class="space-y-1">
                            <TextLabel for="password" class="block"
                                >Password
                            </TextLabel>
                            <div class="mt-1">
                                <TextInput
                                    for="password"
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="block w-full"
                                />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <Checkbox id="remember" name="remember" />
                                <TextLabel for="remember" class="ml-2 block"
                                    >Ingat saya
                                </TextLabel>
                            </div>

                            <div class="text-sm">
                                <TextLink href="#" method="GET">
                                    Lupa password?
                                </TextLink>
                            </div>
                        </div>

                        <div>
                            <PrimaryButton type="submit" class="w-full">
                                Login
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
