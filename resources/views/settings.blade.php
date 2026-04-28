<!DOCTYPE html>
<html>
<head>
    <title>Settings - Doorama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-4 md:p-6">

<nav class="max-w-5xl mx-auto mb-6 flex flex-col md:flex-row md:justify-between md:items-center bg-white/10 backdrop-blur-md px-4 md:px-6 py-3 rounded-2xl shadow gap-3">

    <div class="text-stone-100 font-bold tracking-widest text-lg text-center md:text-left">
        DOORAMA
    </div>

    <div class="flex flex-wrap justify-center md:justify-end items-center gap-4 md:gap-6 text-xs md:text-sm font-semibold text-stone-200">
        <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
        <a href="{{ route('status') }}" class="hover:text-white transition">Status</a>
        <a href="{{ route('settings') }}" class="text-white border-b-2 border-white pb-1">Settings</a>

       <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button"
                onclick="openLogoutModal()"
                class="hover:text-white transition">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="max-w-5xl mx-auto">

    <div class="mb-8 md:mb-10 text-center md:text-left">
        <p class="text-stone-100 text-base md:text-xl font-bold tracking-wide">
            General Settings
        </p>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-green-100 border border-green-200 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-xl bg-red-100 border border-red-200 text-red-700 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">

        <div class="flex justify-between items-center border-b py-3">
            <span class="text-stone-600 text-sm md:text-base">
                Number of Knocks
            </span>
            <span class="text-stone-900 font-semibold">
                {{ $knockCount ?? 0 }}
            </span>
        </div>

        <div class="flex justify-between items-center border-b py-3">
            <span class="text-stone-600 text-sm md:text-base">
                Current Pattern
            </span>
            <span class="text-stone-900 font-semibold text-sm md:text-base">
                {{ $patternDots ?? '-' }}
            </span>
        </div>

        <div class="flex justify-between items-center py-3">
            <span class="text-stone-600 text-sm md:text-base">
                Device Status
            </span>

            <span class="px-3 py-1 text-xs rounded-full {{ ($deviceStatus ?? 'Offline') === 'Online' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ $deviceStatus ?? 'Offline' }}
            </span>
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('settings.edit') }}"
               class="px-4 py-2 rounded-xl bg-stone-700 text-white text-sm hover:bg-stone-800 transition">
                Edit
            </a>

           <form id="resetForm" action="{{ route('settings.reset') }}" method="POST">
                @csrf
                <button type="button"
                    onclick="openResetModal()"
                    class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600 transition">
                    Reset to Default
                </button>
            </form>
        </div>

    </div>

</div>

    <!-- RESET CONFIRMATION MODAL -->
    <div id="resetModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
        <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">
            <h3 class="text-lg font-bold text-stone-800 mb-2">
                Reset Settings?
            </h3>

            <p class="text-sm text-stone-600 mb-6">
                Are you sure you want to reset all settings to default?
            </p>

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeResetModal()"
                        class="px-4 py-2 rounded-xl bg-stone-200 text-stone-700 text-sm hover:bg-stone-300 transition">
                    Cancel
                </button>

                <button type="button"
                        onclick="submitResetForm()"
                        class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600 transition">
                    Yes, Reset
                </button>
            </div>
        </div>
    </div>

    <script>
    function openResetModal() {
        const modal = document.getElementById('resetModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeResetModal() {
        const modal = document.getElementById('resetModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function submitResetForm() {
        document.getElementById('resetForm').submit();
    }
    </script>

<div id="logoutModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

    <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">

        <h3 class="text-lg font-bold text-stone-800 mb-2">
            Log Out?
        </h3>

        <p class="text-sm text-stone-600 mb-6">
            Are you sure you want to log out from your account?
        </p>

        <div class="flex justify-end gap-3">
            <button type="button"
                onclick="closeLogoutModal()"
                class="px-4 py-2 rounded-xl bg-stone-200 text-stone-700 text-sm hover:bg-stone-300 transition">
                Cancel
            </button>

            <button type="button"
                onclick="submitLogoutForm()"
                class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600 transition">
                Yes, Log Out
            </button>
        </div>

    </div>
</div>

<script>
function openLogoutModal() {
    const modal = document.getElementById('logoutModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeLogoutModal() {
    const modal = document.getElementById('logoutModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function submitLogoutForm() {
    document.getElementById('logoutForm').submit();
}
</script>

</body>
</html>