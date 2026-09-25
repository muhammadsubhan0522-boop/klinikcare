<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - KlinikCare Medical Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%);
        }
        .floating {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: float 8s ease-in-out infinite;
        }
        .floating:nth-child(2) { animation-delay: 2s; }
        .floating:nth-child(3) { animation-delay: 4s; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }
        .input-focus:focus {
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
            border-color: #0ea5e9;
        }
    </style>
</head>
<body class="bg-slate-50">

<div class="min-h-screen flex">
    <!-- Left Side - Branding -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
        <!-- Floating Shapes -->
        <div class="floating w-96 h-96 -top-20 -left-20"></div>
        <div class="floating w-72 h-72 bottom-20 right-20"></div>
        <div class="floating w-64 h-64 top-1/2 left-1/2"></div>
        
        <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
            <!-- Logo -->
            <div class="mb-8">
                <div class="w-28 h-28 bg-white rounded-3xl flex items-center justify-center shadow-2xl">
                    <i class="fas fa-heartbeat text-5xl text-sky-500"></i>
                </div>
            </div>
            
            <h1 class="text-6xl font-extrabold mb-3 tracking-tight">KlinikCare</h1>
            <p class="text-xl text-sky-100 mb-8 font-medium">Medical Center</p>
            
            <div class="max-w-md text-center space-y-6">
                <p class="text-lg text-sky-50 leading-relaxed">
                    Sistem Manajemen Pelayanan Kesehatan Terpadu untuk pengelolaan antrean pasien yang lebih efisien dan profesional.
                </p>
                
                <!-- Features -->
                <div class="grid grid-cols-3 gap-5 mt-10">
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 mx-auto">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <p class="text-sm font-bold">Cepat</p>
                    </div>
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 mx-auto">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <p class="text-sm font-bold">Aman</p>
                    </div>
                    <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-3 mx-auto">
                            <i class="fas fa-bolt text-2xl"></i>
                        </div>
                        <p class="text-sm font-bold">Efisien</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden flex items-center space-x-3 mb-8">
                <div class="w-14 h-14 gradient-bg rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-heartbeat text-2xl text-white"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-900">KlinikCare</h3>
                    <p class="text-sm text-slate-500">Medical Center</p>
                </div>
            </div>

            <!-- Welcome Text -->
            <div class="mb-8">
                <h2 class="text-4xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h2>
                <p class="text-slate-600 text-lg">Silakan masuk ke panel administrator</p>
            </div>

            <!-- Error Message -->
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-700 text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="text-red-700 text-sm font-medium">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fas fa-envelope text-sky-500 mr-2"></i>Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-slate-400"></i>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               class="input-focus block w-full pl-11 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none transition-all"
                               placeholder="admin@klinikcare.com">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        <i class="fas fa-lock text-sky-500 mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-key text-slate-400"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="input-focus block w-full pl-11 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none transition-all"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="remember" 
                           name="remember"
                           class="h-4 w-4 text-sky-600 focus:ring-sky-500 border-slate-300 rounded cursor-pointer">
                    <label for="remember" class="ml-2 block text-sm text-slate-600 cursor-pointer">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold rounded-2xl shadow-lg shadow-sky-500/30 transition-all text-sm">
                    Login
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-slate-200">
                <p class="text-center text-sm text-slate-500">
                    <i class="fas fa-shield-alt text-sky-500 mr-2"></i>
                    Protected by KlinikCare Security System
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>