<template>
    <AdminLayout>
        <main class="p-6 pt-20 md:ml-64 bg-gray-50 min-h-screen">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Header -->
                    <div class="sm:flex sm:items-center mb-8">
                        <div class="sm:flex-auto">
                            <h1 class="text-3xl font-bold text-gray-900">
                                Services Management
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                Manage all services available for booking.
                                Customers can book appointments for these
                                services.
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link
                                :href="route('admin.services.create')"
                                class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                            >
                                <PlusIcon class="h-4 w-4 mr-2" />
                                Add New Service
                            </Link>
                        </div>
                    </div>

                    <!-- Services Table -->
                    <div
                        class="bg-white shadow-sm ring-1 ring-gray-300 sm:rounded-lg"
                    >
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                        >
                                            Service
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Duration
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Price
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Status
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Bookings
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr
                                        v-for="service in services"
                                        :key="service.id"
                                        class="hover:bg-gray-50"
                                    >
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6"
                                        >
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 flex-shrink-0"
                                                >
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center"
                                                    >
                                                        <CogIcon
                                                            class="h-6 w-6 text-blue-600"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="font-medium text-gray-900"
                                                    >
                                                        {{ service.name }}
                                                    </div>
                                                    <div
                                                        class="text-xs text-blue-600 font-medium"
                                                    >
                                                        Dr.
                                                        {{
                                                            service.doctor_name
                                                        }}
                                                    </div>

                                                    <div
                                                        class="text-gray-500 line-clamp-1"
                                                    >
                                                        {{
                                                            service.description ||
                                                            "No description"
                                                        }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            <div class="flex items-center">
                                                <ClockIcon
                                                    class="h-4 w-4 mr-1 text-gray-400"
                                                />
                                                {{ service.duration_minutes }}
                                                minutes
                                            </div>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            <span
                                                v-if="service.price"
                                                class="font-medium text-gray-900"
                                                >₱{{ service.price }}
                                            </span>
                                            <span v-else class="text-gray-400"
                                                >Free</span
                                            >
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm"
                                        >
                                            <span
                                                :class="
                                                    service.is_active
                                                        ? 'bg-green-100 text-green-800'
                                                        : 'bg-red-100 text-red-800'
                                                "
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            >
                                                {{
                                                    service.is_active
                                                        ? "Active"
                                                        : "Inactive"
                                                }}
                                            </span>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                        >
                                            <div class="flex items-center">
                                                <CalendarIcon
                                                    class="h-4 w-4 mr-1 text-gray-400"
                                                />
                                                {{
                                                    service.appointments_count ||
                                                    0
                                                }}
                                                bookings
                                            </div>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                        >
                                            <div
                                                class="flex items-center justify-end space-x-3"
                                            >
                                                <Link
                                                    :href="
                                                        route(
                                                            'admin.services.edit',
                                                            service.id
                                                        )
                                                    "
                                                    class="text-blue-600 hover:text-blue-900"
                                                >
                                                    <PencilSquareIcon
                                                        class="h-4 w-4"
                                                    />
                                                    <span class="sr-only"
                                                        >Edit</span
                                                    >
                                                </Link>
                                                <button
                                                    @click="
                                                        toggleStatus(service)
                                                    "
                                                    :class="
                                                        service.is_active
                                                            ? 'text-yellow-600 hover:text-yellow-900'
                                                            : 'text-green-600 hover:text-green-900'
                                                    "
                                                    class="focus:outline-none"
                                                >
                                                    <PowerIcon
                                                        v-if="service.is_active"
                                                        class="h-4 w-4"
                                                    />
                                                    <CheckCircleIcon
                                                        v-else
                                                        class="h-4 w-4"
                                                    />
                                                    <span class="sr-only">{{
                                                        service.is_active
                                                            ? "Deactivate"
                                                            : "Activate"
                                                    }}</span>
                                                </button>
                                                <button
                                                    @click="
                                                        deleteService(service)
                                                    "
                                                    class="text-red-600 hover:text-red-900 focus:outline-none"
                                                >
                                                    <TrashIcon
                                                        class="h-4 w-4"
                                                    />
                                                    <span class="sr-only"
                                                        >Delete</span
                                                    >
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Empty State -->
                        <div
                            v-if="services.length === 0"
                            class="text-center py-12"
                        >
                            <CogIcon class="mx-auto h-12 w-12 text-gray-400" />
                            <h3
                                class="mt-2 text-sm font-semibold text-gray-900"
                            >
                                No services
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Get started by creating a new service.
                            </p>
                            <div class="mt-6">
                                <Link
                                    :href="route('admin.services.create')"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                                >
                                    <PlusIcon class="-ml-0.5 mr-1.5 h-5 w-5" />
                                    New Service
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </AdminLayout>
</template>

<script setup>
import { defineProps } from "vue";
import Swal from "sweetalert2";
import AdminLayout from "@/Pages/Admin/Components/AdminLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import {
    PlusIcon,
    CogIcon,
    ClockIcon,
    CalendarIcon,
    PencilSquareIcon,
    TrashIcon,
    PowerIcon,
    CheckCircleIcon,
} from "@heroicons/vue/24/outline";

const { services, stats } = defineProps({
    services: {
        type: Array,
        default: () => [],
    },
    stats: {
        type: Object,
        default: () => ({}),
    },
});

async function toggleStatus(service) {
    const result = await Swal.fire({
        title: service.is_active ? "Deactivate service?" : "Activate service?",
        text: service.is_active
            ? "Are you sure you want to deactivate this service?"
            : "Are you sure you want to activate this service?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
    });

    if (result.isConfirmed) {
        router.patch(
            route("admin.services.toggle-status", service.id),
            {},
            {
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: service.is_active
                            ? "Service has been activated."
                            : "Service has been deactivated.",
                        timer: 1500,
                        showConfirmButton: false,
                    });
                },
            }
        );
    }
}
async function deleteService(service) {
    const result = await Swal.fire({
        title: "Delete service?",
        text: "Are you sure you want to delete this service? This cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ef4444",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "Cancel",
    });

    if (result.isConfirmed) {
        router.delete(route("admin.services.destroy", service.id), {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    icon: "success",
                    title: "Deleted!",
                    text: "Service has been deleted successfully.",
                    timer: 1500,
                    showConfirmButton: false,
                });
            },
        });
    }
}
</script>
