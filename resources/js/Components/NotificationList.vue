<script setup>
import { router, usePage } from "@inertiajs/vue3";
import notification from "@/Stores/notification";
import { computed, ref } from "vue";
import NotificationItem from "./NotificationItem.vue";

const items = ref([]);

function add(notification) {
    items.value.unshift({
        key: Symbol(),
        ...notification,
    });
}

function remove(index) {
    items.value.splice(index, 1);
}

router.on("finish", () => {
    if (usePage().props.flash !== null) {
        add({
            message: usePage().props.flash.message,
            type: usePage().props.flash.type,
            duration: 1000,
        });
    }
});
</script>

<template>
    <div
        aria-live="assertive"
        class="pointer-events-none fixed inset-0 z-50 flex items-end space-y-3 px-4 py-6 sm:items-start sm:p-6"
    >
        <TransitionGroup
            tag="div"
            class="flex w-full flex-col items-center space-y-4 sm:items-end"
            enter-active-class="transform ease-out duration-300 transition"
            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-active-class="transition ease-in duration-300"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <NotificationItem
                :show="items.length > 0"
                v-for="(item, index) in items"
                @remove="remove(index)"
                :key="item.key"
                :message="item.message"
                :type="item.type"
                :duration="item.duration"
            />
        </TransitionGroup>
    </div>
</template>
