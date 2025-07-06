@extends('layouts.appuser')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex">
                <!-- Sidebar -->
                <div class="md:w-1/3 bg-gray-50 p-6 border-r border-gray-200">
                    <div class="flex flex-col items-center">
                        <div class="relative group mb-4">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">
                            @else
                                <div class="w-32 h-32 rounded-full bg-green-100 flex items-center justify-center text-green-500 text-4xl border-4 border-white shadow-md">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            
                            <label for="profile_photo" class="absolute bottom-0 right-0 bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center cursor-pointer shadow-lg hover:bg-green-600 transition-colors">
                                <i class="fas fa-camera"></i>
                                <span class="sr-only">Change profile photo</span>
                            </label>
                        </div>
                        
                        <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500 mb-4">{{ Auth::user()->email }}</p>
                        
                        <div class="w-full space-y-2 mt-4">
                            <a href="#profile-info" class="block w-full py-2 px-4 rounded-lg bg-green-500 text-white text-center hover:bg-green-600 transition-colors">
                                <i class="fas fa-user-edit mr-2"></i> Edit Profile
                            </a>
                            <a href="#change-password" class="block w-full py-2 px-4 rounded-lg bg-gray-200 text-gray-700 text-center hover:bg-gray-300 transition-colors">
                                <i class="fas fa-lock mr-2"></i> Change Password
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="md:w-2/3 p-6">
                    <!-- Profile Information Form -->
                    <div id="profile-info" class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Profile Information</h3>
                        
                        @if(session('profile_updated'))
                            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                                {{ session('profile_updated') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*">
                            
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                Save Changes
                            </button>
                        </form>
                    </div>
                    
                    <!-- Change Password Form -->
                    <div id="change-password">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Change Password</h3>
                        
                        @if(session('password_updated'))
                            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                                {{ session('password_updated') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label for="current_password" class="block text-gray-700 font-medium mb-2">Current Password</label>
                                <input type="password" id="current_password" name="current_password" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('current_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 font-medium mb-2">New Password</label>
                                <input type="password" id="password" name="password" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                            
                            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle profile photo upload
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            // Create a preview of the uploaded image
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(event) {
                // Find the profile image or placeholder
                const profileImage = document.querySelector('.relative.group.mb-4 img');
                const profilePlaceholder = document.querySelector('.relative.group.mb-4 div.rounded-full');
                
                if (profileImage) {
                    // Update existing image
                    profileImage.src = event.target.result;
                } else if (profilePlaceholder) {
                    // Replace placeholder with image
                    const newImg = document.createElement('img');
                    newImg.src = event.target.result;
                    newImg.alt = "{{ Auth::user()->name }}";
                    newImg.className = "w-32 h-32 rounded-full object-cover border-4 border-white shadow-md";
                    
                    profilePlaceholder.parentNode.replaceChild(newImg, profilePlaceholder);
                }
                
                // Show visual feedback
                const photoLabel = document.querySelector('label[for="profile_photo"]');
                if (photoLabel) {
                    photoLabel.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        photoLabel.innerHTML = '<i class="fas fa-camera"></i>';
                    }, 2000);
                }
            };
            
            reader.readAsDataURL(file);
            
            // Add a notification that the photo will be saved when the form is submitted
            const formElement = document.querySelector('#profile-info form');
            const notification = document.createElement('div');
            notification.className = 'mt-4 p-3 bg-blue-100 text-blue-700 rounded-lg';
            notification.innerHTML = '<i class="fas fa-info-circle mr-2"></i> Photo selected. Click "Save Changes" to update your profile picture.';
            
            // Remove any existing notification
            const existingNotification = formElement.querySelector('.bg-blue-100');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            formElement.appendChild(notification);
        }
    });
</script>
@endsection