<template>
    <Head title="SchoolSync - Appointment System" />

    <!-- Hero Section with Anime Background -->
    <div
        class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 overflow-hidden"
    >
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"
            ></div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"
            ></div>
            <div
                class="absolute top-1/2 left-1/3 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"
            ></div>
        </div>

        <!-- Navigation -->
        <nav class="relative bg-white/80 backdrop-blur-md shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo with Anime Style -->
                    <div
                        class="flex items-center space-x-3 transform hover:scale-105 transition-transform duration-300"
                    >
                        <div class="relative">
                            <div
                                class="h-10 w-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center"
                            >
                                <BookOpenIcon class="h-6 w-6 text-white" />
                            </div>
                            <div
                                class="absolute -top-1 -right-1 h-4 w-4 bg-yellow-400 rounded-full animate-ping"
                            ></div>
                        </div>
                        <div>
                            <span
                                class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent"
                            >
                                SchoolSync
                            </span>
                            <p class="text-xs text-gray-500 -mt-1">
                                Appointment System
                            </p>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex items-center space-x-4">
                        <Link
                            v-if="!$page.props.auth.user"
                            :href="route('login')"
                            class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-purple-600 hover:bg-purple-50 transition-all duration-300 hover:scale-105"
                        >
                            <span class="flex items-center space-x-2">
                                <ArrowRightOnRectangleIcon class="h-5 w-5" />
                                <span>Sign in</span>
                            </span>
                        </Link>

                        <Link
                            v-if="!$page.props.auth.user"
                            :href="route('register')"
                            class="px-6 py-2.5 rounded-lg font-medium text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 hover:shadow-lg transition-all duration-300 animate-pulse"
                        >
                            <span class="flex items-center space-x-2">
                                <UserPlusIcon class="h-5 w-5" />
                                <span>Sign up</span>
                            </span>
                        </Link>

                        <Link
                            v-if="$page.props.auth.user"
                            :href="
                                $page.props.auth.user.role === 'admin'
                                    ? route('admin.dashboard')
                                    : route('customer.dashboard')
                            "
                            class="px-6 py-2.5 rounded-lg font-medium text-white bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 transform hover:scale-105 transition-all duration-300"
                        >
                            Go to Dashboard
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="relative">
            <!-- Hero Section -->
            <div class="pt-16 pb-20 sm:pt-20 lg:pt-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div
                        class="text-center transform transition-all duration-700 animate-fade-in"
                    >
                        <!-- Anime Character -->
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div
                                    class="h-40 w-40 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 p-1 animate-spin-slow"
                                >
                                    <div
                                        class="h-full w-full rounded-full bg-white p-6 flex items-center justify-center"
                                    >
                                        <!-- Appointment System Icon -->
                                        <div class="relative">
                                            <!-- Calendar Base -->
                                            <div
                                                class="w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg border-2 border-purple-200 flex flex-col items-center justify-center"
                                            >
                                                <!-- Calendar Header -->
                                                <div
                                                    class="w-full h-6 bg-gradient-to-r from-purple-500 to-pink-500 rounded-t-lg flex items-center justify-center"
                                                >
                                                    <div
                                                        class="w-3 h-3 bg-white rounded-full mx-1"
                                                    ></div>
                                                    <div
                                                        class="w-3 h-3 bg-white rounded-full mx-1"
                                                    ></div>
                                                    <div
                                                        class="w-3 h-3 bg-white rounded-full mx-1"
                                                    ></div>
                                                </div>

                                                <!-- Calendar Body -->
                                                <div
                                                    class="flex-1 flex flex-col items-center justify-center p-2"
                                                >
                                                    <div
                                                        class="text-2xl font-bold text-purple-700"
                                                    >
                                                        15
                                                    </div>
                                                    <div
                                                        class="text-xs text-gray-600 font-medium"
                                                    >
                                                        Appointments
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Clock Overlay -->
                                            <div
                                                class="absolute -top-2 -right-2 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center animate-pulse"
                                            >
                                                <svg
                                                    class="h-6 w-6 text-white"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    ></path>
                                                </svg>
                                            </div>

                                            <!-- Checkmark -->
                                            <div
                                                class="absolute -bottom-2 -left-2 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center"
                                            >
                                                <svg
                                                    class="h-5 w-5 text-white"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5 13l4 4L19 7"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 h-12 w-12 bg-yellow-300 rounded-full animate-bounce"
                                >
                                    <!-- Center using absolute positioning inside -->
                                    <span
                                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl"
                                        >✅</span
                                    >
                                </div>
                            </div>
                        </div>

                        <h1
                            class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-7xl"
                        >
                            <span
                                class="block transform hover:scale-105 transition-transform duration-300"
                            >
                                Booking System
                            </span>
                            <span
                                class="block bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent animate-gradient"
                            >
                                Appointments Easily!
                            </span>
                        </h1>
                        <p
                            class="mt-4 max-w-md mx-auto text-lg text-gray-600 sm:text-xl md:mt-6 md:max-w-3xl md:text-2xl"
                        >
                            A student-friendly appointment booking system where
                            users can register and book available services
                            easily. Built for school activity purposes only. 🎓
                        </p>

                        <!-- Animated Stats -->
                        <div
                            class="mt-10 grid grid-cols-2 gap-6 max-w-md mx-auto sm:grid-cols-4 sm:max-w-xl"
                        >
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl p-4 transform hover:scale-110 transition-all duration-300 hover:shadow-xl"
                            >
                                <div class="text-3xl font-bold text-purple-600">
                                    ⚡
                                </div>
                                <div class="text-2xl font-bold text-gray-900">
                                    Fast
                                </div>
                                <div class="text-sm text-gray-600">Booking</div>
                            </div>
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl p-4 transform hover:scale-110 transition-all duration-300 hover:shadow-xl"
                            >
                                <div class="text-3xl font-bold text-pink-600">
                                    🎯
                                </div>
                                <div class="text-2xl font-bold text-gray-900">
                                    Simple
                                </div>
                                <div class="text-sm text-gray-600">Process</div>
                            </div>
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl p-4 transform hover:scale-110 transition-all duration-300 hover:shadow-xl"
                            >
                                <div class="text-3xl font-bold text-blue-600">
                                    🔒
                                </div>
                                <div class="text-2xl font-bold text-gray-900">
                                    Secure
                                </div>
                                <div class="text-sm text-gray-600">System</div>
                            </div>
                            <div
                                class="bg-white/70 backdrop-blur-sm rounded-xl p-4 transform hover:scale-110 transition-all duration-300 hover:shadow-xl"
                            >
                                <div class="text-3xl font-bold text-green-600">
                                    👥
                                </div>
                                <div class="text-2xl font-bold text-gray-900">
                                    User
                                </div>
                                <div class="text-sm text-gray-600">Focused</div>
                            </div>
                        </div>

                        <div
                            class="mt-10 flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6"
                        >
                            <Link
                                v-if="!$page.props.auth.user"
                                :href="route('register')"
                                class="group relative px-8 py-4 text-lg font-bold rounded-xl text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 transform hover:scale-105 hover:shadow-2xl transition-all duration-300"
                            >
                                <span
                                    class="relative flex items-center justify-center space-x-3"
                                >
                                    <span>Start Booking Now!</span>
                                    <ArrowRightIcon
                                        class="h-6 w-6 group-hover:translate-x-2 transition-transform duration-300"
                                    />
                                </span>
                                <div
                                    class="absolute inset-0 rounded-xl border-2 border-white/30 animate-ping-slow"
                                ></div>
                            </Link>

                            <a
                                href="#features"
                                class="px-8 py-4 text-lg font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                            >
                                <span
                                    class="flex items-center justify-center space-x-3"
                                >
                                    <span>Learn More</span>
                                    <ChevronDownIcon
                                        class="h-5 w-5 animate-bounce"
                                    />
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 mb-4"
                        >
                            <ComputerDesktopIcon
                                class="h-5 w-5 text-blue-600 mr-2"
                            />
                            <span class="text-sm font-semibold text-blue-600"
                                >Dashboard Preview</span
                            >
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            Experience Our
                            <span
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"
                            >
                                Simple Dashboards
                            </span>
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Experience effortless appointment management with
                            our clean, intuitive interface that makes booking
                            simple for all users.
                        </p>
                    </div>

                    <!-- Dashboard Images Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- User Dashboard -->
                        <div class="group relative">
                            <!-- Glow Effect Background -->
                            <div
                                class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-3xl blur opacity-25 group-hover:opacity-40 transition-all duration-500"
                            ></div>

                            <!-- Main Card -->
                            <div
                                class="relative bg-white rounded-2xl p-8 shadow-2xl"
                            >
                                <!-- Card Header -->
                                <div
                                    class="flex items-center justify-between mb-8"
                                >
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-12 w-12 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center"
                                        >
                                            <UserIcon
                                                class="h-7 w-7 text-white"
                                            />
                                        </div>
                                        <div>
                                            <h3
                                                class="text-2xl font-bold text-gray-900"
                                            >
                                                User Dashboard
                                            </h3>
                                            <p class="text-gray-600">
                                                For users
                                            </p>
                                        </div>
                                    </div>
                                    <span
                                        class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-medium"
                                    >
                                        User View
                                    </span>
                                </div>

                                <!-- Image Container -->
                                <div
                                    class="relative rounded-xl overflow-hidden shadow-lg border-2 border-gray-200 bg-white group-hover:border-purple-300 transition-all duration-300"
                                >
                                    <!-- Actual Image -->
                                    <img
                                        src="/images/userside.png"
                                        alt="User Dashboard Preview"
                                        class="w-full h-auto object-cover transform group-hover:scale-[1.02] transition-transform duration-500"
                                    />

                                    <!-- Overlay on hover -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-purple-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center p-6"
                                    >
                                        <div
                                            class="bg-white/90 backdrop-blur-sm rounded-lg p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                        >
                                            <p
                                                class="text-gray-900 font-medium text-center"
                                            >
                                                Manage your bookings easily
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Features List -->
                                <div class="mt-8 space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center"
                                        >
                                            <CheckIcon
                                                class="h-5 w-5 text-purple-600"
                                            />
                                        </div>
                                        <span class="text-gray-700"
                                            >View upcoming appointments</span
                                        >
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center"
                                        >
                                            <CheckIcon
                                                class="h-5 w-5 text-purple-600"
                                            />
                                        </div>
                                        <span class="text-gray-700"
                                            >Book available services</span
                                        >
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center"
                                        >
                                            <CheckIcon
                                                class="h-5 w-5 text-purple-600"
                                            />
                                        </div>
                                        <span class="text-gray-700"
                                            >Check account status</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Dashboard -->
                        <div class="group relative">
                            <!-- Glow Effect Background -->
                            <div
                                class="absolute -inset-4 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-3xl blur opacity-25 group-hover:opacity-40 transition-all duration-500"
                            ></div>

                            <!-- Main Card -->
                            <div
                                class="relative bg-white rounded-2xl p-8 shadow-2xl"
                            >
                                <!-- Card Header -->
                                <div
                                    class="flex items-center justify-between mb-8"
                                >
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-12 w-12 rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center"
                                        >
                                            <ShieldCheckIcon
                                                class="h-7 w-7 text-white"
                                            />
                                        </div>
                                        <div>
                                            <h3
                                                class="text-2xl font-bold text-gray-900"
                                            >
                                                Admin Dashboard
                                            </h3>
                                            <p class="text-gray-600">
                                                For system administrators
                                            </p>
                                        </div>
                                    </div>
                                    <span
                                        class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium"
                                    >
                                        Admin View
                                    </span>
                                </div>

                                <!-- Image Container -->
                                <div
                                    class="relative rounded-xl overflow-hidden shadow-lg border-2 border-gray-200 bg-white group-hover:border-blue-300 transition-all duration-300"
                                >
                                    <!-- Actual Image -->
                                    <img
                                        src="/images/adminside.png"
                                        alt="Admin Dashboard Preview"
                                        class="w-full h-auto object-cover transform group-hover:scale-[1.02] transition-transform duration-500"
                                    />

                                    <!-- Overlay on hover -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-blue-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center p-6"
                                    >
                                        <div
                                            class="bg-white/90 backdrop-blur-sm rounded-lg p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                        >
                                            <p
                                                class="text-gray-900 font-medium text-center"
                                            >
                                                Manage system and appointments
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Features List -->
                                <div class="mt-8 space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center"
                                        >
                                            <CheckIcon
                                                class="h-5 w-5 text-blue-600"
                                            />
                                        </div>
                                        <span class="text-gray-700"
                                            >System performance overview</span
                                        >
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center"
                                        >
                                            <CheckIcon
                                                class="h-5 w-5 text-blue-600"
                                            />
                                        </div>
                                        <span class="text-gray-700"
                                            >Manage appointments</span
                                        >
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center"
                                        >
                                            <CheckIcon
                                                class="h-5 w-5 text-blue-600"
                                            />
                                        </div>
                                        <span class="text-gray-700"
                                            >Control services</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="text-center mt-16">
                        <div
                            class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 mb-6"
                        >
                            <RocketLaunchIcon
                                class="h-6 w-6 text-blue-600 mr-3"
                            />
                            <span class="text-lg font-semibold text-blue-600"
                                >Ready to Experience?</span
                            >
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-6">
                            Start Using Our Dashboard Today!
                        </h3>
                        <p class="text-gray-600 max-w-2xl mx-auto mb-8">
                            Sign up today and experience our intuitive dashboard
                            where you can easily manage appointments, book
                            services, and track your schedules all in one place.
                        </p>
                        <div
                            class="flex flex-col sm:flex-row justify-center gap-4"
                        >
                            <Link
                                v-if="!$page.props.auth.user"
                                :href="route('register')"
                                class="group px-8 py-4 text-lg font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                            >
                                <span class="flex items-center space-x-3">
                                    <UserPlusIcon class="h-6 w-6" />
                                    <span>Create Free Account</span>
                                </span>
                            </Link>
                            <Link
                                v-if="$page.props.auth.user"
                                :href="
                                    $page.props.auth.user.role === 'admin'
                                        ? route('admin.dashboard')
                                        : route('customer.dashboard')
                                "
                                class="group px-8 py-4 text-lg font-bold rounded-xl text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                            >
                                <span class="flex items-center space-x-3">
                                    <ArrowRightIcon class="h-6 w-6" />
                                    <span>Go to My Dashboard</span>
                                </span>
                            </Link>
                            <a
                                href="#features"
                                class="group px-8 py-4 text-lg font-medium rounded-xl text-gray-700 bg-white border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50 transform hover:scale-105 hover:shadow-xl transition-all duration-300"
                            >
                                <span class="flex items-center space-x-3">
                                    <span>View More Features</span>
                                    <ChevronDownIcon
                                        class="h-5 w-5 group-hover:animate-bounce"
                                    />
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->

            <div class="py-20 bg-gradient-to-r from-purple-50 to-pink-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            How to Book in
                            <span
                                class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent"
                            >
                                3 Easy Steps
                            </span>
                        </h2>
                        <p class="text-xl text-gray-600">
                            Simple enough for users experience
                        </p>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch"
                    >
                        <!-- Step 1 -->
                        <div class="relative group">
                            <div
                                class="absolute -top-6 -left-6 text-6xl font-bold text-purple-200/50"
                            >
                                01
                            </div>
                            <div
                                class="relative bg-white rounded-2xl p-8 shadow-xl h-full flex flex-col transform group-hover:scale-105 transition-all duration-500"
                            >
                                <div
                                    class="w-20 h-20 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center mb-6 mx-auto"
                                >
                                    <UserPlusIcon
                                        class="h-10 w-10 text-white"
                                    />
                                </div>
                                <h3
                                    class="text-2xl font-bold text-center text-gray-900 mb-4"
                                >
                                    Register Account
                                </h3>
                                <p class="text-gray-600 text-center">
                                    Create your account in just a few steps
                                    using a valid email address. Simple
                                    registration to get started quickly.
                                </p>
                                <div class="mt-6 flex justify-center">
                                    <div
                                        class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-medium"
                                    >
                                        Quick & Free
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative group">
                            <div
                                class="absolute -top-6 -left-6 text-6xl font-bold text-blue-200/50"
                            >
                                02
                            </div>
                            <div
                                class="relative bg-white rounded-2xl p-8 shadow-xl transform group-hover:scale-105 transition-all duration-500"
                            >
                                <div
                                    class="w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center mb-6 mx-auto"
                                >
                                    <CalendarDaysIcon
                                        class="h-10 w-10 text-white"
                                    />
                                </div>
                                <h3
                                    class="text-2xl font-bold text-center text-gray-900 mb-4"
                                >
                                    Choose Service
                                </h3>
                                <p class="text-gray-600 text-center">
                                    Browse available services and select the one
                                    that fits your needs. Choose a schedule that
                                    works best for you.
                                </p>
                                <div class="mt-6 flex justify-center">
                                    <div
                                        class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium"
                                    >
                                        Multiple Options
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative group">
                            <div
                                class="absolute -top-6 -left-6 text-6xl font-bold text-green-200/50"
                            >
                                03
                            </div>
                            <div
                                class="relative bg-white rounded-2xl p-8 shadow-xl transform group-hover:scale-105 transition-all duration-500"
                            >
                                <div
                                    class="w-20 h-20 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mb-6 mx-auto"
                                >
                                    <CheckCircleIcon
                                        class="h-10 w-10 text-white"
                                    />
                                </div>
                                <h3
                                    class="text-2xl font-bold text-center text-gray-900 mb-4"
                                >
                                    Confirm Booking
                                </h3>
                                <p class="text-gray-600 text-center">
                                    Select your preferred time slot and confirm
                                    your appointment. Receive instant
                                    confirmation and helpful reminders.
                                </p>
                                <div class="mt-6 flex justify-center">
                                    <div
                                        class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium"
                                    >
                                        Instant Confirmation
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            Available Services
                        </h2>
                        <p class="text-xl text-gray-600">
                            Choose a service and book your appointment easily
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div
                            class="bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl p-6 text-center transform hover:scale-105 transition-all duration-300"
                        >
                            <div class="text-4xl mb-4">🗣️</div>
                            <h3 class="font-bold text-gray-900">
                                Consultation Services
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Book one-on-one consultations easily.
                            </p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl p-6 text-center transform hover:scale-105 transition-all duration-300"
                        >
                            <div class="text-4xl mb-4">🧪</div>
                            <h3 class="font-bold text-gray-900">
                                Session Appointments
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Schedule sessions based on availability.
                            </p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl p-6 text-center transform hover:scale-105 transition-all duration-300"
                        >
                            <div class="text-4xl mb-4">👥</div>
                            <h3 class="font-bold text-gray-900">
                                Group Meetings
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Reserve time slots for group activities.
                            </p>
                        </div>
                        <div
                            class="bg-gradient-to-br from-yellow-100 to-orange-100 rounded-xl p-6 text-center transform hover:scale-105 transition-all duration-300"
                        >
                            <div class="text-4xl mb-4">📅</div>
                            <h3 class="font-bold text-gray-900">
                                Resource Booking
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Book available resources with ease.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="relative py-20 overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 transform skew-y-3"
                ></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-4xl font-bold text-white mb-6">
                            Ready to Book Your Appointments with Ease?
                        </h2>
                        <p
                            class="text-xl text-purple-100 mb-10 max-w-2xl mx-auto"
                        >
                            A simple appointment booking system where users can
                            register, choose available services, and manage
                            their bookings with confidence.
                        </p>

                        <div
                            class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6"
                        >
                            <Link
                                v-if="!$page.props.auth.user"
                                :href="route('register')"
                                class="group px-10 py-4 text-lg font-bold rounded-xl text-purple-600 bg-white hover:bg-gray-50 transform hover:scale-105 hover:shadow-2xl transition-all duration-300"
                            >
                                <span
                                    class="flex items-center justify-center space-x-3"
                                >
                                    <span>Get Started Now</span>
                                    <RocketLaunchIcon
                                        class="h-6 w-6 group-hover:animate-bounce"
                                    />
                                </span>
                            </Link>

                            <Link
                                v-if="!$page.props.auth.user"
                                :href="route('login')"
                                class="px-10 py-4 text-lg font-medium rounded-xl text-white border-2 border-white hover:bg-white/10 transform hover:scale-105 transition-all duration-300"
                            >
                                <span
                                    class="flex items-center justify-center space-x-3"
                                >
                                    <ArrowRightOnRectangleIcon
                                        class="h-6 w-6"
                                    />
                                    <span>Access Your Account</span>
                                </span>
                            </Link>
                        </div>

                        <p class="mt-8 text-purple-200 text-sm">
                            Free to use • User-friendly design • Built for
                            simple appointment booking
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div
                                class="h-10 w-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center"
                            >
                                <BookOpenIcon class="h-6 w-6 text-white" />
                            </div>
                            <div>
                                <span class="text-2xl font-bold"
                                    >SchoolSync</span
                                >
                                <p class="text-sm text-gray-400">
                                    Appointment System
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-400">
                            A simple appointment booking system designed to help
                            users register, choose services, and manage
                            appointments with ease.
                        </p>
                        <div class="mt-6 flex space-x-4">
                            <span
                                class="px-3 py-1 bg-gray-800 rounded-full text-sm"
                                >User-Based System</span
                            >
                            <span
                                class="px-3 py-1 bg-gray-800 rounded-full text-sm"
                                >Easy Booking</span
                            >
                            <span
                                class="px-3 py-1 bg-gray-800 rounded-full text-sm"
                                >School Project</span
                            >
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-3">
                            <li>
                                <Link
                                    :href="route('login')"
                                    class="text-gray-400 hover:text-white transition-colors duration-300"
                                >
                                    Login
                                </Link>
                            </li>
                            <li>
                                <Link
                                    :href="route('register')"
                                    class="text-gray-400 hover:text-white transition-colors duration-300"
                                >
                                    Register
                                </Link>
                            </li>
                            <li>
                                <a
                                    href="#features"
                                    class="text-gray-400 hover:text-white transition-colors duration-300"
                                >
                                    Features
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tech Stack -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Powered By</h3>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <div class="h-6 w-6 bg-red-500 rounded"></div>
                                <span class="text-gray-400"
                                    >Laravel Framework</span
                                >
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="h-6 w-6 bg-green-500 rounded"></div>
                                <span class="text-gray-400">Vue.js 3</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="h-6 w-6 bg-blue-500 rounded"></div>
                                <span class="text-gray-400">Tailwind CSS</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                    <p class="text-gray-400">
                        Built with ❤️ as an academic project • PHP
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        SchoolSync © 2026 • A simple appointment booking system
                        for learning purposes
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import {
    BookOpenIcon,
    ArrowRightOnRectangleIcon,
    UserPlusIcon,
    CalendarDaysIcon,
    BellAlertIcon,
    UserGroupIcon,
    CheckCircleIcon,
    ArrowRightIcon,
    ChevronDownIcon,
    SparklesIcon,
    RocketLaunchIcon,
} from "@heroicons/vue/24/outline";
</script>

<style>
@keyframes blob {
    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes gradient {
    0%,
    100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes ping-slow {
    75%,
    100% {
        transform: scale(2);
        opacity: 0;
    }
}

@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
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

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

.animate-ping-slow {
    animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.hover\:scale-105:hover {
    transform: scale(1.05);
}

.transition-all {
    transition-property: all;
}
</style>
