<template>
    <div>
        <!-- Navigation Bar -->
        <nav
            class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b shadow-sm"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Left: Brand -->
                    <div class="flex items-center">
                        <Link
                            :href="route('customer.dashboard')"
                            class="flex items-center gap-3 group"
                        >
                            <CalendarDaysIcon
                                class="h-8 w-8 text-blue-600 transition-transform duration-300 group-hover:rotate-6"
                            />
                            <span class="text-xl font-bold text-gray-900">
                                Appointment<span class="text-blue-600"
                                    >Sys</span
                                >
                            </span>
                        </Link>
                    </div>

                    <!-- Right: Navigation + User -->
                    <div class="flex items-center space-x-6">
                        <!-- Customer Navbar -->
                        <div
                            v-if="isCustomer"
                            class="hidden sm:flex items-center space-x-8"
                        >
                            <NavLink :href="route('customer.dashboard')"
                                >Dashboard</NavLink
                            >
                            <NavLink
                                :href="route('customer.appointments.index')"
                                >Appointments</NavLink
                            >

                            <!-- CTA -->
                            <Link
                                :href="route('customer.book')"
                                class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2 text-sm font-medium text-white transition-all duration-300 hover:bg-blue-700 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-600/30"
                            >
                                Book Now
                            </Link>
                        </div>

                        <!-- User Dropdown -->
                        <div class="relative">
                            <button
                                @click="toggleDropdown"
                                class="flex items-center gap-2 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <div
                                    class="h-9 w-9 rounded-full bg-blue-100 flex items-center justify-center"
                                >
                                    <span class="text-blue-600 font-semibold">
                                        {{ user.name.charAt(0).toUpperCase() }}
                                    </span>
                                </div>
                                <ChevronDownIcon
                                    class="h-4 w-4 text-gray-500 transition-transform"
                                    :class="dropdownOpen ? 'rotate-180' : ''"
                                />
                            </button>

                            <!-- Dropdown -->
                            <div
                                v-if="dropdownOpen"
                                class="absolute right-0 mt-3 w-48 rounded-xl border bg-white shadow-lg overflow-hidden z-50"
                            >
                                <div class="px-4 py-3 border-b">
                                    <p
                                        class="text-sm font-medium text-gray-800"
                                    >
                                        {{ user.name }}
                                    </p>
                                </div>

                                <Link
                                    :href="route('profile.edit')"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                    @click="closeDropdown"
                                >
                                    Profile
                                </Link>

                                <form @submit.prevent="logout" class="border-t">
                                    <button
                                        type="submit"
                                        class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50"
                                    >
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import { CalendarDaysIcon, ChevronDownIcon } from "@heroicons/vue/24/outline";

const dropdownOpen = ref(false);
const page = usePage();

const user = computed(() => page.props.auth.user);

const isCustomer = computed(() => user.value.role === "customer");

function toggleDropdown() {
    dropdownOpen.value = !dropdownOpen.value;
}

function closeDropdown() {
    dropdownOpen.value = false;
}
function logout() {
    router.post(route("logout"));
}
</script>
