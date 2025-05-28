<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard SSO UIN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        }
        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white h-screen shadow-xl border-r border-gray-100">
            <div class="p-6 flex items-center space-x-3">
                <img alt="UIN Logo" class="h-10" src="https://storage.googleapis.com/a1aa/image/cxKpfVWtSjF79x60o1ik_-gYqtqs6qPKHnGUrT_kOgw.jpg"/>
                <span class="text-xl font-bold text-blue-800">SSO UIN</span>
            </div>
            
            <nav class="mt-6 px-4 space-y-1" x-data="{ open: false }">
    <!-- Tombol Dashboard -->
    <a href="#" class="flex items-center p-3 rounded-lg bg-red-50 text-red-700 w-full">
        <i class="fas fa-th-large text-lg w-8"></i>
        <span class="font-medium">Dashboard</span>
    </a>

    <!-- Tombol Akademik -->
    <button @click="open = !open" class="flex items-center justify-between p-3 rounded-lg hover:bg-red-50 text-red-700 w-full transition">
        <div class="flex items-center">
            <i class="fas fa-book text-lg w-8"></i>
            <span class="font-medium">Akademik</span>
        </div>
        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-sm"></i>
    </button>

    <!-- Submenu Dropdown -->
    <div x-show="open" x-transition class="ml-8 space-y-1">
        <a href="{{ route('presensi.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 w-full">Presensi</a>
        <a href="{{ route('tugas.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 w-full">Tugas Kuliah</a>
        <a href="{{ route('jadwal.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 w-full">Jadwal Kuliah</a>
    </div>
</nav>
    </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500">Selamat datang di Sistem SSO UIN Jakarta</p>
    </div>
    <div class="flex items-center space-x-4">
        <!-- Notifikasi -->

        <!-- Navigasi bulat -->
        <a href="/profiles" class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center hover:border-blue-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.5 7.5 0 0112 15.5a7.5 7.5 0 016.879 2.304M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </a>
    </div>
</div>


            <!-- Welcome Section -->
            <div class="bg-red-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->username }}! <span class="wave">👋</span></h2>
                        <p class="opacity-90">Anda telah masuk ke sistem terpadu UIN Jakarta</p>
                    </div>
                    <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-graduate text-4xl"></i>
                    </div>
                </div>
            </div>

            <!-- User Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-red-100 rounded-lg">
                            <i class="fas fa-id-card text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Username</p>
                            <p class="font-semibold">{{ auth()->user()->username }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <i class="fas fa-hashtag text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">NIM</p>
                            <p class="font-semibold">{{ auth()->user()->nim }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <i class="fas fa-envelope text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="font-semibold">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- E-Semesta Apps -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Aplikasi E-Semesta</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-indigo-100 rounded-lg">
                                    <i class="fas fa-graduation-cap text-red-600 text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold">eAkademik Portal</p>
                                    <p class="text-sm text-gray-500">Manajemen akademik terpadu</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supporting Apps -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Aplikasi Pendukung</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <i class="fas fa-globe text-blue-600"></i>
                            </div>
                            <span class="font-medium">Website</span>
                        </div>
                        <p class="text-sm text-gray-500">Portal resmi UIN Jakarta</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <span class="font-medium">E-mail</span>
                        </div>
                        <p class="text-sm text-gray-500">Email institusi</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <i class="fas fa-th-large text-green-600"></i>
                            </div>
                            <span class="font-medium">Office</span>
                        </div>
                        <p class="text-sm text-gray-500">Microsoft Office 365</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm card-hover">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <i class="fas fa-cloud text-purple-600"></i>
                            </div>
                            <span class="font-medium">OneDrive</span>
                        </div>
                        <p class="text-sm text-gray-500">Cloud storage 1TB</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-gray-200 pt-6 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm">
                    <div class="mb-2 md:mb-0">
                        2025© UIN Syarif Hidayatullah Jakarta
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition duration-300 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>