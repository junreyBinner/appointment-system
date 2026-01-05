<script setup>
import { useForm } from "@inertiajs/vue3";
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({ email: String });

const form = useForm({
    email: props.email,
    otp: "",
});

const submit = () => {
    form.post(route("otp.verify.submit"));
};
</script>

<template>
    <GuestLayout>
        <h2 class="text-2xl font-bold mb-4">Verify your email</h2>

        <p class="text-sm text-gray-600 mb-4">
            We sent a 6-digit code to <b>{{ email }}</b>
        </p>

        <form @submit.prevent="submit" class="space-y-4">
            <input
                type="text"
                v-model="form.otp"
                placeholder="Enter OTP"
                class="w-full text-center tracking-widest text-xl border rounded-lg p-3"
                maxlength="6"
            />

            <PrimaryButton class="w-full"> Verify </PrimaryButton>

            <button
                @click.prevent="form.post(route('otp.resend'))"
                class="text-sm text-blue-600 hover:underline"
            >
                Resend OTP
            </button>
        </form>
    </GuestLayout>
</template>
