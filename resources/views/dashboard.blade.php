<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Dooroma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-6">

<div class="max-w-6xl mx-auto">

<!-- HEADER -->
<div class="flex justify-between items-start mb-10">

    <div class="space-y-2">
        <h1 class="text-stone-100 text-3xl font-bold tracking-widest">
            Dashboard
        </h1>

        <p class="text-stone-100 text-xl font-bold tracking-wide">
            Hai, {{ Auth::user()->nama }} 👋
        </p>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-2">
    @csrf
        <button type="submit" class="inline-block px-3 py-1 text-sm rounded-lg bg-amber-800 text-stone-100 hover:bg-amber-700 transition">
            Logout
        </button>
    </form>

</div>
    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- CARD 1 -->
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
            <div>
                <h2 class="text-stone-700 font-semibold mb-3">Door Status</h2>
                <span class="inline-block px-3 py-1 text-sm rounded-full font-semibold
                    {{ $doorStatus === 'locked' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">{{ ucfirst($doorStatus) }}
                </span>
            </div>
            <p class="text-stone-500 text-sm mt-6">Last activity: 12:01</p>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
            <h2 class="text-stone-700 font-semibold mb-4">Quick Control</h2>

            <div class="space-y-3">
                <button class="w-full bg-stone-800 text-white py-2 rounded-lg hover:bg-stone-900 transition">
                    Unlock Door
                </button>

                <button class="w-full bg-stone-200 text-stone-800 py-2 rounded-lg hover:bg-stone-300 transition">
                    Lock Door
                </button>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
            <div>
                <h2 class="text-stone-700 font-semibold mb-3">Security</h2>
                <p class="text-stone-600 text-sm">
                    Failed Attempts (24h): <b class="text-stone-900">{{ $failedAttempts }}</b>
                </p>
            </div>
            <p class="text-stone-500 text-sm mt-6">Last Failed: 13:22</p>
        </div>

        <!-- CARD 4 -->
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 flex flex-col justify-between hover:-translate-y-1 transition duration-300">
            <div>
                <h2 class="text-stone-700 font-semibold mb-3">System</h2>
                <p class="text-stone-600 text-sm">
                    Status:
                    <span class="text-green-600 font-semibold">Online</span>
                </p>
            </div>
            <p class="text-stone-600 text-sm mt-6">Battery: 92%</p>
        </div>

        <!-- RECENT ACTIVITY -->
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 lg:col-span-2 sm:col-span-2 col-span-1 hover:-translate-y-1 transition duration-300">

            <h2 class="text-stone-700 text-lg font-semibold mb-4">
                Recent Activity
            </h2>

            <div class="space-y-3 text-sm text-stone-700">

            <div class="space-y-3 text-sm text-stone-700">
                @forelse ($recentActivities as $activity)
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

                <!-- <div class="flex justify-between border-b pb-2">
                    <span>Door Unlocked</span>
                    <span class="text-stone-400">12:01</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Wrong Knock</span>
                    <span class="text-stone-400">11:20</span>
                </div>

                <div class="flex justify-between">
                    <span>Door Locked</span>
                    <span class="text-stone-400">11:05</span>
                </div> -->

            </div>

        </div>

    </div>

</div>

</body>
</html>