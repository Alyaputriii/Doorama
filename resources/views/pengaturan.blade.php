<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan - Dooroma</title>
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

        <a href="/dashboard-dev" class="hover:text-white transition">Dashboard</a>

        <a href="/status" class="hover:text-white transition">Status</a>

        <a href="/pengaturan" class="text-white border-b-2 border-white pb-1">Pengaturan</a>

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
            General Settings
        </p>
    </div>

    <!-- SETTINGS CARD -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-5 md:p-6">

        <!-- NUMBER OF KNOCKS -->
        <div class="flex justify-between items-center border-b py-3">
            <span class="text-stone-600 text-sm md:text-base">
                Number of Knocks
            </span>
            <span class="text-stone-900 font-semibold">
                {{ $knocks }}
            </span>
        </div>

        <!-- DEVICE STATUS -->
        <div class="flex justify-between items-center py-3">
            <span class="text-stone-600 text-sm md:text-base">
                Device Status
            </span>

            <span class="px-3 py-1 text-xs rounded-full 
                {{ $status == 'Online' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ $status }}
            </span>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-between items-center mt-6">

            <a href="{{ route('pengaturan.edit') }}" 
   class="px-4 py-2 rounded-xl bg-stone-700 text-white text-sm hover:bg-stone-800 transition">
    Edit
</a>

            <!-- RESET BUTTON -->
            <form action="/reset-setting" method="POST">
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