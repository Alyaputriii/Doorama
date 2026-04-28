<!DOCTYPE html>
<html>
<head>
    <title>Register - Doorama</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-20 
bg-gradient-to-br from-stone-800 to-stone-600 gap-10">

    <!-- LEFT SIDE -->
    <div class="text-stone-100 max-w-lg text-center lg:text-left">
        <h1 class="text-2xl font-bold mb-6 tracking-widest text-stone-200">DOORAMA</h1>

        <h2 class="text-3xl lg:text-5xl font-bold mb-4 leading-tight">
            Create Your Account
        </h2>

        <p class="text-stone-300 text-sm lg:text-base leading-relaxed">
            Join SmartLock and take full control of your home security with a reliable and easy-to-use system.
        </p>
    </div>

    <!-- RIGHT SIDE REGISTER -->
    <div class="bg-stone-100 p-6 lg:p-8 rounded-2xl shadow-2xl w-full max-w-sm border border-stone-200">

        <h2 class="text-2xl font-bold mb-6 text-stone-800 text-center">Sign Up</h2>

        <form method="POST" action="{{ route('register.post') }}" novalidate>            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Name</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your name">
                @error('nama')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your email">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full mt-1 border border-stone-300 p-2 pr-10 rounded-lg bg-white text-stone-800 
                        focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                        placeholder="Enter your password">
                    <button type="button" onclick="togglePw('password', 'eye-password')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400">
                        <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                <!-- Strength bar -->
                    <div class="mt-2">
                        <div class="w-full bg-stone-300 h-2 rounded-full">
                            <div id="strengthBar" class="h-2 rounded-full w-0 transition-all"></div>
                        </div>
                        <p id="strengthText" class="text-xs mt-1 text-stone-500"></p>
                    </div>

                    <!-- Hint -->
                    <p class="text-xs text-stone-500 mt-1">
                        Must be at least 8 characters and include uppercase, number, and symbol.
                    </p>
                    @error('password')
                        @if ($message !== 'Passwords do not match.')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @endif
                    @enderror
                </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full mt-1 border border-stone-300 p-2 pr-10 rounded-lg bg-white text-stone-800 
                        focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                        placeholder="Confirm your password">
                    <button type="button" onclick="togglePw('password_confirmation', 'eye-confirm')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400">
                        <svg id="eye-confirm" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    @if ($message === 'Passwords do not match.')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @endif
                @enderror
            </div>

            <!-- Button -->
            <button class="w-full bg-stone-700 text-white p-2 rounded-lg font-semibold 
            hover:bg-stone-800 transition shadow-md">
                Sign Up
            </button>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="flex-1 h-px bg-stone-300"></div>
                <span class="px-3 text-sm text-stone-500">or</span>
                <div class="flex-1 h-px bg-stone-300"></div>
            </div>

            <!-- Login -->
            <p class="text-center text-sm text-stone-600">
                Already have an account?
                <a href="/login" class="text-stone-800 font-semibold hover:underline">
                Sign In
                </a>
            </p>
        </form>
    </div>

    <script>
        const eyeOpen = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        const eyeOff  = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;

        function togglePw(inputId, svgId) {
            const input = document.getElementById(inputId);
            const svg   = document.getElementById(svgId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            svg.innerHTML = isHidden ? eyeOff : eyeOpen;
        }
    </script>
    
    <script>
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', () => {
            const password = passwordInput.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            // reset
            strengthBar.className = "h-2 rounded-full transition-all";

            if (strength <= 1) {
                strengthBar.style.width = "25%";
                strengthBar.classList.add("bg-red-500");
                strengthText.textContent = "Weak password";
            } 
            else if (strength <= 3) {
                strengthBar.style.width = "60%";
                strengthBar.classList.add("bg-yellow-500");
                strengthText.textContent = "Medium strength";
            } 
            else {
                strengthBar.style.width = "100%";
                strengthBar.classList.add("bg-green-500");
                strengthText.textContent = "Strong password";
            }
        });
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;

        if (confirm.length === 0) {
            confirmInput.classList.remove('border-red-500');
            return;
        }

        if (password !== confirm) {
            confirmInput.classList.add('border-red-500');
        } else {
            confirmInput.classList.remove('border-red-500');
        }
    }

    passwordInput.addEventListener('input', checkPasswordMatch);
    confirmInput.addEventListener('input', checkPasswordMatch);
    </script>
        
</body>
</html>