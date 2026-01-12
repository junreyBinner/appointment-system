<template>
    <AuthenticatedLayout>
        <div
            class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-10"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <!-- Header / Welcome -->
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                >
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Welcome back 👋
                        </h1>
                        <p class="text-gray-500 mt-1">
                            Manage your bookings, check upcoming schedules, and
                            book services anytime.
                        </p>
                    </div>
                </div>

                <!-- Quick Info Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl border p-6 shadow-sm">
                        <h3 class="text-sm text-gray-500">
                            Upcoming Appointments
                        </h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ upcomingAppointments.length }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Scheduled services ahead
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl border p-6 shadow-sm">
                        <h3 class="text-sm text-gray-500">
                            Available Services
                        </h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">
                            {{ services.length }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Services you can book
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl border p-6 shadow-sm">
                        <h3 class="text-sm text-gray-500">Account Status</h3>
                        <p class="text-lg font-semibold text-green-600 mt-2">
                            Active
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            You can book appointments
                        </p>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white rounded-2xl shadow-sm border">
                    <div
                        class="px-6 py-4 border-b flex items-center justify-between"
                    >
                        <div>
                            <h2 class="text-lg font-semibold">
                                Your Upcoming Appointments
                            </h2>
                            <p class="text-sm text-gray-500">
                                Keep track of your scheduled services
                            </p>
                        </div>
                        <Link
                            :href="route('customer.appointments.index')"
                            class="text-sm text-blue-600 hover:underline"
                        >
                            View all
                        </Link>
                    </div>

                    <div class="p-6">
                        <div
                            v-if="upcomingAppointments.length === 0"
                            class="text-center py-12"
                        >
                            <CalendarDaysIcon
                                class="h-14 w-14 text-gray-300 mx-auto mb-4"
                            />
                            <p class="text-gray-500 font-medium">
                                No upcoming appointments
                            </p>
                            <p class="text-sm text-gray-400 mt-1">
                                Book a service to secure your preferred
                                schedule.
                            </p>
                        </div>

                        <div v-else class="space-y-4">
                            <div
                                v-for="appointment in upcomingAppointments"
                                :key="appointment.id"
                                class="rounded-xl border p-5 hover:shadow-md transition"
                            >
                                <div
                                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4"
                                >
                                    <div>
                                        <div
                                            class="flex items-center gap-3 mb-1"
                                        >
                                            <h3 class="font-semibold text-lg">
                                                {{ appointment.service.name }}
                                            </h3>
                                            <span
                                                class="px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="
                                                    statusBadgeClass(
                                                        appointment.status
                                                    )
                                                "
                                            >
                                                {{ appointment.status }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">
                                            {{ formatDate(appointment.date) }} •
                                            {{
                                                formatTime(
                                                    appointment.start_time
                                                )
                                            }}
                                            -
                                            {{
                                                formatTime(appointment.end_time)
                                            }}
                                        </p>
                                    </div>

                                    <div class="flex gap-2">
                                        <button
                                            v-if="
                                                appointment.status === 'pending'
                                            "
                                            @click="confirmCancel(appointment)"
                                            class="px-3 py-1.5 text-sm rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                                        >
                                            Cancel
                                        </button>

                                        <Link
                                            :href="route('customer.book')"
                                            class="px-3 py-1.5 text-sm rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                                        >
                                            Book again
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div class="bg-white rounded-2xl shadow-sm border">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-lg font-semibold">
                            Available Services
                        </h2>
                        <p class="text-sm text-gray-500">
                            Choose a service and book your appointment
                        </p>
                    </div>
                    <div
                        class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <div
                            v-for="service in services"
                            :key="service.id"
                            class="rounded-xl border p-5 hover:shadow-md transition"
                        >
                            <div class="mb-2">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold">
                                        {{ service.name }}
                                    </h3>

                                    <span
                                        v-if="service.price"
                                        class="text-sm font-medium text-blue-600"
                                    >
                                        ₱{{ service.price }}
                                    </span>
                                </div>

                                <p class="text-xs font-semibold text-gray-700">
                                    Dr. {{ service.doctor_name }}
                                </p>
                            </div>

                            <p class="text-sm text-gray-500 mb-4">
                                {{ service.description }}
                            </p>
                            <div
                                class="flex justify-between items-center text-sm text-gray-500"
                            >
                                <span
                                    >{{ service.duration_minutes }} min
                                    session</span
                                >
                                <span
                                    class="font-medium"
                                    :class="
                                        service.is_active
                                            ? 'text-green-600'
                                            : 'text-red-600'
                                    "
                                >
                                    {{
                                        service.is_active
                                            ? "Available"
                                            : "Unavailable"
                                    }}
                                </span>
                            </div>
                            <Link
                                :href="route('customer.book')"
                                class="mt-4 block w-full text-center rounded-lg bg-blue-600 text-white py-2 hover:bg-blue-700"
                            >
                                Book now
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from "vue";
import { Link, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { CalendarDaysIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    stats: Object,
    upcomingAppointments: Array,
    services: Array,
});

function formatDate(dateString) {
    const date = new Date(dateString);
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    if (date.toDateString() === today.toDateString()) {
        return "Today";
    } else if (date.toDateString() === tomorrow.toDateString()) {
        return "Tomorrow";
    } else {
        return date.toLocaleDateString("en-US", {
            weekday: "short",
            month: "short",
            day: "numeric",
        });
    }
}

function formatTime(timeString) {
    if (!timeString) return "";
    const [hours, minutes] = timeString.split(":");
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? "PM" : "AM";
    const formattedHour = hour % 12 || 12;
    return `${formattedHour}:${minutes} ${ampm}`;
}

function statusBadgeClass(status) {
    const classes = {
        pending: "bg-yellow-100 text-yellow-800",
        approved: "bg-green-100 text-green-800",
        cancelled: "bg-red-100 text-red-800",
        completed: "bg-blue-100 text-blue-800",
    };
    return classes[status] || "bg-gray-100 text-gray-800";
}

function confirmCancel(appointment) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to cancel this appointment?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, cancel it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(
                route("customer.appointments.cancel", appointment.id),
                {},
                {
                    onSuccess: () => {
                        Swal.fire(
                            "Cancelled!",
                            "Your appointment has been successfully cancelled.",
                            "success"
                        );
                    },
                    onError: (errors) => {
                        Swal.fire(
                            "Error!",
                            "Something went wrong. Please try again.",
                            "error"
                        );
                    },
                }
            );
        }
    });
}
</script>
