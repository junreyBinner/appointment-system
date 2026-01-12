<template>
    <AuthenticatedLayout>
        <div
            class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8 px-4 sm:px-6 lg:px-8"
        >
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">
                                My Appointments
                            </h1>
                            <p class="text-gray-600 mt-2">
                                View and manage your scheduled appointments
                            </p>
                        </div>
                        <div
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 p-3 rounded-xl"
                        >
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

                <!-- Appointments List -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-8">
                        <!-- Empty State -->
                        <div
                            v-if="appointments.data.length === 0"
                            class="text-center py-16"
                        >
                            <div
                                class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6"
                            >
                                <svg
                                    class="w-12 h-12 text-gray-400"
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
                            <h3
                                class="text-xl font-semibold text-gray-700 mb-2"
                            >
                                No Appointments Yet
                            </h3>
                            <p class="text-gray-500 max-w-md mx-auto mb-8">
                                You don't have any scheduled appointments. Book
                                your first appointment to get started.
                            </p>
                        </div>

                        <!-- Appointments Grid -->
                        <div
                            v-else
                            class="grid grid-cols-1 lg:grid-cols-2 gap-6"
                        >
                            <div
                                v-for="appointment in appointments.data"
                                :key="appointment.id"
                                class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-white to-gray-50 hover:to-blue-50"
                            >
                                <div class="flex flex-col h-full">
                                    <!-- Header Section -->
                                    <div
                                        class="flex justify-between items-start mb-6"
                                    >
                                        <div class="flex-1">
                                            <div class="flex items-center mb-3">
                                                <!-- Icon -->
                                                <div
                                                    class="bg-gradient-to-r from-blue-100 to-indigo-100 p-2 rounded-lg mr-3"
                                                >
                                                    <svg
                                                        class="w-6 h-6 text-blue-600"
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

                                                <!-- Texts properly aligned -->
                                                <div class="flex flex-col">
                                                    <h3
                                                        class="text-xl font-bold text-gray-800 leading-tight"
                                                    >
                                                        {{
                                                            appointment.service
                                                                .name
                                                        }}
                                                    </h3>

                                                    <p
                                                        class="text-sm font-semibold text-gray-600"
                                                    >
                                                        Dr.
                                                        {{
                                                            appointment.service
                                                                .doctor_name
                                                        }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Time Badge -->
                                            <div
                                                class="inline-flex items-center bg-gradient-to-r from-blue-50 to-indigo-50 text-blue-700 px-4 py-2 rounded-full mb-4"
                                            >
                                                <svg
                                                    class="w-4 h-4 mr-2"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    />
                                                </svg>
                                                <span class="font-semibold">{{
                                                    formatTime(
                                                        appointment.start_time
                                                    )
                                                }}</span>
                                                <span class="mx-2">•</span>
                                                <span
                                                    >{{
                                                        appointment.service
                                                            .duration_minutes
                                                    }}
                                                    mins</span
                                                >
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        <span
                                            :class="
                                                statusClass(appointment.status)
                                            "
                                            class="px-4 py-2 rounded-full text-sm font-semibold shadow-sm"
                                        >
                                            {{
                                                appointment.status
                                                    .charAt(0)
                                                    .toUpperCase() +
                                                appointment.status.slice(1)
                                            }}
                                        </span>
                                    </div>

                                    <!-- Details Section -->
                                    <div class="flex-1">
                                        <!-- Date -->
                                        <div
                                            class="flex items-center text-gray-600 mb-3"
                                        >
                                            <svg
                                                class="w-5 h-5 mr-3 text-gray-400"
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
                                            <span class="font-medium">{{
                                                formatDate(appointment.date)
                                            }}</span>
                                        </div>

                                        <!-- Notes -->
                                        <div
                                            v-if="appointment.notes"
                                            class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200"
                                        >
                                            <div class="flex items-start">
                                                <svg
                                                    class="w-5 h-5 mr-3 text-gray-400 mt-0.5 flex-shrink-0"
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
                                                <div>
                                                    <p
                                                        class="text-sm font-medium text-gray-700 mb-1"
                                                    >
                                                        Notes
                                                    </p>
                                                    <p
                                                        class="text-gray-600 text-sm"
                                                    >
                                                        {{ appointment.notes }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div
                            v-if="appointments.links.length > 3"
                            class="mt-12 pt-8 border-t border-gray-200"
                        >
                            <nav
                                class="flex items-center justify-center space-x-2"
                            >
                                <Link
                                    v-for="link in appointments.links"
                                    :key="link.label"
                                    :href="link.url"
                                    :class="[
                                        'px-4 py-2.5 rounded-lg font-medium transition-all duration-200 flex items-center',
                                        link.active
                                            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg'
                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200 hover:shadow-md',
                                    ]"
                                    v-html="link.label"
                                />
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    appointments: Object,
});

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString("en-US", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

function formatTime(timeString) {
    const [hours, minutes] = timeString.split(":");
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? "PM" : "AM";
    const formattedHour = hour % 12 || 12;
    return `${formattedHour}:${minutes} ${ampm}`;
}

function statusClass(status) {
    const classes = {
        pending:
            "bg-gradient-to-r from-yellow-50 to-yellow-100 text-yellow-800 border border-yellow-200",
        approved:
            "bg-gradient-to-r from-green-50 to-green-100 text-green-800 border border-green-200",
        cancelled:
            "bg-gradient-to-r from-red-50 to-red-100 text-red-800 border border-red-200",
        completed:
            "bg-gradient-to-r from-blue-50 to-blue-100 text-blue-800 border border-blue-200",
    };
    return (
        classes[status] ||
        "bg-gradient-to-r from-gray-50 to-gray-100 text-gray-800 border border-gray-200"
    );
}

function cancelAppointment(appointment) {
    if (confirm("Are you sure you want to cancel this appointment?")) {
        Inertia.post(route("customer.appointments.cancel", appointment.id));
    }
}
</script>
