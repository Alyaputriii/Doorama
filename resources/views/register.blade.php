<!DOCTYPE html>
<html>
<head>
    <title>Register - Dooroma</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-20 
bg-gradient-to-br from-stone-800 to-stone-600 gap-10">

    <!-- LEFT SIDE -->
    <div class="text-stone-100 max-w-lg text-center lg:text-left">
        <h1 class="text-2xl font-bold mb-6 tracking-widest text-stone-200">DOOROMA</h1>

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

        <form method="POST" action="/register">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Nama</label>
                <input type="text" name="nama" required
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your name">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Email</label>
                <input type="email" name="email" required
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

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Confirm your password">
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
                    Sign in
                </a>
            </p>
        </form>
    </div>

</body>
</html>