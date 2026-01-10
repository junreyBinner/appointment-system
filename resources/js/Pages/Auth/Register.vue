<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <h2 class="text-3xl font-bold text-gray-900 mb-6">Create Account</h2>

        <form @submit.prevent="submit" class="space-y-4">
            <!-- Name -->
            <div class="relative">
                <span
                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                >
                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10z" />
                        <path
                            fill-rule="evenodd"
                            d="M2 20a10 10 0 0120 0H2z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>

                <TextInput
                    id="name"
                    type="text"
                    placeholder="Your Name"
                    class="w-full pl-10 bg-white"
                    v-model="form.name"
                    required
                    autofocus
                />
                <InputError class="mt-1" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div class="relative">
                <span
                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                >
                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            d="M2 6a2 2 0 012-2h16a2 2 0 012 2v.01L12 13 2 6.01V6z"
                        />
                        <path
                            d="M2 8l10 7 10-7V18a2 2 0 01-2 2H4a2 2 0 01-2-2V8z"
                        />
                    </svg>
                </span>

                <TextInput
                    id="email"
                    type="email"
                    placeholder="Your Email"
                    class="w-full pl-10 bg-white"
                    v-model="form.email"
                    required
                />
                <InputError class="mt-1" :message="form.errors.email" />
            </div>

            <!-- Password -->
            <div class="relative">
                <span
                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                >
                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M12 1a5 5 0 00-5 5v3H6a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2v-9a2 2 0 00-2-2h-1V6a5 5 0 00-5-5zm-3 8V6a3 3 0 116 0v3H9z"
                            clip-rule="evenodd"
                        />
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

            <!-- Confirm Password -->
            <div class="relative">
                <span
                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                >
                    <svg
                        class="w-5 h-5"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M12 1a5 5 0 00-5 5v3H6a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2v-9a2 2 0 00-2-2h-1V6a5 5 0 00-5-5zm-3 8V6a3 3 0 116 0v3H9z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>

                <TextInput
                    id="password_confirmation"
                    type="password"
                    placeholder="Repeat your password"
                    class="w-full pl-10"
                    v-model="form.password_confirmation"
                    required
                />
                <InputError
                    class="mt-1"
                    :message="form.errors.password_confirmation"
                />
            </div>
            <!-- Terms -->
            <div class="flex items-center text-sm text-gray-600">
                <input
                    type="checkbox"
                    required
                    class="rounded border-gray-300"
                />
                <span class="ml-2">
                    I agree all statements in
                    <a href="#" class="text-blue-600 hover:underline">
                        Terms of service
                    </a>
                </span>
            </div>

            <!-- Button -->
            <PrimaryButton
                class="w-full justify-center mt-4 bg-blue-600 hover:bg-blue-700"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Create Account
            </PrimaryButton>

            <p class="text-center text-sm text-gray-600 mt-4">
                Already have an account?
                <Link
                    :href="route('login')"
                    class="text-blue-600 hover:underline"
                >
                    Sign in
                </Link>
            </p>
        </form>
    </GuestLayout>
</template>
