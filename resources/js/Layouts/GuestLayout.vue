<script setup></script>


<template>
    <div class="min-h-screen flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <slot/>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://www.widyatama.ac.id/wp-content/uploads/2016/01/IMG_0252-copy.jpg" alt="" />
        </div>
    </div>
</template>

