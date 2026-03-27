<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Booking System | Modern Appointment Platform</title>
    <!-- Tailwind CSS + Font Awesome + Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', 'Outfit', sans-serif; }
        body { margin: 0; background: #fef9ff; }
        /* Custom animations */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            100% { transform: translateY(-20px) rotate(6deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.08); }
        }
        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slide-in-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-slide-left { animation: slide-in-left 0.8s ease-out forwards; }
        .animate-slide-up { animation: slide-in-up 0.7s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .glass-card { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,240,0.3); }
        .hover-lift:hover { transform: translateY(-6px); transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); }
        .bg-radial { background: radial-gradient(circle at 30% 10%, rgba(139, 92, 246, 0.08), rgba(236, 72, 153, 0.05)); }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover i { transform: translateX(4px); }
    </style>
</head>
<body class="bg-radial antialiased overflow-x-hidden">

    <!-- ========================================================= -->
    <!-- NEW LAYOUT: LEFT SIDE HEADER (SIDEBAR NAVIGATION)        -->
    <!-- ========================================================= -->
    <div class="flex min-h-screen">
        
        <!-- LEFT SIDEBAR (Header / Navigation) - redesigned with modern glassmorphism -->
        <aside class="fixed lg:relative w-72 lg:w-80 h-screen bg-white/90 backdrop-blur-xl border-r border-indigo-100/60 shadow-2xl shadow-purple-200/30 z-30 flex flex-col transition-all duration-300">
            <!-- Logo area + brand -->
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

            <!-- Navigation Menu (Left Side Header Main Links) -->
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
                    <a href="#" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50/50 transition group">
                        <i class="fas fa-sign-in-alt w-5 text-gray-500 group-hover:text-indigo-500"></i>
                        <span>Sign In</span>
                    </a>
                    <a href="#" class="mt-1 flex items-center gap-4 px-4 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-500 text-white shadow-md hover:shadow-xl transition-all hover:scale-[1.02]">
                        <i class="fas fa-user-plus w-5"></i>
                        <span class="font-bold">Create Account</span>
                        <i class="fas fa-arrow-right ml-auto text-sm"></i>
                    </a>
                </div>

                <!-- mini badge / system status -->
                <div class="mt-8 p-4 rounded-2xl bg-indigo-50/60 border border-indigo-100">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-shield-alt text-indigo-500 text-sm"></i>
                        <span class="text-xs font-medium text-indigo-800">Secure booking system</span>
                    </div>
                    <p class="text-[11px] text-gray-500 mt-2">instant confirmation • 24/7 access</p>
                </div>
            </div>
            
            <!-- bottom user indicator (just design) -->
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

        <!-- MAIN CONTENT (right side, scrollable) -->
        <main class="flex-1 ml-0 lg:ml-72 w-full transition-all overflow-x-hidden">
            
            <!-- Top mini bar for mobile (optional, but keeps left header visible on desktop) -->
            <div class="lg:hidden sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-purple-100 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-bars text-purple-600 text-xl"></i>
                    <span class="font-bold text-gray-800">CliniBook</span>
                </div>
                <div class="flex gap-3">
                    <i class="fas fa-user-circle text-2xl text-purple-500"></i>
                </div>
            </div>
            
            <!-- Hero & Booking System Highlight Section -->
            <div class="relative overflow-hidden pt-10 pb-12 md:pt-16 md:pb-20 px-5 md:px-10">
                <!-- floating background orbs -->
                <div class="absolute top-20 -right-20 w-72 h-72 bg-purple-300/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 left-10 w-64 h-64 bg-pink-300/20 rounded-full blur-3xl animate-pulse"></div>
                
                <div class="max-w-6xl mx-auto relative z-2">
                    <!-- badge & system name -->
                    <div class="inline-flex items-center gap-2 bg-white/60 backdrop-blur-sm px-5 py-2 rounded-full shadow-sm border border-purple-200 mb-6 animate-slide-left">
                        <i class="fas fa-sparkle text-purple-500 text-xs"></i>
                        <span class="text-sm font-medium text-purple-700 tracking-wide">BOOKING SYSTEM v2.0</span>
                        <i class="fas fa-arrow-trend-up text-purple-400 text-xs"></i>
                    </div>
                    
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="space-y-6 animate-slide-up">
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                                <span class="text-gray-800">Smart</span>
                                <span class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 bg-clip-text text-transparent"> Booking<br></span>
                                <span class="text-gray-800">System for Modern Clinics</span>
                            </h1>
                            <p class="text-lg text-gray-600 max-w-xl">Effortless appointments, real-time availability, and zero hassle — the most patient-friendly platform to manage your health schedule.</p>
                            
                            <div class="flex flex-wrap gap-4 pt-3">
                                <a href="#" class="group px-7 py-3.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all flex items-center gap-2">
                                    <i class="fas fa-calendar-plus"></i>
                                    <span>Book Appointment Now</span>
                                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                                </a>
                                <a href="#" class="px-7 py-3.5 rounded-xl border border-gray-300 bg-white/70 text-gray-700 font-semibold hover:bg-purple-50 hover:border-purple-300 transition flex items-center gap-2">
                                    <i class="fas fa-play-circle"></i>
                                    <span>See How It Works</span>
                                </a>
                            </div>
                            <div class="flex items-center gap-6 pt-4">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-purple-200 border-2 border-white flex items-center justify-center text-xs font-bold text-purple-700">JD</div>
                                    <div class="h-8 w-8 rounded-full bg-pink-200 border-2 border-white flex items-center justify-center text-xs font-bold text-pink-700">MK</div>
                                    <div class="h-8 w-8 rounded-full bg-indigo-200 border-2 border-white flex items-center justify-center text-xs font-bold text-indigo-700">RS</div>
                                    <div class="h-8 w-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-bold text-gray-600">+2k</div>
                                </div>
                                <span class="text-sm text-gray-500"><span class="font-bold text-purple-700">2,500+</span> patients booked this month</span>
                            </div>
                        </div>
                        
                        <div class="relative flex justify-center animate-float">
                            <div class="relative w-full max-w-md">
                                <div class="absolute -inset-4 bg-gradient-to-r from-purple-400/30 to-pink-400/30 rounded-3xl blur-2xl"></div>
                                <div class="relative bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-6 border border-white/50">
                                    <div class="flex justify-between items-center border-b pb-3 border-purple-100">
                                        <h3 class="font-bold text-gray-800"><i class="fas fa-ticket-alt text-purple-500 mr-2"></i>Quick Booking Preview</h3>
                                        <span class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full">live slots</span>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex justify-between items-center p-2 hover:bg-purple-50 rounded-xl transition">
                                            <div><i class="fas fa-user-md text-purple-500 w-6"></i> <span class="text-sm font-medium">General Checkup</span></div>
                                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">available</span>
                                        </div>
                                        <div class="flex justify-between items-center p-2 hover:bg-purple-50 rounded-xl transition">
                                            <div><i class="fas fa-tooth text-purple-500 w-6"></i> <span class="text-sm font-medium">Dental Scaling</span></div>
                                            <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full">2 left</span>
                                        </div>
                                        <div class="flex justify-between items-center p-2 hover:bg-purple-50 rounded-xl transition">
                                            <div><i class="fas fa-vaccine text-purple-500 w-6"></i> <span class="text-sm font-medium">Flu Vaccination</span></div>
                                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">today</span>
                                        </div>
                                    </div>
                                    <button class="mt-5 w-full py-2.5 bg-gradient-to-r from-indigo-50 to-purple-50 text-purple-700 font-medium rounded-xl border border-purple-200 hover:shadow-md transition">View all services →</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Stats & Features Grid (modern) -->
            <div class="px-5 md:px-10 py-12 bg-white/40">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 text-center">
                        <div class="glass-card rounded-2xl p-5 shadow-md hover-lift transition-all"><i class="fas fa-bolt text-3xl text-purple-500 mb-2"></i><div class="text-2xl font-black text-gray-800">2min</div><div class="text-xs text-gray-500">avg booking time</div></div>
                        <div class="glass-card rounded-2xl p-5 shadow-md hover-lift transition-all"><i class="fas fa-calendar-week text-3xl text-pink-500 mb-2"></i><div class="text-2xl font-black text-gray-800">98%</div><div class="text-xs text-gray-500">slot fulfillment</div></div>
                        <div class="glass-card rounded-2xl p-5 shadow-md hover-lift transition-all"><i class="fas fa-clock text-3xl text-indigo-500 mb-2"></i><div class="text-2xl font-black text-gray-800">24/7</div><div class="text-xs text-gray-500">online booking</div></div>
                        <div class="glass-card rounded-2xl p-5 shadow-md hover-lift transition-all"><i class="fas fa-smile text-3xl text-emerald-500 mb-2"></i><div class="text-2xl font-black text-gray-800">100%</div><div class="text-xs text-gray-500">user satisfaction</div></div>
                    </div>
                </div>
            </div>
            
            <!-- Dashboard Previews (left-header style consistent) -->
            <div class="px-5 md:px-10 py-16 bg-gradient-to-b from-white to-purple-50/30">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <span class="inline-block px-4 py-1.5 rounded-full bg-purple-100 text-purple-700 text-sm font-semibold mb-3"><i class="fas fa-desktop mr-1"></i> dashboards preview</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Effortless experience for <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Patients & Admins</span></h2>
                    </div>
                    <div class="grid md:grid-cols-2 gap-10">
                        <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-5 py-3 flex justify-between items-center"><span class="text-white font-bold"><i class="fas fa-user mr-2"></i>User Dashboard</span><span class="bg-white/20 text-white text-xs px-2 py-1 rounded-full">patient view</span></div>
                            <div class="p-1 bg-gray-100"><img src="https://placehold.co/600x320/EEE/9b4dff?text=📅+Booking+Panel+%7C+Upcoming+Appointments" alt="user dashboard preview" class="w-full object-cover rounded-b-xl"></div>
                            <div class="p-5"><div class="flex gap-3 text-sm"><span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-full"><i class="far fa-check-circle"></i> easy booking</span><span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-full"><i class="far fa-bell"></i> reminders</span></div></div>
                        </div>
                        <div class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-5 py-3 flex justify-between items-center"><span class="text-white font-bold"><i class="fas fa-shield-alt mr-2"></i>Admin Dashboard</span><span class="bg-white/20 text-white text-xs px-2 py-1 rounded-full">full control</span></div>
                            <div class="p-1 bg-gray-100"><img src="https://placehold.co/600x320/EEE/2563eb?text=⚙️+Analytics+%7C+Manage+Appointments+%7C+Services" alt="admin dashboard preview" class="w-full object-cover rounded-b-xl"></div>
                            <div class="p-5"><div class="flex gap-3 text-sm"><span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full"><i class="fas fa-chart-line"></i> insights</span><span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full"><i class="fas fa-users"></i> staff mgmt</span></div></div>
                        </div>
                    </div>
                    <div class="text-center mt-10"><a href="#" class="inline-flex items-center gap-2 font-semibold text-purple-700 hover:text-purple-900 border-b-2 border-purple-300 pb-1">Explore full dashboard demo <i class="fas fa-arrow-right"></i></a></div>
                </div>
            </div>
            
            <!-- 3 Step Booking Process (system) -->
            <div class="px-5 md:px-10 py-16 bg-white">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12"><h2 class="text-3xl font-extrabold">Booking System in <span class="text-purple-600">3 Steps</span></h2><p class="text-gray-500 mt-2">Simple, fast and secure</p></div>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center p-6 rounded-2xl bg-gradient-to-b from-gray-50 to-white shadow-sm hover:shadow-md transition"><div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-user-plus text-3xl text-purple-600"></i></div><div class="text-xl font-bold">1. Create Account</div><p class="text-gray-500 mt-2 text-sm">Sign up in seconds, no hidden fees.</p></div>
                        <div class="text-center p-6 rounded-2xl bg-gradient-to-b from-gray-50 to-white shadow-sm hover:shadow-md transition"><div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-stethoscope text-3xl text-pink-500"></i></div><div class="text-xl font-bold">2. Pick Service</div><p class="text-gray-500 mt-2 text-sm">Choose from 10+ medical services & time slots.</p></div>
                        <div class="text-center p-6 rounded-2xl bg-gradient-to-b from-gray-50 to-white shadow-sm hover:shadow-md transition"><div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-check-double text-3xl text-emerald-600"></i></div><div class="text-xl font-bold">3. Confirm Booking</div><p class="text-gray-500 mt-2 text-sm">Receive SMS/email confirmation & manage.</p></div>
                    </div>
                </div>
            </div>
            
            <!-- Service cards grid (Booking System Services) -->
            <div class="px-5 md:px-10 py-16 bg-purple-50/20">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-10"><span class="text-purple-600 font-semibold bg-purple-100 px-4 py-1 rounded-full">📋 available services</span><h2 class="text-3xl font-bold mt-4">What would you like to book?</h2></div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl p-5 shadow-md flex gap-4 items-center transition-all hover:scale-[1.02]"><i class="fas fa-heartbeat text-3xl text-rose-400"></i><div><h3 class="font-bold">General Consultation</h3><p class="text-xs text-gray-500">with GP specialist</p></div><span class="ml-auto text-sm font-medium text-purple-600">book</span></div>
                        <div class="bg-white rounded-xl p-5 shadow-md flex gap-4 items-center transition-all hover:scale-[1.02]"><i class="fas fa-tooth text-3xl text-cyan-500"></i><div><h3 class="font-bold">Dental Check-up</h3><p class="text-xs text-gray-500">oral prophylaxis</p></div><span class="ml-auto text-sm font-medium text-purple-600">book</span></div>
                        <div class="bg-white rounded-xl p-5 shadow-md flex gap-4 items-center transition-all hover:scale-[1.02]"><i class="fas fa-baby-carriage text-3xl text-emerald-400"></i><div><h3 class="font-bold">Pediatric Care</h3><p class="text-xs text-gray-500">kids health</p></div><span class="ml-auto text-sm font-medium text-purple-600">book</span></div>
                        <div class="bg-white rounded-xl p-5 shadow-md flex gap-4 items-center transition-all hover:scale-[1.02]"><i class="fas fa-file-medical text-3xl text-indigo-400"></i><div><h3 class="font-bold">Medical Certificate</h3><p class="text-xs text-gray-500">sick leave / fit to work</p></div><span class="ml-auto text-sm font-medium text-purple-600">book</span></div>
                        <div class="bg-white rounded-xl p-5 shadow-md flex gap-4 items-center transition-all hover:scale-[1.02]"><i class="fas fa-syringe text-3xl text-blue-400"></i><div><h3 class="font-bold">Vaccination</h3><p class="text-xs text-gray-500">flu, hepatitis, etc</p></div><span class="ml-auto text-sm font-medium text-purple-600">book</span></div>
                        <div class="bg-white rounded-xl p-5 shadow-md flex gap-4 items-center transition-all hover:scale-[1.02]"><i class="fas fa-notes-medical text-3xl text-purple-400"></i><div><h3 class="font-bold">Follow-up Visit</h3><p class="text-xs text-gray-500">ongoing treatment</p></div><span class="ml-auto text-sm font-medium text-purple-600">book</span></div>
                    </div>
                </div>
            </div>
            
            <!-- CTA Banner -->
            <div class="relative mx-5 md:mx-10 my-12 rounded-3xl overflow-hidden bg-gradient-to-r from-purple-700 to-pink-700 shadow-2xl">
                <div class="absolute inset-0 bg-black/20 backdrop-blur-[2px]"></div>
                <div class="relative p-8 md:p-12 text-center text-white">
                    <i class="fas fa-calendar-star text-5xl mb-4 opacity-80"></i>
                    <h2 class="text-3xl md:text-4xl font-bold">Ready to streamline your clinic visits?</h2>
                    <p class="text-purple-100 max-w-xl mx-auto mt-3">Join thousands of patients who trust our booking system daily.</p>
                    <div class="flex flex-wrap gap-4 justify-center mt-8">
                        <a href="#" class="px-8 py-3 bg-white text-purple-700 rounded-xl font-bold shadow-lg hover:scale-105 transition-all"><i class="fas fa-user-plus mr-2"></i>Create free account</a>
                        <a href="#" class="px-8 py-3 border-2 border-white text-white rounded-xl font-semibold hover:bg-white/10 transition"><i class="fas fa-sign-in-alt mr-2"></i>Sign in</a>
                    </div>
                    <p class="text-xs text-purple-200 mt-6">No credit card required • Instant booking • HIPAA ready</p>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="bg-gray-900 text-white/80 py-10 px-5 mt-8">
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between gap-8">
                    <div><div class="flex items-center gap-2"><i class="fas fa-calendar-check text-2xl text-purple-400"></i><span class="font-bold text-xl">CliniBook</span></div><p class="text-sm text-gray-400 mt-2">Smart appointment system — modern, fast, intuitive.</p></div>
                    <div class="grid grid-cols-2 gap-8 text-sm"><div><h4 class="font-semibold text-white">Platform</h4><ul class="mt-2 space-y-1 text-gray-400"><li>How it works</li><li>Services</li><li>Dashboard</li></ul></div><div><h4 class="font-semibold text-white">Support</h4><ul class="mt-2 space-y-1 text-gray-400"><li>FAQs</li><li>Contact</li><li>Privacy</li></ul></div></div>
                </div>
                <div class="text-center text-xs text-gray-500 mt-10 border-t border-gray-800 pt-6">© 2026 Clinic Booking System — all rights reserved. simplified health access.</div>
            </footer>
        </main>
    </div>
</body>
</html>