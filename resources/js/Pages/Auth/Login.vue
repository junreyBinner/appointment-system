<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Sign in
        </h2>

        <div v-if="status" class="mb-4 text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">

            <!-- Email -->
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <!-- email icon -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 6a2 2 0 012-2h16a2 2 0 012 2v.01L12 13 2 6.01V6z"/>
                        <path d="M2 8l10 7 10-7V18a2 2 0 01-2 2H4a2 2 0 01-2-2V8z"/>
                    </svg>
                </span>

                <TextInput
                    id="email"
                    type="email"
                    placeholder="Your Email"
                    class="w-full pl-10 bg-white"
                    v-model="form.email"
                    required
                    autofocus
                />
                <InputError class="mt-1" :message="form.errors.email" />
            </div>

            <!-- Password -->
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <!-- lock icon -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12 1a5 5 0 00-5 5v3H6a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2v-9a2 2 0 00-2-2h-1V6a5 5 0 00-5-5zm-3 8V6a3 3 0 116 0v3H9z"
                            clip-rule="evenodd"/>
                    </svg>
                </span>

                <TextInput
                    id="password"
                    type="password"
                    placeholder="Password"
                    class="w-full pl-10 bg-white"
                    v-model="form.password"
                    required
                />
                <InputError class="mt-1" :message="form.errors.password" />
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between text-sm text-gray-600">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" />
                    <span class="ml-2">Remember me</span>
                </label>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-blue-600 hover:underline"
                >
                    Forgot password?
                </Link>
            </div>

            <!-- Button -->
            <PrimaryButton
                class="w-full justify-center mt-4 bg-blue-600 hover:bg-blue-700"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Sign in
            </PrimaryButton>

            <!-- Register link -->
            <p class="text-center text-sm text-gray-600 mt-4">
                Don’t have an account?
                <Link
                    :href="route('register')"
                    class="text-blue-600 hover:underline"
                >
                    Sign up
                </Link>
            </p>
        </form>
    </GuestLayout>
</template>

