<!DOCTYPE html>
<html>
<head>
    <title>Login - Doorama</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-20 
bg-gradient-to-br from-stone-800 to-stone-600 gap-10">

    <!-- LEFT SIDE -->
    <div class="text-stone-100 max-w-lg text-center lg:text-left">
        <h1 class="text-2xl font-bold mb-6 tracking-widest text-stone-200">DOORAMA</h1>

        <h2 class="text-3xl lg:text-5xl font-bold mb-4 leading-tight">
            Secure Your Home With Confidence
        </h2>

        <p class="text-stone-300 text-sm lg:text-base leading-relaxed">
            SmartLock provides a seamless and secure way to manage access to your home. Monitor, control and protect your doors anytime anywhere with a system designed for reliability and ease of use.
        </p>
    </div>

    <!-- RIGHT SIDE LOGIN -->
    <div class="bg-stone-100 p-6 lg:p-8 rounded-2xl shadow-2xl w-full max-w-sm border border-stone-200">

        <h2 class="text-2xl font-bold mb-6 text-stone-800 text-center">Welcome Back</h2>

        @if ($errors->any())
    <div class="mb-4 p-2 bg-red-100 text-red-700 rounded-lg text-sm">
        {{ $errors->first() }}
    </div>
    @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Email</label>
                <input type="email" name="email" required
                    value="{{ old('email') }}"
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Password</label>

                <div class="relative">
                <input type="password" name="password" id="password" required
                    class="w-full mt-1 border border-stone-300 p-2 pr-10 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your password">
                <button type="button" onclick="togglePassword()" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-500">
                
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Mata tertutup -->
                    <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.943-9.543-7a9.956 9.956 0 012.042-3.362M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.27 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v.01M3 3l18 18" />
                    </svg> 
                </button>
            </div>

            <!-- Forgot -->
            <div class="flex justify-end mb-4">
                <p class="text-sm text-stone-500 cursor-pointer hover:text-stone-700 transition">
                    Forgot password?
                </p>
            </div>

            <!-- Button -->
            <button class="w-full bg-stone-700 text-white p-2 rounded-lg font-semibold 
            hover:bg-stone-800 transition shadow-md">
                Sign In
            </button>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <div class="flex-1 h-px bg-stone-300"></div>
                <span class="px-3 text-sm text-stone-500">or</span>
                <div class="flex-1 h-px bg-stone-300"></div>
            </div>

            <!-- Register -->
         <p class="text-center text-sm text-stone-600">
    Don’t have an account?
    <a href="/register" 
       class="text-stone-800 font-semibold hover:underline ml-1">
        Sign up
    </a>
</p>
        </form>
    </div>

    <script>
    function togglePassword() {
        const password = document.getElementById("password");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClose = document.getElementById("eyeClose");

        if (password.type === "password") {
            password.type = "text";
            eyeOpen.classList.add("hidden");
            eyeClose.classList.remove("hidden");
        } else {
            password.type = "password";
            eyeOpen.classList.remove("hidden");
            eyeClose.classList.add("hidden");
        }
    }
    </script>

</body>
</html>