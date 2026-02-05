<template>
        <main class="p-6 md:ml-64 pt-20 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto space-y-8">

                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900">
                            Admin Dashboard
                        </h1>
                        <p class="text-gray-500 mt-1">
                            Overview the system performance and daily activities
                        </p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="relative overflow-hidden rounded-2xl bg-white shadow">
                        <div class="p-6 flex items-center">
                            <div class="p-4 rounded-xl bg-blue-100">
                                <ClockIcon class="h-7 w-7 text-blue-600" />
                            </div>
                            <div class="ml-5">
                                <p class="text-sm text-gray-500">
                                    Pending Appointments
                                </p>
                                <p class="text-3xl font-bold">
                                    {{ stats.pending }}
                                </p>
                            </div>
                        </div>
                        <div class="absolute right-0 top-0 h-full w-1 bg-blue-500"></div>
                    </div>

                    <div class="relative overflow-hidden rounded-2xl bg-white shadow">
                        <div class="p-6 flex items-center">
                           <div class="p-4 rounded-xl bg-purple-100">
                                <ClipboardDocumentListIcon class="h-7 w-7 text-purple-600" />
                            </div>
                            <div class="ml-5">
                                <p class="text-sm text-gray-500">
                                    Today's Appointments
                                </p>
                                <p class="text-3xl font-bold">
                                    {{ stats.today }}
                                </p>
                            </div>
                        </div>
                        <div class="absolute right-0 top-0 h-full w-1 bg-purple-500"></div>
                    </div>

                   
    <div class="relative overflow-hidden bg-white rounded-2xl shadow p-6 flex items-center">
    <div class="p-4 bg-purple-100 rounded-xl">
        <CalendarIcon class="h-7 w-7 text-purple-600" />
    </div>
    <div class="ml-5">
        <p class="text-sm text-gray-500">Total Bookings</p>
        <p class="text-3xl font-bold">{{ stats.total_bookings }}</p>
    </div>

    <!-- SIDE COLOR -->
    <div class="absolute right-0 top-0 h-full w-1 bg-purple-600"></div>
</div>
                </div>

                <!-- Service Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="relative overflow-hidden bg-white rounded-2xl shadow p-6 flex items-center">
    <div class="p-4 bg-blue-100 rounded-xl">
        <CogIcon class="h-7 w-7 text-blue-600" />
    </div>
    <div class="ml-5">
        <p class="text-sm text-gray-500">Total Services</p>
        <p class="text-3xl font-bold">{{ stats.total_services }}</p>
    </div>

    <!-- SIDE COLOR -->
    <div class="absolute right-0 top-0 h-full w-1 bg-blue-600"></div>
</div>

    <div class="relative overflow-hidden bg-white rounded-2xl shadow p-6 flex items-center">
    <div class="p-4 bg-green-100 rounded-xl">
        <CheckCircleIcon class="h-7 w-7 text-green-600" />
    </div>
    <div class="ml-5">
        <p class="text-sm text-gray-500">Active Services</p>
        <p class="text-3xl font-bold">{{ stats.active_services }}</p>
    </div>

    <!-- SIDE COLOR -->
    <div class="absolute right-0 top-0 h-full w-1 bg-green-600"></div>
</div>

  <div class="relative overflow-hidden bg-white rounded-2xl shadow p-6 flex items-center">
    <div class="p-4 bg-red-100 rounded-xl">
        <XCircleIcon class="h-7 w-7 text-red-600" />
    </div>
    <div class="ml-5">
        <p class="text-sm text-gray-500">Inactive Services</p>
        <p class="text-3xl font-bold">{{ stats.inactive_services }}</p>
    </div>

    <!-- SIDE COLOR -->
    <div class="absolute right-0 top-0 h-full w-1 bg-red-600"></div>
</div>
</div>
                

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        <Link
                            :href="route('admin.appointments.index')"
                            class="flex justify-between items-center p-5 border rounded-xl hover:bg-blue-50"
                        >
                            <div class="flex items-center">
                                <CalendarIcon class="h-6 w-6 text-blue-500 mr-3" />
                                <div>
                                    <p class="font-semibold">Manage Appointments</p>
                                    <p class="text-sm text-gray-500">
                                        Approve and update the schedules
                                    </p>
                                </div>
                            </div>
                            <ChevronRightIcon class="h-5 w-5 text-gray-400" />
                        </Link>

                        <Link
                            :href="route('admin.services.index')"
                            class="flex justify-between items-center p-5 border rounded-xl hover:bg-purple-50"
                        >
                            <div class="flex items-center">
                                <CogIcon class="h-6 w-6 text-purple-500 mr-3" />
                                <div>
                                    <p class="font-semibold">Manage Services</p>
                                    <p class="text-sm text-gray-500">
                                        Add control and services
                                    </p>
                                </div>
                            </div>
                            <ChevronRightIcon class="h-5 w-5 text-gray-400" />
                        </Link>
                    </div>
                </div>

                <!-- Today's Appointments -->
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold mb-4">
                        Today's Appointments
                    </h2>

                    <div
                        v-if="todaysAppointments.length === 0"
                        class="text-center py-10 text-gray-400"
                    >
                        No appointments today.
                    </div>

                    <div v-else class="space-y-4">
                        <div
                            v-for="appointment in todaysAppointments"
                            :key="appointment.id"
                            class="p-5 border rounded-xl flex justify-between items-center"
                        >
                            <div>
                                <p class="font-semibold">
                                    {{ appointment.user.name }}
                                </p>
                                <p class="text-gray-600">
                                    {{ appointment.service.name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ formatTime(appointment.start_time) }}
                                    –
                                    {{ formatTime(appointment.end_time) }}
                                </p>
                            </div>

                            <span
                                :class="statusClass(appointment.status)"
                                class="px-3 py-1 rounded-full text-sm font-semibold capitalize"
                            >
                                {{ appointment.status }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </main>
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'
// import { initFlowbite } from 'flowbite'
import AdminLayout from '@/Pages/Admin/Components/AdminLayout.vue'

import {
    ClockIcon,
    CheckCircleIcon,
    ClipboardDocumentListIcon,
    CalendarIcon,
    CogIcon,
    ChevronRightIcon,
} from '@heroicons/vue/24/outline'

defineOptions({
    layout: AdminLayout
}) 

defineProps({
    stats: Object,
    todaysAppointments: Array,
})

function formatTime(timeString) {
    const [h, m] = timeString.split(':')
    const hour = parseInt(h)
    const ampm = hour >= 12 ? 'PM' : 'AM'
    return `${hour % 12 || 12}:${m} ${ampm}`
}

function statusClass(status) {
    return {
        pending: 'bg-yellow-100 text-yellow-800',
        approved: 'bg-green-100 text-green-800',
        cancelled: 'bg-red-100 text-red-800',
    }[status] || 'bg-gray-100 text-gray-800'
}
</script>
