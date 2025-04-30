<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Portal - Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .verify-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0 overflow-hidden">
    <!-- Decorative blobs -->
    <div class="blob bg-blue-300/50 w-64 h-64 top-0 left-0"></div>
    <div class="blob bg-purple-300/40 w-80 h-80 bottom-0 right-0"></div>
    <div class="blob bg-pink-200/30 w-72 h-72 bottom-20 left-20"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="verify-card max-w-md mx-auto rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 to-indigo-800 p-6 text-center">
                <h1 class="text-3xl font-bold text-white mb-1">Email Verification</h1>
                <p class="text-blue-100 text-sm">Verify your account to continue</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                @if (session('status'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.verify') }}">
                    @csrf

                    <div class="mb-6">
                        <p class="text-gray-700">We need to verify your account before you can proceed. Please check your email for a verification code or request a new one.</p>
                    </div>

                    <div class="mb-6">
                        <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">Verification Code</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-1 1v7a1 1 0 001 1h10a1 1 0 001-1V8a1 1 0 00-1-1h-1V6a4 4 0 00-4-4zm-2 5V6a2 2 0 114 0v1H8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="otp" id="otp" placeholder="Enter 6-digit code" class="pl-10 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 @error('otp') border-red-500 @enderror" required autocomplete="off" autofocus value="{{ old('otp') }}">
                            @error('otp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-medium py-3 px-6 rounded-lg hover:bg-gradient-to-r hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:-translate-y-1">
                            Verify
                        </button>
                        <a href="{{ route('verification.send') }}" class="text-sm text-blue-600 hover:text-blue-800">Request a new code</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Validation errors display -->
        @if ($errors->any())
            <div class="fixed bottom-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg max-w-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
