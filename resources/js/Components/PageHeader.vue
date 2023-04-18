<script setup>
import { BuildingOffice2Icon, CheckCircleIcon } from "@heroicons/vue/20/solid";
import { DocumentArrowUpIcon } from "@heroicons/vue/24/outline";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import PrimaryLink from "./PrimaryLink.vue";
import Badge from "./Badge.vue";

const user = computed(() => {
    return usePage().props.auth.user;
});

const roles = computed(() => {
    return usePage().props.auth.roles;
});
</script>

<template>
    <div class="bg-white shadow">
        <div class="lg:max-w-8xl px-4 sm:px-6 lg:mx-auto lg:px-8 border-b">
            <div
                class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200"
            >
                <div class="min-w-0 flex-1">
                    <div class="flex items-center">
                        <img
                            class="hidden h-16 w-16 rounded-full sm:block"
                            :src="`https://ui-avatars.com/api/?name=${user.name}`"
                            alt=""
                        />
                        <div>
                            <div class="flex items-center">
                                <img
                                    class="h-16 w-16 rounded-full sm:hidden"
                                    :src="`https://ui-avatars.com/api/?name=${user.name}`"
                                    alt=""
                                />
                                <h1
                                    class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9"
                                >
                                    Selamat Datang, {{ user.name }}
                                </h1>
                            </div>
                            <dl
                                class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap"
                            >
                                <dd
                                    class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6"
                                >
                                    <BuildingOffice2Icon
                                        class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                    />
                                    {{
                                        user.major_name
                                            ? user.major_name
                                            : "Tidak Terkait Program Studi"
                                    }}
                                </dd>
                                <dd
                                    class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0"
                                >
                                    <Badge v-for="role in roles" :key="role">{{
                                        role
                                    }}</Badge>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
                    <PrimaryLink
                        v-if="$page.props.auth.permissions.includes('store document')"
                        method="GET"
                        as="button"
                        :href="route('documents.create')"
                    >
                        <DocumentArrowUpIcon
                            class="mr-1.5 h-5 w-5 flex-shrink-0"
                        />
                        Upload Dokumen
                    </PrimaryLink>
                </div>
            </div>
        </div>
    </div>
</template>
