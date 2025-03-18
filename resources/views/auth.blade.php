{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Portal - Login & Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20100%20100%22%20preserveAspectRatio%3D%22none%22%3E%3Cpolygon%20fill%3D%22%23f3f4f6%22%20points%3D%220%2C100%20100%2C0%20100%2C100%22%2F%3E%3C%2Fsvg%3E');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen m-0">
    <div class="container bg-white rounded-lg shadow-2xl relative overflow-hidden w-full max-w-3xl min-h-[500px]" id="container">
        <!-- Sign In Form -->
        <div class="form-container sign-in-container absolute top-0 h-full transition-all duration-600 ease-in-out left-0 w-1/2 z-2" id="signInContainer">
            <form action="{{ route('auth') }}" method="POST" class="bg-white flex items-center justify-center flex-col px-10 h-full text-center">
                @csrf
                <h1 class="font-bold mb-2 text-2xl text-blue-800">Academic Portal</h1>
                <span class="text-sm mb-4 text-gray-600">Sign in to your account</span>

                <div class="w-full mb-1">
                    <input type="email" name="email" placeholder="Academic Email" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <div class="w-full mb-1">
                    <input type="password" name="password" placeholder="Password" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <div class="flex justify-between w-full text-sm my-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-gray-600">Remember me</label>
                    </div>
                    <a href="#" class="text-blue-700 hover:text-blue-900">Forgot password?</a>
                </div>

                <button type="submit" class="rounded-full border border-blue-700 bg-blue-700 text-white text-xs font-bold py-3 px-10 uppercase tracking-wider transition duration-300 ease-in mt-4 hover:bg-blue-800">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Sign Up Form -->
        <div class="form-container sign-up-container absolute top-0 h-full transition-all duration-600 ease-in-out left-0 w-1/2 opacity-0 z-1" id="signUpContainer">
            <form action="{{ route('auth') }}" method="POST" class="bg-white flex items-center justify-center flex-col px-10 h-full text-center">
                @csrf
                <h1 class="font-bold mb-2 text-2xl text-blue-800">Student Registration</h1>
                <span class="text-sm mb-4 text-gray-600">Create your academic account</span>

                <div class="w-full mb-1">
                    <input type="text" name="username" placeholder="Full Name" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <div class="w-full mb-1">
                    <input type="text" name="NIM" placeholder="Student ID (NIM)" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <div class="w-full mb-1">
                    <input type="email" name="email" placeholder="Academic Email" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <div class="w-full mb-1">
                    <input type="password" name="password" placeholder="Password" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <div class="w-full mb-1">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="bg-gray-100 border border-gray-300 rounded p-3 my-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                </div>

                <button type="submit" class="rounded-full border border-blue-700 bg-blue-700 text-white text-xs font-bold py-3 px-10 uppercase tracking-wider transition duration-300 ease-in mt-4 hover:bg-blue-800">
                    Register
                </button>
            </form>
        </div>

        <!-- Overlay Container -->
        <div class="overlay-container absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition transform duration-600 ease-in-out z-100" id="overlayContainer">
            <div class="overlay bg-gradient-to-r from-orange-700 to-red-00 bg-no-repeat bg-cover bg-center text-white relative left-[-100%] h-full w-[200%] transform transition duration-600 ease-in-out" id="overlay">
                <!-- Overlay Left Panel -->
                <div class="overlay-panel overlay-left absolute flex items-center justify-center flex-col py-0 px-10 text-center top-0 h-full w-1/2 transform transition duration-600 ease-in-out -translate-x-[20%]" id="overlayLeft">
                    <h1 class="font-bold mb-0 text-2xl">Welcome Back!</h1>
                    <p class="text-sm font-normal leading-5 tracking-wider my-5 mx-0">Access your academic portal with your credentials</p>
                    <button class="ghost bg-transparent border border-white rounded-full text-white text-xs font-bold py-3 px-10 uppercase tracking-wider transition duration-300 ease-in hover:bg-white hover:text-blue-800" id="signIn">
                        Sign In
                    </button>
                </div>

                <!-- Overlay Right Panel -->
                <div class="overlay-panel overlay-right absolute flex items-center justify-center flex-col py-0 px-10 text-center top-0 h-full w-1/2 transform transition duration-600 ease-in-out right-0" id="overlayRight">
                    <h1 class="font-bold mb-0 text-2xl">New Student?</h1>
                    <p class="text-sm font-normal leading-5 tracking-wider my-5 mx-0">Register with your student information to access the academic portal</p>
                    <button class="ghost bg-transparent border border-white rounded-full text-white text-xs font-bold py-3 px-10 uppercase tracking-wider transition duration-300 ease-in hover:bg-white hover:text-blue-800" id="signUp">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation errors display -->
    @if ($errors->any())
    <div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-md shadow-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        const signUpContainer = document.getElementById('signUpContainer');
        const signInContainer = document.getElementById('signInContainer');
        const overlayContainer = document.getElementById('overlayContainer');
        const overlay = document.getElementById('overlay');
        const overlayLeft = document.getElementById('overlayLeft');
        const overlayRight = document.getElementById('overlayRight');

        // Sign Up button click event
        signUpButton.addEventListener('click', () => {
            // Add right panel active classes
            container.classList.add('right-panel-active');

            // Handle transitions with Tailwind
            signUpContainer.classList.remove('opacity-0');
            signUpContainer.classList.add('opacity-100', 'translate-x-full', 'z-5');

            signInContainer.classList.add('translate-x-full');

            overlayContainer.classList.add('-translate-x-full');
            overlay.classList.add('translate-x-1/2');
            overlayLeft.classList.add('translate-x-0');
            overlayRight.classList.add('translate-x-[20%]');
        });

        // Sign In button click event
        signInButton.addEventListener('click', () => {
            // Remove right panel active classes
            container.classList.remove('right-panel-active');

            // Handle transitions with Tailwind
            signUpContainer.classList.add('opacity-0');
            signUpContainer.classList.remove('opacity-100', 'translate-x-full', 'z-5');

            signInContainer.classList.remove('translate-x-full');

            overlayContainer.classList.remove('-translate-x-full');
            overlay.classList.remove('translate-x-1/2');
            overlayLeft.classList.remove('translate-x-0');
            overlayRight.classList.remove('translate-x-[20%]');
        });
    </script>
</body>
</html> --}}
