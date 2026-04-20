<!DOCTYPE html>
<html>
<head>
    <title>Status - Doorama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-4 md:p-6">

<nav class="max-w-6xl mx-auto mb-6 flex flex-col md:flex-row md:justify-between md:items-center bg-white/10 backdrop-blur-md px-4 md:px-6 py-3 rounded-2xl shadow gap-3">

    <div class="text-stone-100 font-bold tracking-widest text-lg text-center md:text-left">
        DOORAMA
    </div>

    <div class="flex flex-wrap justify-center md:justify-end items-center gap-4 md:gap-6 text-xs md:text-sm font-semibold text-stone-200">
        <a href="{{ route('dashboard') }}" class="hover:text-white transition">
            Dashboard
        </a>

        <a href="{{ route('status') }}" class="text-white border-b-2 border-white pb-1">
            Status
        </a>

        <a href="{{ route('settings') }}" class="hover:text-white transition">
            Settings
        </a>

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

<div class="max-w-6xl mx-auto">

    <div class="mb-8 md:mb-10 text-center md:text-left">
        <p class="text-stone-100 text-base md:text-xl font-bold tracking-wide">
            Door Status
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6 mb-6">
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">
            <h2 class="text-stone-700 text-sm md:text-base font-semibold mb-2">Total Events</h2>
            <p class="text-2xl font-bold text-stone-900">{{ $totalEvents }}</p>
            <p class="text-xs text-stone-500">{{ $latestDate }}</p>
        </div>

        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">
            <h2 class="text-stone-700 text-sm md:text-base font-semibold mb-2">Success</h2>
            <p class="text-2xl font-bold text-green-600">{{ $successCount }}</p>
            <p class="text-xs text-stone-500">
                {{ $totalEvents > 0 ? round(($successCount / $totalEvents) * 100) : 0 }}%
            </p>
        </div>

        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">
            <h2 class="text-stone-700 text-sm md:text-base font-semibold mb-2">Failed</h2>
            <p class="text-2xl font-bold text-red-600">{{ $failedCount }}</p>
            <p class="text-xs text-stone-500">
                {{ $totalEvents > 0 ? round(($failedCount / $totalEvents) * 100) : 0 }}%
            </p>
        </div>
    </div>

    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-stone-700 text-base md:text-lg font-semibold">
                Door Status
            </h2>

            <div class="flex gap-2 text-xs">
                <a href="{{ route('status') }}"
                   class="px-3 py-1 rounded-lg transition {{ $activeFilter === 'all' ? 'bg-stone-600 text-white' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                    All
                </a>

                <a href="{{ route('status', ['filter' => 'success']) }}"
                   class="px-3 py-1 rounded-lg transition {{ $activeFilter === 'success' ? 'bg-stone-600 text-white' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                    Success
                </a>

                <a href="{{ route('status', ['filter' => 'failed']) }}"
                   class="px-3 py-1 rounded-lg transition {{ $activeFilter === 'failed' ? 'bg-stone-600 text-white' : 'bg-stone-100 text-stone-700 hover:bg-stone-200' }}">
                    Failed
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-stone-100 text-stone-600">
                    <tr>
                        <th class="text-left px-3 py-2">Event</th>
                        <th class="text-left px-3 py-2">Door State</th>
                        <th class="text-left px-3 py-2">Lock State</th>
                        <th class="text-left px-3 py-2">Status</th>
                        <th class="text-left px-3 py-2">Date &amp; Time</th>
                    </tr>
                </thead>

                <tbody class="text-stone-700">
                    @forelse ($logs as $log)
                        <tr class="border-b last:border-b-0">
                            <td class="px-3 py-3 font-medium text-stone-800">
                                {{ $log['event'] }}
                            </td>

                            <td class="px-3 py-3">
                                @php $doorState = strtolower($log['door_state']); @endphp

                                @if ($doorState === 'opened' || $doorState === 'open')
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-cyan-100 text-cyan-700">
                                        {{ $log['door_state'] }}
                                    </span>
                                @elseif ($doorState === 'closed')
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-stone-300 text-stone-700">
                                        {{ $log['door_state'] }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-stone-200 text-stone-700">
                                        {{ $log['door_state'] }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-3 py-3">
                                @php $lockState = strtolower($log['lock_state']); @endphp

                                @if ($lockState === 'locked')
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-violet-100 text-violet-700">
                                        {{ $log['lock_state'] }}
                                    </span>
                                @elseif ($lockState === 'unlocked')
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                        {{ $log['lock_state'] }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-stone-200 text-stone-700">
                                        {{ $log['lock_state'] }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-3 py-3">
                                @php $status = strtolower($log['status']); @endphp

                                @if ($status === 'success')
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-600">
                                        Success
                                    </span>
                                @elseif ($status === 'failed')
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                        Failed
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-stone-200 text-stone-700">
                                        {{ $log['status'] }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-3 py-3">
                                <div class="font-medium text-stone-700">
                                    {{ $log['date'] }}
                                </div>
                                <div class="text-xs text-stone-500">
                                    {{ $log['time'] }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-stone-500">
                                Belum ada data access log.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

</body>
</html>