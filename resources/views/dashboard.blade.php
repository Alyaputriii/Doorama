<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Dooroma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-4 md:p-6">

<!-- NAVBAR -->
<nav class="max-w-6xl mx-auto mb-6 flex flex-col md:flex-row md:justify-between md:items-center bg-white/10 backdrop-blur-md px-4 md:px-6 py-3 rounded-2xl shadow gap-3">

    <!-- LOGO -->
    <div class="text-stone-100 font-bold tracking-widest text-lg text-center md:text-left">
        DOORAMA
    </div>

    <!-- MENU -->
    <div class="flex flex-wrap justify-center md:justify-end items-center gap-4 md:gap-6 text-xs md:text-sm font-semibold text-stone-200">

        <a href="/dashboard-dev" class="text-white border-b-2 border-white pb-1">
            Dashboard
        </a>

        <a href="/status" class="hover:text-white transition">
            Status
        </a>

        <a href="/pengaturan" class="hover:text-white transition">Pengaturan</a>

        <!-- LOGOUT -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:text-red-400 transition">
                Logout
            </button>
        </form>

    </div>

</nav>

<div class="max-w-6xl mx-auto">

<!-- GREETING -->
<div class="mb-8 md:mb-10 text-center md:text-left">
    <p class="text-stone-100 text-base md:text-xl font-bold tracking-wide">
        Hai, {{ Auth::user()->nama ?? 'User' }} 👋
    </p>
</div>

<!-- GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">

    <!-- CARD 1 -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
        <div>
            <h2 class="text-stone-700 font-semibold mb-3 text-sm md:text-base">Door Status</h2>
            <span class="inline-block px-3 py-1 text-xs md:text-sm rounded-full font-semibold
                {{ $doorStatus === 'locked' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                {{ ucfirst($doorStatus ?? 'unknown') }}
            </span>
        </div>
        <p class="text-stone-500 text-xs md:text-sm mt-6">Last activity: 12:01</p>
    </div>

    <!-- CARD 2 -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
        <div>
            <h2 class="text-stone-700 font-semibold mb-3 text-sm md:text-base">Security</h2>
            <p class="text-stone-600 text-xs md:text-sm">
                Failed Attempts (24h): 
                <b class="text-stone-900">{{ $failedAttempts ?? 0 }}</b>
            </p>
        </div>
        <p class="text-stone-500 text-xs md:text-sm mt-6">Last Failed: 13:22</p>
    </div>

    <!-- CARD 3 -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
        <div>
            <h2 class="text-stone-700 font-semibold mb-3 text-sm md:text-base">System</h2>
            <p class="text-stone-600 text-xs md:text-sm">
                Status:
                <span class="text-green-600 font-semibold">Online</span>
            </p>
        </div>
        <p class="text-stone-600 text-xs md:text-sm mt-6">Battery: 92%</p>
    </div>

    <!-- RECENT ACTIVITY -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6 col-span-1 sm:col-span-2 lg:col-span-3 hover:-translate-y-1 transition duration-300">

        <h2 class="text-stone-700 text-base md:text-lg font-semibold mb-4">
            Recent Activity
        </h2>

        <div class="space-y-3 text-xs md:text-sm text-stone-700">

            @forelse ($recentActivities ?? [] as $activity)
                <div class="flex justify-between border-b pb-2">
                    <span>{{ $activity->description }}</span>
                    <span class="text-stone-400">
                        {{ \Carbon\Carbon::parse($activity->created_at)->format('H:i') }}
                    </span>
                </div>
            @empty
                <div class="flex justify-between">
                    <span>Tidak ada aktivitas</span>
                </div>
            @endforelse

        </div>

    </div>

</div>

</div>

</body>
</html>