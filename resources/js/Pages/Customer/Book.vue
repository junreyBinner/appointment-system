<template>
    <AuthenticatedLayout>
        <div
            class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8 px-4 sm:px-6 lg:px-8"
        >
            <div class="max-w-2xl mx-auto">
                <!-- Header Card -->
                <div
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl p-6 mb-8"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white">
                                Book an Appointment
                            </h1>
                            <p class="text-blue-100 mt-1">
                                Schedule your service with us
                            </p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg
                                class="w-8 h-8 text-white"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-8">
                        <form @submit.prevent="submit">
                            <div class="space-y-8">
                                <!-- Service Selection -->
                                <div class="relative">
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="bg-blue-100 p-2 rounded-lg mr-3"
                                        >
                                            <svg
                                                class="w-5 h-5 text-blue-600"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                />
                                            </svg>
                                        </div>
                                        <label
                                            class="block text-lg font-semibold text-gray-800"
                                            >Choose Service</label
                                        >
                                    </div>
                                    <div class="relative">
                                        <select
                                            v-model="form.service_id"
                                            class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none cursor-pointer hover:bg-gray-100"
                                        >
                                            <option
                                                value=""
                                                class="text-gray-400"
                                            >
                                                Select a service
                                            </option>
                                            <option
                                                v-for="service in services"
                                                :key="service.id"
                                                :value="service.id"
                                                class="py-2"
                                            >
                                                {{ service.name }} •
                                                {{ service.duration_minutes }}
                                                minutes
                                            </option>
                                        </select>
                                    </div>
                                    <div
                                        v-if="form.errors.service_id"
                                        class="mt-3 ml-2 flex items-center text-red-600 text-sm"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        {{ form.errors.service_id }}
                                    </div>
                                </div>

                                <!-- Date Selection -->
                                <div class="relative">
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="bg-blue-100 p-2 rounded-lg mr-3"
                                        >
                                            <svg
                                                class="w-5 h-5 text-blue-600"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                />
                                            </svg>
                                        </div>
                                        <label
                                            class="block text-lg font-semibold text-gray-800"
                                            >Select Date</label
                                        >
                                    </div>
                                    <div class="relative">
                                        <input
                                            v-model="form.date"
                                            type="date"
                                            :min="minDate"
                                            class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 cursor-pointer hover:bg-gray-100"
                                            @change="checkDateAvailability"
                                        />
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500"
                                        >
                                            <svg
                                                class="w-5 h-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                    <div
                                        v-if="form.errors.date"
                                        class="mt-3 ml-2 flex items-center text-red-600 text-sm"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        {{ form.errors.date }}
                                    </div>
                                    <div
                                        v-if="dateUnavailable"
                                        class="mt-3 ml-2 flex items-center text-amber-600 bg-amber-50 px-4 py-2 rounded-lg border border-amber-200"
                                    >
                                        <svg
                                            class="w-5 h-5 mr-2"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        You already have an appointment on this
                                        date.
                                    </div>
                                </div>
                                <!-- Time Selection -->
                                <div class="relative">
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="bg-blue-100 p-2 rounded-lg mr-3"
                                        >
                                            <ClockIcon
                                                class="w-5 h-5 text-blue-600"
                                            />
                                        </div>
                                        <label
                                            class="block text-lg font-semibold text-gray-800"
                                        >
                                            Select Time
                                        </label>
                                    </div>

                                    <Listbox v-model="form.start_time">
                                        <div class="relative mt-1">
                                            <ListboxButton
                                                class="relative w-full cursor-pointer rounded-xl bg-gray-50 border border-gray-200 pl-4 pr-10 py-3.5 text-left focus:ring-2 focus:ring-blue-500 hover:bg-gray-100"
                                            >
                                                <span class="block truncate">
                                                    {{
                                                        form.start_time
                                                            ? formatTime(
                                                                  form.start_time
                                                              )
                                                            : "Select Time"
                                                    }}
                                                </span>
                                            </ListboxButton>

                                            <ListboxOptions
                                                class="absolute z-50 mt-1 max-h-60 w-full overflow-auto rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5"
                                            >
                                                <ListboxOption
                                                    v-for="time in timeSlots"
                                                    :key="time"
                                                    :value="time"
                                                    class="relative cursor-pointer select-none py-2 pl-10 pr-4 hover:bg-blue-100"
                                                >
                                                    <span
                                                        class="block truncate"
                                                    >
                                                        {{ formatTime(time) }}
                                                    </span>

                                                    <span
                                                        v-if="
                                                            form.start_time ===
                                                            time
                                                        "
                                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-600"
                                                    >
                                                        <CheckIcon
                                                            class="h-5 w-5"
                                                        />
                                                    </span>
                                                </ListboxOption>
                                            </ListboxOptions>
                                        </div>
                                    </Listbox>

                                    <p
                                        v-if="form.errors.start_time"
                                        class="mt-2 text-red-600 text-sm"
                                    >
                                        {{ form.errors.start_time }}
                                    </p>
                                </div>

                                <!-- Notes -->
                                <div>
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="bg-blue-100 p-2 rounded-lg mr-3"
                                        >
                                            <svg
                                                class="w-5 h-5 text-blue-600"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                        </div>
                                        <label
                                            class="block text-lg font-semibold text-gray-800"
                                            >Additional Notes
                                            <span
                                                class="text-gray-400 font-normal text-sm"
                                                >(Optional)</span
                                            ></label
                                        >
                                    </div>
                                    <div class="relative">
                                        <textarea
                                            v-model="form.notes"
                                            rows="4"
                                            class="w-full pl-4 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none placeholder-gray-400 hover:bg-gray-100"
                                            placeholder="Any special requirements, notes, or preferences..."
                                        ></textarea>
                                        <div
                                            class="absolute bottom-3 right-3 text-gray-400 text-sm"
                                        >
                                            {{
                                                form.notes
                                                    ? form.notes.length
                                                    : 0
                                            }}/500
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-6 border-t border-gray-100">
                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 active:scale-[0.98] transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
                                    >
                                        <svg
                                            v-if="form.processing"
                                            class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                        {{
                                            form.processing
                                                ? "Processing..."
                                                : "Confirm Appointment"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Box -->
                <div
                    class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-xl p-5"
                >
                    <div class="flex items-start">
                        <svg
                            class="w-6 h-6 text-blue-600 mt-0.5 mr-3 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">
                                Your appointment will be confirmed once
                                submitted. You'll receive a confirmation email
                                with all the details. Please arrive 10 minutes
                                before your scheduled time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import Swal from "sweetalert2";
import { usePage } from "@inertiajs/vue3";
import { watch } from "vue";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";

import { ClockIcon, CheckIcon } from "@heroicons/vue/24/outline";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    services: Array,
    bookedDates: Array,
});

const page = usePage();

const form = useForm({
    service_id: "",
    date: "",
    start_time: "",
    notes: "",
});

const timeSlots = [
    "09:00",
    "09:30",
    "10:00",
    "10:30",
    "11:00",
    "11:30",
    "13:00",
    "13:30",
    "14:00",
    "14:30",
    "15:00",
    "15:30",
    "16:00",
];
const minDate = new Date().toISOString().split("T")[0];
const dateUnavailable = ref(false);

function checkDateAvailability() {
    dateUnavailable.value = props.bookedDates.includes(form.date);
}

function formatTime(time) {
    const [hours, minutes] = time.split(":");
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? "PM" : "AM";
    const formattedHour = hour % 12 || 12;
    return `${formattedHour}:${minutes} ${ampm}`;
}

watch(
    () => page.props.flash?.success,
    (message) => {
        if (message) {
            Swal.fire({
                icon: "success",
                title: "Booking Successful!",
                text: message,
                confirmButtonColor: "#2563eb",
            });

            form.reset();
        }
    }
);

function submit() {
    form.post(route("customer.appointments.store"), {
        preserveScroll: true,
    });
}
</script>
