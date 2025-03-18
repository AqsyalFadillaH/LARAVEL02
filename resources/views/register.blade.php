<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Portal - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .register-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .circle {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
        }
        .circle-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(to right, #6dd5ed, #2193b0);
            top: -150px;
            right: -150px;
        }
        .circle-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            bottom: -100px;
            left: -100px;
        }
        .step-indicator {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0 overflow-x-hidden">
    <!-- Decorative circles -->
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="register-card max-w-2xl mx-auto rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-6 text-center">
                <h1 class="text-2xl font-bold text-white mb-1">Student Registration</h1>
                <p class="text-indigo-100 text-sm">Create your academic account</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf

                    <!-- Step indicators -->
                    <div class="flex justify-between mb-8">
                        <div class="flex flex-col items-center">
                            <div id="step1Indicator" class="step-indicator w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-bold">1</div>
                            <span class="text-xs mt-1 text-gray-600">Basic Info</span>
                        </div>
                        <div class="flex-1 bg-gray-300 h-1 self-center mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div id="step2Indicator" class="step-indicator w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-bold">2</div>
                            <span class="text-xs mt-1 text-gray-600">Academic</span>
                        </div>
                        <div class="flex-1 bg-gray-300 h-1 self-center mx-2"></div>
                        <div class="flex flex-col items-center">
                            <div id="step3Indicator" class="step-indicator w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center text-sm font-bold">3</div>
                            <span class="text-xs mt-1 text-gray-600">Security</span>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div id="step1" class="step-content">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Personal Information</h2>

                        <div class="mb-6">
                            <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="username" id="fullname" placeholder="John Doe" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-1">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Prefer not to say</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="button" id="nextToStep2" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                                Next Step <span class="ml-1">→</span>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Academic Information -->
                    <div id="step2" class="step-content hidden">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Academic Information</h2>

                        <div class="mb-6">
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">Student ID (NIM)</label>
                            <input type="text" name="NIM" id="nim" placeholder="e.g. 12345678" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                        </div>

                        <div class="mb-6">
                            <label for="faculty" class="block text-sm font-medium text-gray-700 mb-1">Faculty</label>
                            <select name="faculty" id="faculty" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                                <option value="">Select faculty</option>
                                <option value="engineering">Engineering</option>
                                <option value="sciences">Sciences</option>
                                <option value="humanities">Humanities</option>
                                <option value="business">Business</option>
                                <option value="medicine">Medicine</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Major</label>
                            <input type="text" name="major" id="major" placeholder="e.g. Computer Science" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3">
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button type="button" id="backToStep1" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                                <span class="mr-1">←</span> Previous
                            </button>
                            <button type="button" id="nextToStep3" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                                Next Step <span class="ml-1">→</span>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Account Security -->
                    <div id="step3" class="step-content hidden">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Account Security</h2>

                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Academic Email</label>
                            <input type="email" name="email" id="email" placeholder="you@university.edu" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                            <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long with numbers and letters</p>
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3" required>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" id="terms" class="mt-1 h-4 w-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500" required>
                                <label for="terms" class="ml-2 text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-indigo-600 hover:text-indigo-800">Terms of Service</a> and <a href="#" class="text-indigo-600 hover:text-indigo-800">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <button type="button" id="backToStep2" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                                <span class="mr-1">←</span> Previous
                            </button>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-700 text-white rounded-lg hover:from-indigo-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                                Complete Registration
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="login.html" class="text-indigo-600 font-medium hover:text-indigo-800">Sign in here</a>
                    </p>
                </div>
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

    <script>
        // Step navigation
        document.getElementById('nextToStep2').addEventListener('click', function() {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('step2Indicator').classList.remove('bg-gray-300', 'text-gray-600');
            document.getElementById('step2Indicator').classList.add('bg-indigo-600', 'text-white');
        });

        document.getElementById('backToStep1').addEventListener('click', function() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('step2Indicator').classList.add('bg-gray-300', 'text-gray-600');
            document.getElementById('step2Indicator').classList.remove('bg-indigo-600', 'text-white');
        });

        document.getElementById('nextToStep3').addEventListener('click', function() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');
            document.getElementById('step3Indicator').classList.remove('bg-gray-300', 'text-gray-600');
            document.getElementById('step3Indicator').classList.add('bg-indigo-600', 'text-white');
        });

        document.getElementById('backToStep2').addEventListener('click', function() {
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('step3Indicator').classList.add('bg-gray-300', 'text-gray-600');
            document.getElementById('step3Indicator').classList.remove('bg-indigo-600', 'text-white');
        });
    </script>
</body>
</html>
