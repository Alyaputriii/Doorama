<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Dooroma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center px-6 
bg-gradient-to-br from-stone-800 to-stone-600">

    <!-- CARD -->
    <div class="bg-stone-100 p-6 lg:p-8 rounded-2xl shadow-2xl w-full max-w-sm border border-stone-200">

        <h2 class="text-2xl font-bold mb-6 text-stone-800 text-center">
            Reset Password
        </h2>

        <!-- FORM -->
        <form method="POST" action="/reset-password">
            @csrf

            <!-- PASSWORD BARU -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Password Baru</label>

                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full mt-1 border border-stone-300 p-2 pr-10 rounded-lg bg-white text-stone-800 
                        focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                        placeholder="Enter new password">

                    <button type="button" onclick="togglePassword('password', 'eyeOpen1', 'eyeClose1')" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-500">

                        <!-- Mata terbuka -->
                        <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Mata tertutup -->
                        <svg id="eyeClose1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.943-9.543-7a9.956 9.956 0 012.042-3.362M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.27 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v.01M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- KONFIRMASI PASSWORD -->
            <div class="mb-4">
                <label class="text-stone-700 text-sm">Konfirmasi Password</label>

                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full mt-1 border border-stone-300 p-2 pr-10 rounded-lg bg-white text-stone-800 
                        focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                        placeholder="Confirm password">

                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClose2')" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-500">

                        <!-- Mata terbuka -->
                        <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Mata tertutup -->
                        <svg id="eyeClose2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.943-9.543-7a9.956 9.956 0 012.042-3.362M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.27 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v.01M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-stone-700 text-white p-2 rounded-lg font-semibold 
                hover:bg-stone-800 transition shadow-md">
                Reset Password
            </button>

            <!-- BACK -->
            <div class="text-center mt-4">
                <a href="{{ route('login') }}"
                    class="text-sm text-stone-600 hover:underline">
                    Kembali ke Login
                </a>
            </div>

        </form>
    </div>

    <!-- SCRIPT -->
    <script>
        function togglePassword(fieldId, eyeOpenId, eyeCloseId) {
            const input = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeClose = document.getElementById(eyeCloseId);

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClose.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClose.classList.add("hidden");
            }
        }
    </script>

</body>
</html>