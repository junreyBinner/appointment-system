<template>
    <Head title="Appointment System" />

    <!-- Hero Section with Anime Background -->
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>

        <!-- NEW LEFT SIDEBAR DESIGN -->
        <div class="flex min-h-screen">
            <!-- LEFT SIDEBAR (Header / Navigation) -->
            <aside class="fixed lg:relative w-72 lg:w-80 h-screen bg-white/90 backdrop-blur-xl border-r border-indigo-100/60 shadow-2xl shadow-purple-200/30 z-30 flex flex-col transition-all duration-300">
                <!-- Logo area -->
                <div class="px-6 pt-8 pb-6 border-b border-purple-100/50">
                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="relative">
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-300/40 group-hover:scale-105 transition">
                                <i class="fas fa-calendar-check text-white text-xl"></i>
                            </div>
                            <div class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-400 rounded-full animate-pulse border-2 border-white"></div>
                        </div>
                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-700 bg-clip-text text-transparent">Clini<span class="font-black">Book</span></h1>
                            <p class="text-xs text-gray-500 font-medium">smart appointment system</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="flex-1 px-5 py-8 overflow-y-auto">
                    <div class="space-y-1">
                        <p class="text-xs uppercase font-bold text-gray-400 tracking-wider px-3 mb-3">Main</p>
                        <a href="#" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl bg-gradient-to-r from-purple-50 to-indigo-50 text-purple-700 font-semibold shadow-sm transition-all duration-200 border-l-4 border-purple-500">
                            <i class="fas fa-home w-5 text-purple-600 text-lg"></i>
                            <span>Dashboard Overview</span>
                        </a>
                        <a href="#" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50/50 hover:text-purple-700 transition group">
                            <i class="fas fa-calendar-alt w-5 text-gray-500 group-hover:text-purple-500 text-lg"></i>
                            <span>My Appointments</span>
                        </a>
                        <a href="#" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50/50 hover:text-purple-700 transition group">
                            <i class="fas fa-stethoscope w-5 text-gray-500 group-hover:text-purple-500 text-lg"></i>
                            <span>Find Services</span>
                        </a>
                        <a href="#" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50/50 hover:text-purple-700 transition group">
                            <i class="fas fa-user-md w-5 text-gray-500 group-hover:text-purple-500 text-lg"></i>
                            <span>Specialists</span>
                        </a>
                        <a href="#" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50/50 hover:text-purple-700 transition group">
                            <i class="fas fa-clock w-5 text-gray-500 group-hover:text-purple-500 text-lg"></i>
                            <span>Availability</span>
                        </a>
                    </div>
                    
                    <div class="mt-8 pt-4 border-t border-purple-100">
                        <p class="text-xs uppercase font-bold text-gray-400 tracking-wider px-3 mb-3">Account</p>
                        <Link :href="route('login')" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50/50 transition group">
                            <i class="fas fa-sign-in-alt w-5 text-gray-500 group-hover:text-indigo-500"></i>
                            <span>Sign In</span>
                        </Link>
                        <Link :href="route('register')" class="mt-1 flex items-center gap-4 px-4 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-500 text-white shadow-md hover:shadow-xl transition-all hover:scale-[1.02]">
                            <i class="fas fa-user-plus w-5"></i>
                            <span class="font-bold">Create Account</span>
                            <i class="fas fa-arrow-right ml-auto text-sm"></i>
                        </Link>
                    </div>

                    <div class="mt-8 p-4 rounded-2xl bg-indigo-50/60 border border-indigo-100">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-shield-alt text-indigo-500 text-sm"></i>
                            <span class="text-xs font-medium text-indigo-800">Secure booking system</span>
                        </div>
                        <p class="text-[11px] text-gray-500 mt-2">instant confirmation • 24/7 access</p>
                    </div>
                </div>
                
                <div class="p-5 border-t border-purple-100/60">
                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-purple-200 to-pink-200 flex items-center justify-center">
                            <i class="fas fa-hospital-user text-purple-700 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-700">Patient Portal</p>
                            <p class="text-[10px] text-gray-400">ready to book</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="flex-1 ml-0 lg:ml-72 w-full transition-all overflow-x-hidden">
                <!-- Rest of your content continues here... -->
                <div class="relative overflow-hidden pt-10 pb-12 md:pt-16 md:pb-20 px-5 md:px-10">
                    <div class="max-w-6xl mx-auto">
                        <h1 class="text-4xl font-bold">Clinic Booking System</h1>
                        <p class="mt-4 text-gray-600">Your Health, Scheduled with Ease</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<style scoped>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.sidebar-link {
    transition: all 0.2s ease;
}

.sidebar-link:hover i {
    transform: translateX(4px);
}
</style>