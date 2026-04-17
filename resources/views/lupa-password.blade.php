<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Dooroma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center px-6 
bg-gradient-to-br from-stone-800 to-stone-600">

    <!-- CARD (SAMA PERSIS KAYAK LOGIN) -->
    <div class="bg-stone-100 p-6 lg:p-8 rounded-2xl shadow-2xl w-full max-w-sm border border-stone-200">

        <h2 class="text-2xl font-bold mb-6 text-stone-800 text-center">
           Lupa Password
        </h2>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded-lg text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="/forgot-password">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Email</label>
                <input type="email" name="email" required
                    class="w-full mt-1 border border-stone-300 p-2 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Enter your email">
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-stone-700 text-white p-2 rounded-lg font-semibold 
                hover:bg-stone-800 transition shadow-md">
                Send Reset Link
            </button>

            <!-- BACK -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" 
                   class="text-sm text-stone-600 hover:underline">
                    Back to Login
                </a>
            </div>

        </form>

    </div>

</body>
</html>