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

        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout()">
            @csrf
            <button type="submit">Logout</button>
        </form>

        <script>
        function confirmLogout() {
            return confirm("Yakin ingin logout?");
        }
        </script>
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

            <form action="{{ route('settings.reset') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600 transition">
                    Reset to Default
                </button>
            </form>
        </div>

    </div>

</div>

</body>
</html>