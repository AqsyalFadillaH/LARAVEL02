<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar Presensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
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
                <a href="#" class="flex items-center p-3 rounded-lg bg-blue-50 text-blue-700 w-full">
                    <i class="fas fa-th-large text-lg w-8"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <button @click="open = !open" class="flex items-center justify-between p-3 rounded-lg hover:bg-blue-50 text-blue-700 w-full transition">
                    <div class="flex items-center">
                        <i class="fas fa-book text-lg w-8"></i>
                        <span class="font-medium">Akademik</span>
                    </div>
                    <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'" class="text-sm"></i>
                </button>
                <div x-show="open" x-transition class="ml-8 space-y-1">
                    <a href="{{ route('presensi.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 w-full">Presensi</a>
                    <a href="{{ route('tugas.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 w-full">Tugas Kuliah</a>
                    <a href="{{ route('jadwal.index') }}" class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-700 w-full">Jadwal Kuliah</a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Daftar Presensi</h1>
                    <p class="text-gray-500">Kelola data presensi mahasiswa</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/profiles" class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center hover:border-blue-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.5 7.5 0 0112 15.5a7.5 7.5 0 016.879 2.304M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Table Presensi -->
            <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Data Presensi</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-blue-50 text-blue-700">
                                <th class="px-4 py-3 font-medium rounded-l-lg">Nama Mahasiswa</th>
                                <th class="px-4 py-3 font-medium">Mata Kuliah</th>
                                <th class="px-4 py-3 font-medium">Tanggal</th>
                                <th class="px-4 py-3 font-medium rounded-r-lg">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $presensi)
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">{{ $presensi->nama_mahasiswa }}</td>
                                    <td class="px-4 py-3">{{ $presensi->mata_kuliah }}</td>
                                    <td class="px-4 py-3">{{ $presensi->tanggal }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-sm 
                                            {{ ($presensi->status == 'Hadir' ? 'bg-green-100 text-green-600' : ($presensi->status == 'Absen' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600')) }}">
                                            {{ $presensi->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>