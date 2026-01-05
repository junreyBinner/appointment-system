<template>
    <div class="min-h-screen grid grid-cols-1 md:grid-cols-2 bg-[#fafafa]">
        <!-- Left: Form -->
        <div class="flex items-center justify-center px-8">
            <div class="w-full max-w-md">
                <slot />
            </div>
        </div>

        <!-- Right: Image -->
        <div class="hidden md:flex items-center justify-center">
            <img
                src="/images/register-illustration.png"
                alt="Register Illustration"
                class="max-w-lg"
            />
        </div>
    </div>
</template>

<script setup>
</script>
