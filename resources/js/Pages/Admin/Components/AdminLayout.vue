<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Navbar -->
        <Navbar />
        <!-- NavbarEnd -->

        <!-- Sidebar -->

        <Sidebar />

        <slot />
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Sidebar from "../Components/Sidebar.vue";
import Navbar from "../Components/Navbar.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
