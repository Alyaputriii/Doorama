<!DOCTYPE html>
<html>
<head>
    <title>Login - Dooroma</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-20 
bg-gradient-to-br from-stone-800 to-stone-600 gap-10">

    <!-- LEFT SIDE -->
    <div class="text-stone-100 max-w-lg text-center lg:text-left">
        <h1 class="text-2xl font-bold mb-6 tracking-widest text-stone-200">DOOROMA</h1>

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
                <input type="password" name="password" required
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your password">
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
                <span class="text-stone-800 font-semibold cursor-pointer hover:underline">
                    Sign up
                </span>
            </p>
        </form>
    </div>

</body>
</html>