<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .profiles-card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .avatar-container {
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }
        .animated-gradient {
            background: linear-gradient(-45deg, #4f46e5, #3b82f6, #0ea5e9, #0284c7);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
        .field-container {
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .field-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full mx-auto">
        <div class="profiles-card bg-white rounded-2xl overflow-hidden">
            <!-- Header -->
            <div class="animated-gradient p-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-user-circle mr-2"></i>
                        Profiles
                    </h1>
                    <div id="action-buttons">
                        <button
                            id="edit-button"
                            class="flex items-center gap-2 bg-white/90 text-blue-600 px-5 py-2.5 rounded-lg font-medium hover:bg-white transition-colors shadow-md"
                        >
                            <i class="fas fa-pencil-alt"></i>
                            Edit Profiles
                        </button>
                        <div id="save-cancel-buttons" class="hidden gap-3 flex">
                            <button
                                id="cancel-button"
                                class="flex items-center gap-2 bg-white/90 text-gray-600 px-5 py-2.5 rounded-lg font-medium hover:bg-white transition-colors shadow-md"
                            >
                                <i class="fas fa-times"></i>
                                Cancel
                            </button>
                            <button
                                id="save-button"
                                class="flex items-center gap-2 bg-emerald-500 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-emerald-600 transition-colors shadow-md"
                            >
                                <i class="fas fa-check"></i>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex items-center">
                    <div class="avatar-container rounded-full p-1.5 w-28 h-28 flex items-center justify-center">
                        <div class="bg-blue-50 rounded-full w-full h-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-300" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <div class="ml-6">
                        <h2 id="header-username" class="text-3xl font-bold text-white">{{ $user->username ?? 'Not set' }}</h2>
                        <div class="flex items-center mt-2 text-blue-100">
                            <span id="header-nim" class="bg-blue-800/50 backdrop-blur-sm px-4 py-1.5 rounded-full text-sm font-medium mr-3">
                                {{ $user->NIM ?? 'Not set' }}
                            </span>
                            <span id="header-major" class="flex items-center">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                {{ $profiles->major ?? 'Not set' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profiles Content -->
            <div class="p-8">
                <!-- View Mode -->
                <div id="view-mode" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="field-container bg-gray-50 p-5 rounded-xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">Username</h3>
                        </div>
                        <p id="view-username" class="text-gray-800 font-medium text-lg">{{ $user->username ?? 'Not set' }}</p>
                    </div>

                    <div class="field-container bg-gray-50 p-5 rounded-xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-id-card text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">NIM</h3>
                        </div>
                        <p id="view-nim" class="text-gray-800 font-medium text-lg">{{ $user->NIM ?? 'Not set' }}</p>
                    </div>

                    <div class="field-container bg-gray-50 p-5 rounded-xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        </div>
                        <p id="view-email" class="text-gray-800 font-medium text-lg">{{ $user->email ?? 'Not set' }}</p>
                    </div>

                    <div class="field-container bg-gray-50 p-5 rounded-xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-calendar text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">Birthdate</h3>
                        </div>
                        <p id="view-birthdate" class="text-gray-800 font-medium text-lg">{{ $profiles->birthdate ? $profiles->birthdate->format('Y-m-d') : 'Not set' }}</p>
                    </div>

                    <div class="field-container bg-gray-50 p-5 rounded-xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-venus-mars text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">Gender</h3>
                        </div>
                        <p id="view-gender" class="text-gray-800 font-medium text-lg capitalize">{{ $profiles->gender ?? 'Not set' }}</p>
                    </div>

                    <div class="field-container bg-gray-50 p-5 rounded-xl">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-university text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">Faculty</h3>
                        </div>
                        <p id="view-faculty" class="text-gray-800 font-medium text-lg">{{ $profiles->faculty ?? 'Not set' }}</p>
                    </div>

                    <div class="field-container bg-gray-50 p-5 rounded-xl md:col-span-2">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-book text-blue-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-500">Major</h3>
                        </div>
                        <p id="view-major" class="text-gray-800 font-medium text-lg">{{ $profiles->major ?? 'Not set' }}</p>
                    </div>
                </div>

                <!-- Edit Mode -->
                <form id="edit-mode" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                            <input
                                type="text"
                                id="edit-username"
                                name="username"
                                value="{{ $user->username ?? '' }}"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            />
                            <p class="error-username text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">NIM</label>
                        <div class="relative">
                            <i class="fas fa-id-card absolute left-3 top-3.5 text-gray-400"></i>
                            <input
                                type="text"
                                id="edit-nim"
                                name="NIM"
                                value="{{ $user->NIM ?? '' }}"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            />
                            <p class="error-NIM text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                            <input
                                type="email"
                                id="edit-email"
                                name="email"
                                value="{{ $user->email ?? '' }}"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            />
                            <p class="error-email text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                        <div class="relative">
                            <i class="fas fa-calendar absolute left-3 top-3.5 text-gray-400"></i>
                            <input
                                type="date"
                                id="edit-date"
                                name="birthdate"
                                value="{{ $profiles->birthdate ? $profiles->birthdate->format('Y-m-d') : '' }}"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            />
                            <p class="error-birthdate text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <div class="relative">
                            <i class="fas fa-venus-mars absolute left-3 top-3.5 text-gray-400"></i>
                            <select
                                id="edit-gender"
                                name="gender"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            >
                                <option value="" {{ !$profiles->gender ? 'selected' : '' }}>Select Gender</option>
                                <option value="male" {{ $profiles->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $profiles->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $profiles->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <p class="error-gender text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Faculty</label>
                        <div class="relative">
                            <i class="fas fa-university absolute left-3 top-3.5 text-gray-400"></i>
                            <input
                                type="text"
                                id="edit-faculty"
                                name="faculty"
                                value="{{ $profiles->faculty ?? '' }}"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            />
                            <p class="error-faculty text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Major</label>
                        <div class="relative">
                            <i class="fas fa-book absolute left-3 top-3.5 text-gray-400"></i>
                            <input
                                type="text"
                                id="edit-major"
                                name="major"
                                value="{{ $profiles->major ?? '' }}"
                                class="input-field pl-10 w-full border border-gray-300 rounded-xl py-3 px-4 focus:outline-none"
                            />
                            <p class="error-major text-xs text-red-500 mt-1.5 hidden"></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Status Messages -->
        <div id="status-message" class="mt-4 hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set CSRF token for all AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Elements
            const viewMode = document.getElementById('view-mode');
            const editMode = document.getElementById('edit-mode');
            const editButton = document.getElementById('edit-button');
            const saveButton = document.getElementById('save-button');
            const cancelButton = document.getElementById('cancel-button');
            const saveButtons = document.getElementById('save-cancel-buttons');
            const statusMessage = document.getElementById('status-message');

            // Header elements
            const headerUsername = document.getElementById('header-username');
            const headerNim = document.getElementById('header-nim');
            const headerMajor = document.getElementById('header-major');

            // Fetch profiles data on page load
            fetchProfilesData();

            // Show edit mode
            editButton.addEventListener('click', () => {
                fetchProfilesData();
                editMode.classList.remove('hidden');
                viewMode.classList.add('hidden');
                editButton.classList.add('hidden');
                saveButtons.classList.remove('hidden');
            });

            // Cancel edit
            cancelButton.addEventListener('click', () => {
                editMode.classList.add('hidden');
                viewMode.classList.remove('hidden');
                editButton.classList.remove('hidden');
                saveButtons.classList.add('hidden');
                document.querySelectorAll('.text-red-500').forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });
            });

            // Save changes
            saveButton.addEventListener('click', async () => {
                saveButton.disabled = true;
                saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                document.querySelectorAll('.text-red-500').forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });

                const formData = new FormData(document.getElementById('edit-mode'));
                console.log('Sending update request with data:', Object.fromEntries(formData));

                try {
                    const response = await fetch('/profiles', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    console.log('Response status:', response.status);
                    const data = await response.json();
                    console.log('Response data:', data);

                    if (response.ok) {
                        updateProfilesInterface(data.profiles);
                        showStatusMessage(data.message, 'success');
                        editMode.classList.add('hidden');
                        viewMode.classList.remove('hidden');
                        editButton.classList.remove('hidden');
                        saveButtons.classList.add('hidden');
                    } else {
                        if (data.errors) {
                            console.log('Validation errors:', data.errors);
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.querySelector(`.error-${field}`);
                                if (errorElement) {
                                    errorElement.textContent = data.errors[field][0];
                                    errorElement.classList.remove('hidden');
                                }
                            });
                        }
                        showStatusMessage(data.message || 'There were errors in your submission. Please check the form.', 'error');
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                    showStatusMessage('An error occurred while updating your profile. Please try again.', 'error');
                } finally {
                    saveButton.disabled = false;
                    saveButton.innerHTML = '<i class="fas fa-check"></i> Save Changes';
                }
            });

            // Fetch profiles data
            async function fetchProfilesData() {
                try {
                    console.log('Fetching profile data...');
                    const response = await fetch('/profiles/current', {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });

                    console.log('Fetch response status:', response.status);
                    const data = await response.json();
                    console.log('Fetch response data:', data);

                    if (response.ok && data.status === 'success') {
                        updateFormFields(data.profiles);
                        updateProfilesInterface(data.profiles);
                    } else {
                        showStatusMessage('Failed to load profile data.', 'error');
                    }
                } catch (error) {
                    console.error('Error fetching profiles data:', error);
                    showStatusMessage('Failed to load profile data. Please try again.', 'error');
                }
            }

            // Update form fields with profiles data
            function updateFormFields(profiles) {
                document.getElementById('edit-username').value = profiles.username || '';
                document.getElementById('edit-nim').value = profiles.NIM || '';
                document.getElementById('edit-email').value = profiles.email || '';
                document.getElementById('edit-date').value = profiles.birthdate || '';
                const genderSelect = document.getElementById('edit-gender');
                Array.from(genderSelect.options).forEach(option => {
                    option.selected = option.value === (profiles.gender || '');
                });
                document.getElementById('edit-faculty').value = profiles.faculty || '';
                document.getElementById('edit-major').value = profiles.major || '';
            }

            // Update profiles interface with new data
            function updateProfilesInterface(profiles) {
                headerUsername.textContent = profiles.username || 'Not set';
                headerNim.textContent = profiles.NIM || 'Not set';
                headerMajor.textContent = profiles.major || 'Not set';
                document.getElementById('view-username').textContent = profiles.username || 'Not set';
                document.getElementById('view-nim').textContent = profiles.NIM || 'Not set';
                document.getElementById('view-email').textContent = profiles.email || 'Not set';
                document.getElementById('view-birthdate').textContent = profiles.birthdate || 'Not set';
                document.getElementById('view-gender').textContent = profiles.gender ? profiles.gender.charAt(0).toUpperCase() + profiles.gender.slice(1) : 'Not set';
                document.getElementById('view-faculty').textContent = profiles.faculty || 'Not set';
                document.getElementById('view-major').textContent = profiles.major || 'Not set';
            }

            // Show status message
            function showStatusMessage(message, type) {
                statusMessage.textContent = message;
                statusMessage.className = 'mt-6 p-4 rounded-xl text-center font-medium';
                if (type === 'success') {
                    statusMessage.classList.add('bg-green-100', 'text-green-800');
                } else {
                    statusMessage.classList.add('bg-red-100', 'text-red-800');
                }
                statusMessage.classList.remove('hidden');
                statusMessage.classList.add('pulse');
                setTimeout(() => {
                    statusMessage.classList.add('hidden');
                    statusMessage.classList.remove('pulse');
                }, 5000);
            }
        });
    </script>
</body>
</html>
