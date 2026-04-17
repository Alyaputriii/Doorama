<!DOCTYPE html>
<html>
<head>
    <title>Status - Dooroma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-4 md:p-6">

<!-- NAVBAR -->
<nav class="max-w-6xl mx-auto mb-6 flex flex-col md:flex-row md:justify-between md:items-center bg-white/10 backdrop-blur-md px-4 md:px-6 py-3 rounded-2xl shadow gap-3">

    <div class="text-stone-100 font-bold tracking-widest text-lg text-center md:text-left">
        DOOROMA
    </div>

    <div class="flex flex-wrap justify-center md:justify-end items-center gap-4 md:gap-6 text-xs md:text-sm font-semibold text-stone-200">

        <a href="{{ route('dashboard') }}" class="hover:text-white transition">
            Dashboard
        </a>

        <a href="{{ route('status') }}" class="text-white border-b-2 border-white pb-1">
            Status
        </a>

        <a href="{{ route('pengaturan') }}" class="hover:text-white transition">
            Pengaturan
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:text-red-400 transition">
                Logout
            </button>
        </form>

    </div>
</nav>
<div class="max-w-6xl mx-auto">

    <!-- TITLE -->
    <div class="mb-8 md:mb-10 text-center md:text-left">
        <p class="text-stone-100 text-base md:text-xl font-bold tracking-wide">
            Status Pintu
        </p>
    </div>

    <!-- METRIC -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 mb-6">

        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">
            <h2 class="text-stone-700 text-sm md:text-base font-semibold mb-2">Total Events</h2>
            <p class="text-2xl font-bold text-stone-900">5</p>
            <p class="text-xs text-stone-500">2026-04-01</p>
        </div>

        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">
            <h2 class="text-stone-700 text-sm md:text-base font-semibold mb-2">Success</h2>
            <p class="text-2xl font-bold text-green-600">2</p>
            <p class="text-xs text-stone-500">40%</p>
        </div>

        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">
            <h2 class="text-stone-700 text-sm md:text-base font-semibold mb-2">Failed</h2>
            <p class="text-2xl font-bold text-red-600">2</p>
            <p class="text-xs text-stone-500">40%</p>
        </div>

    </div>

    <!-- DOOR STATUS TABLE -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">

        <!-- HEADER + FILTER -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-stone-700 text-base md:text-lg font-semibold">
                Door Status
            </h2>

            <div class="flex gap-2 text-xs">
               <button class="px-3 py-1 rounded-lg bg-stone-600 text-white">All</button>
                <button class="px-3 py-1 rounded-lg bg-stone-200 text-stone-700">Success</button>
                <button class="px-3 py-1 rounded-lg bg-stone-200 text-stone-700">Failed</button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-stone-100 text-stone-600">
                    <tr>
                        <th class="text-left px-3 py-2">Event</th>
                        <th class="text-left px-3 py-2">Status</th>
                        <th class="text-left px-3 py-2">Date</th>
                        <th class="text-left px-3 py-2">Time</th>
                    </tr>
                </thead>

                <tbody class="text-stone-700">

                    <tr class="border-b">
                        <td class="px-3 py-3">Door Unlocked (Knock Pattern)</td>
                        <td><span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">Success</span></td>
                        <td>2026-04-01</td>
                        <td>08:45:12</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-3 py-3">Door Locked</td>
                        <td><span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-600">Closed</span></td>
                        <td>2026-04-01</td>
                        <td>08:46:03</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-3 py-3">Wrong Knock Pattern</td>
                        <td><span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600">Failed</span></td>
                        <td>2026-04-01</td>
                        <td>09:10:27</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-3 py-3">Door Opened</td>
                        <td><span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">Opened</span></td>
                        <td>2026-04-01</td>
                        <td>12:01:44</td>
                    </tr>

                    <tr>
                        <td class="px-3 py-3">Unauthorized Attempt</td>
                        <td><span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600">Failed</span></td>
                        <td>2026-04-01</td>
                        <td>13:22:10</td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>

</div>

</body>
</html>