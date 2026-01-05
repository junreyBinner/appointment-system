<template>
    <AdminLayout>
        <main class="p-6 pt-20 md:ml-64 bg-gray-50 min-h-screen">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <div class="md:flex md:items-center md:justify-between">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-3xl font-bold text-gray-900">
                                    {{
                                        service
                                            ? "Edit Service"
                                            : "Create New Service"
                                    }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{
                                        service
                                            ? "Update service details below."
                                            : "Fill in the details to create a new service."
                                    }}
                                </p>
                            </div>
                            <div class="mt-4 flex md:mt-0 md:ml-4">
                                <Link
                                    :href="route('admin.services.index')"
                                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    Back
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div
                        class="bg-white shadow-sm ring-1 ring-gray-300 sm:rounded-lg"
                    >
                        <div class="px-6 py-8 sm:p-10">
                            <form @submit.prevent="submit">
                                <div class="space-y-8">
                                    <!-- Service Name -->
                                    <div>
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Service Name *
                                        </label>
                                        <div class="mt-1">
                                            <input
                                                type="text"
                                                id="name"
                                                v-model="form.name"
                                                @input="clearError('name')"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                placeholder="e.g., Haircut, Consultation, Repair Service"
                                            />
                                        </div>
                                        <p
                                            v-if="form.errors.name"
                                            class="mt-2 text-sm text-red-600"
                                        >
                                            {{ form.errors.name }}
                                        </p>
                                    </div>
                                    <!-- Description -->
                                    <div>
                                        <label
                                            for="description"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Description
                                        </label>
                                        <div class="mt-1">
                                            <textarea
                                                id="description"
                                                v-model="form.description"
                                                rows="3"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                placeholder="Describe the service in detail..."
                                            />
                                        </div>
                                        <p
                                            v-if="form.errors.description"
                                            class="mt-2 text-sm text-red-600"
                                        >
                                            {{ form.errors.description }}
                                        </p>
                                    </div>

                                    <div
                                        class="grid grid-cols-1 gap-6 sm:grid-cols-2"
                                    >
                                        <!-- Duration -->
                                        <div>
                                            <label
                                                for="duration_minutes"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Duration (minutes) *
                                            </label>
                                            <div class="mt-1">
                                                <select
                                                    id="duration_minutes"
                                                    v-model="
                                                        form.duration_minutes
                                                    "
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                >
                                                    <option value="15">
                                                        15 minutes
                                                    </option>
                                                    <option value="30">
                                                        30 minutes
                                                    </option>
                                                    <option value="45">
                                                        45 minutes
                                                    </option>
                                                    <option value="60">
                                                        1 hour
                                                    </option>
                                                    <option value="90">
                                                        1.5 hours
                                                    </option>
                                                    <option value="120">
                                                        2 hours
                                                    </option>
                                                </select>
                                            </div>
                                            <p
                                                v-if="
                                                    form.errors.duration_minutes
                                                "
                                                class="mt-2 text-sm text-red-600"
                                            >
                                                {{
                                                    form.errors.duration_minutes
                                                }}
                                            </p>
                                        </div>

                                        <!-- Price -->
                                        <div>
                                            <label
                                                for="price"
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Price (optional)
                                            </label>
                                            <div
                                                class="mt-1 relative rounded-md shadow-sm"
                                            >
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                                >
                                                    <span
                                                        class="text-gray-500 sm:text-sm"
                                                        >$</span
                                                    >
                                                </div>
                                                <input
                                                    type="number"
                                                    id="price"
                                                    v-model="form.price"
                                                    step="0.01"
                                                    min="0"
                                                    class="block w-full rounded-md border-gray-300 pl-7 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                                    placeholder="0.00"
                                                />
                                            </div>
                                            <p
                                                class="mt-2 text-sm text-gray-500"
                                            >
                                                Leave empty for free service
                                            </p>
                                            <p
                                                v-if="form.errors.price"
                                                class="mt-2 text-sm text-red-600"
                                            >
                                                {{ form.errors.price }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <div class="flex items-center">
                                            <input
                                                type="checkbox"
                                                id="is_active"
                                                v-model="form.is_active"
                                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            />
                                            <label
                                                for="is_active"
                                                class="ml-2 block text-sm text-gray-900"
                                            >
                                                Service is active and available
                                                for booking
                                            </label>
                                        </div>
                                        <p
                                            v-if="form.errors.is_active"
                                            class="mt-2 text-sm text-red-600"
                                        >
                                            {{ form.errors.is_active }}
                                        </p>
                                    </div>

                                    <!-- Form Actions -->
                                    <div
                                        class="flex justify-end space-x-3 pt-6 border-t border-gray-200"
                                    >
                                        <button
                                            type="submit"
                                            :disabled="form.processing"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50"
                                        >
                                            <span
                                                v-if="form.processing"
                                                class="inline-flex items-center"
                                            >
                                                <svg
                                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
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
                                                    />
                                                    <path
                                                        class="opacity-75"
                                                        fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                    />
                                                </svg>

                                                {{
                                                    service
                                                        ? "Updating..."
                                                        : "Creating..."
                                                }}
                                            </span>

                                            <span v-else>
                                                {{
                                                    service
                                                        ? "Update Service"
                                                        : "Create Service"
                                                }}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Service Preview -->
                    <div class="mt-8 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            Service Preview
                        </h3>
                        <div class="bg-white p-4 rounded shadow-sm">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="font-semibold text-lg">
                                    {{ form.name || "Service Name" }}
                                </h4>
                                <span
                                    v-if="form.price"
                                    class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded"
                                >
                                    ${{ form.price }}
                                </span>
                                <span
                                    v-else
                                    class="bg-gray-100 text-gray-800 text-sm font-medium px-2.5 py-0.5 rounded"
                                >
                                    Free
                                </span>
                            </div>

                            <p class="text-gray-600 text-sm mb-4">
                                {{
                                    form.description ||
                                    "Service description will appear here."
                                }}
                            </p>

                            <div
                                class="flex justify-between items-center text-sm text-gray-500"
                            >
                                <span class="flex items-center">
                                    <ClockIcon
                                        class="h-4 w-4 mr-1 text-gray-400"
                                    />
                                    {{ form.duration_minutes || "15" }} minutes
                                </span>
                                <span
                                    :class="
                                        form.is_active
                                            ? 'text-green-600'
                                            : 'text-red-600'
                                    "
                                    class="flex items-center"
                                >
                                    <CheckCircleIcon
                                        v-if="form.is_active"
                                        class="h-4 w-4 mr-1"
                                    />
                                    <XCircleIcon v-else class="h-4 w-4 mr-1" />
                                    {{
                                        form.is_active
                                            ? "Available"
                                            : "Unavailable"
                                    }}
                                </span>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-500">
                            This is how customers will see your service in the
                            booking system.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </AdminLayout>
</template>

<script setup>
import { defineProps } from "vue";
import Swal from "sweetalert2/dist/sweetalert2.js";
import AdminLayout from "@/Pages/Admin/Components/AdminLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";
import {
    ClockIcon,
    CheckCircleIcon,
    XCircleIcon,
} from "@heroicons/vue/24/outline";

const props = defineProps({
    service: Object,
});

const form = useForm({
    name: props.service?.name || "",
    description: props.service?.description || "",
    duration_minutes: props.service?.duration_minutes || 30,
    price: props.service?.price || "",
    is_active: props.service?.is_active ?? true,
});

function clearError(field) {
    if (form.errors[field]) {
        form.clearErrors(field);
    }
}

function submit() {
    if (props.service) {
        // UPDATE
        form.put(route("admin.services.update", props.service.id), {
            onSuccess: () => {
                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: "Service updated successfully.",
                    toast: false,
                    position: "center",
                    timer: 3000,
                    showConfirmButton: false,
                });
            },
        });
    } else {
        // CREATE
        form.post(route("admin.services.store"), {
            onSuccess: () => {
                Swal.fire({
                    icon: "success",
                    title: "Created!",
                    text: "Service created successfully.",
                    position: "center",
                    timer: 3000,
                    showConfirmButton: false,
                });
            },
        });
    }
}
</script>
