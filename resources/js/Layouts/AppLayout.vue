<script setup>
import { Head } from "@inertiajs/vue3";
import NotificationList from "../Components/NotificationList.vue";
import Sidebar from "../Components/Sidebar.vue";
import TopBar from "../Components/TopBar.vue";
import { ref } from "vue";
import PageHeader from "../Components/PageHeader.vue";
import Breadcrumb from "../Components/Breadcrumb.vue";

const sidebarOpen = ref(false);

defineProps({
    title: String,
});
</script>

<template>
    <Head>
        <title>{{ title }}</title>
    </Head>

    <Teleport to="body">
        <NotificationList />
    </Teleport>

    <Sidebar v-model="sidebarOpen" />

    <div class="md:pl-64">
        <div class="flex w-full flex-col xl:px-0">
            <TopBar v-model="sidebarOpen" />
            <PageHeader />

            <Breadcrumb />

            <main
                class="lg:max-w-8xl w-full flex-1 px-4 sm:px-6 lg:mx-auto lg:px-8"
            >
                <div class="py-6">
                    <div class="sm:px-6 md:px-0">
                        <!-- Replace with your content -->
                        <slot />
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
