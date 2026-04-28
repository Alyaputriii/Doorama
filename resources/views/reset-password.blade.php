<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Doorama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center px-6 bg-gradient-to-br from-stone-800 to-stone-600">

<div class="bg-stone-100 p-6 lg:p-8 rounded-2xl shadow-2xl w-full max-w-sm border border-stone-200">

    <h2 class="text-2xl font-bold mb-6 text-stone-800 text-center">
        Reset Password
    </h2>

    <form method="POST" action="/reset-password" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <!-- NEW PASSWORD -->
        <div class="mb-4">
            <label class="text-stone-700 text-sm">New Password</label>

            <div class="relative">
                <input type="password" name="password" id="password" required
                    class="w-full mt-1 border p-2 pr-10 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition
                    @error('password') border-red-500 @enderror"
                    placeholder="Enter new password">

                <button type="button" onclick="togglePassword('password', 'eyeOpen1', 'eyeClose1')" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-500">
                    <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg id="eyeClose1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.943-9.543-7a9.956 9.956 0 012.042-3.362M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.27 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v.01M3 3l18 18" />
                    </svg>
                </button>
            </div>

            <!-- Strength Bar -->
            <div class="mt-2">
                <div class="w-full bg-stone-300 h-2 rounded-full">
                    <div id="strengthBar" class="h-2 rounded-full w-0 transition-all"></div>
                </div>
                <p id="strengthText" class="text-xs mt-1 text-stone-500"></p>
            </div>

            <p class="text-xs text-stone-500 mt-1">
                Must be at least 8 characters and include uppercase, number, and symbol.
            </p>

            @error('password')
                @if ($message !== 'Passwords do not match.')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @endif
            @enderror
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="mb-4">
            <label class="text-stone-700 text-sm">Confirm Password</label>

            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full mt-1 border p-2 pr-10 rounded-lg bg-white text-stone-800 
                    focus:outline-none focus:ring-2 focus:ring-stone-600 transition"
                    placeholder="Confirm password">
                <button type="button" onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClose2')" 
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-500">

                    <!-- Eye Open -->
                    <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Eye Closed -->
                    <svg id="eyeClose2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.943-9.543-7a9.956 9.956 0 012.042-3.362M6.223 6.223A9.953 9.953 0 0112 5c4.478 0 8.27 2.943 9.543 7a9.97 9.97 0 01-4.132 5.411M15 12a3 3 0 00-3-3m0 0a3 3 0 00-3 3m3-3v.01M3 3l18 18" />
                    </svg>
                </button>
            </div>

            @error('password')
                @if ($message === 'Passwords do not match.')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @endif
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-stone-700 text-white p-2 rounded-lg font-semibold hover:bg-stone-800 transition shadow-md">
            Reset Password
        </button>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-stone-600 hover:underline">
                Back to Login
            </a>
        </div>
    </form>
</div>

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

const passwordInput = document.getElementById('password');
const confirmInput = document.getElementById('password_confirmation');
const strengthBar = document.getElementById('strengthBar');
const strengthText = document.getElementById('strengthText');
const confirmError = document.getElementById('confirmError');

passwordInput.addEventListener('input', () => {
    const password = passwordInput.value;
    let strength = 0;

    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    strengthBar.className = "h-2 rounded-full transition-all";

    if (password.length === 0) {
        strengthBar.style.width = "0";
        strengthText.textContent = "";
    } else if (strength <= 1) {
        strengthBar.style.width = "25%";
        strengthBar.classList.add("bg-red-500");
        strengthText.textContent = "Weak password";
    } else if (strength <= 3) {
        strengthBar.style.width = "60%";
        strengthBar.classList.add("bg-yellow-500");
        strengthText.textContent = "Medium strength";
    } else {
        strengthBar.style.width = "100%";
        strengthBar.classList.add("bg-green-500");
        strengthText.textContent = "Strong password";
    }

    checkPasswordMatch();
});

confirmInput.addEventListener('input', checkPasswordMatch);

function checkPasswordMatch() {
    const password = passwordInput.value;
    const confirm = confirmInput.value;

    if (confirm.length === 0) {
        confirmError.classList.add('hidden');
        confirmInput.classList.remove('border-red-500');
        return;
    }

    if (password !== confirm) {
        confirmError.classList.remove('hidden');
        confirmInput.classList.add('border-red-500');
    } else {
        confirmError.classList.add('hidden');
        confirmInput.classList.remove('border-red-500');
    }
}
</script>

</body>
</html>