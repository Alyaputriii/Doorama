<!DOCTYPE html>
<html>
<head>
    <title>Door Settings - Dooroma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-4 md:p-6">

<!-- NAVBAR -->
<nav class="max-w-6xl mx-auto mb-6 flex flex-col md:flex-row md:justify-between md:items-center bg-white/10 backdrop-blur-md px-4 md:px-6 py-3 rounded-2xl shadow gap-3">

    <div class="text-stone-100 font-bold tracking-widest text-lg">
        DOOROMA
    </div>

    <div class="flex gap-4 text-sm text-stone-200">
        <a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a>
        <a href="{{ route('status') }}" class="hover:text-white">Status</a>
        <a href="{{ route('pengaturan') }}" class="text-white border-b-2 border-white pb-1">Pengaturan</a>
    </div>

</nav>

<div class="max-w-4xl mx-auto">

    <!-- CARD -->
    <div class="bg-white/90 backdrop-blur rounded-2xl shadow-lg p-6 md:p-8">

        <!-- TITLE -->
        <h2 class="text-xl md:text-2xl font-bold text-stone-800 mb-2">
            Knock Pattern Settings
        </h2>

        <p class="text-sm text-stone-500 mb-6">
            Configure your door unlock pattern using knock sequences. Adjust the number, timing, and sensitivity
        </p>

        <!-- WAVEFORM -->
        <div class="w-full h-32 bg-black rounded-lg flex items-center justify-center overflow-hidden mb-6 px-2">

            <div class="flex items-center gap-[2px]">

                <!-- kecil -->
                <div class="w-[2px] h-2 bg-white/40"></div>
                <div class="w-[2px] h-3 bg-white/50"></div>
                <div class="w-[2px] h-4 bg-white/60"></div>
                <div class="w-[2px] h-5 bg-white/70"></div>

                <!-- naik -->
                <div class="w-[2px] h-8 bg-white"></div>
                <div class="w-[2px] h-12 bg-white"></div>
                <div class="w-[2px] h-16 bg-white"></div>
                <div class="w-[2px] h-20 bg-white"></div>

                <!-- turun -->
                <div class="w-[2px] h-16 bg-white"></div>
                <div class="w-[2px] h-12 bg-white"></div>
                <div class="w-[2px] h-8 bg-white"></div>

                <!-- kecil -->
                <div class="w-[2px] h-4 bg-white/60"></div>
                <div class="w-[2px] h-3 bg-white/50"></div>

                <!-- gelombang besar -->
                <div class="w-[2px] h-10 bg-white"></div>
                <div class="w-[2px] h-16 bg-white"></div>
                <div class="w-[2px] h-24 bg-white"></div>
                <div class="w-[2px] h-28 bg-white"></div>

                <div class="w-[2px] h-24 bg-white"></div>
                <div class="w-[2px] h-16 bg-white"></div>
                <div class="w-[2px] h-10 bg-white"></div>

                <!-- akhir -->
                <div class="w-[2px] h-5 bg-white/70"></div>
                <div class="w-[2px] h-3 bg-white/50"></div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="flex gap-3">

            <button onclick="startRecording()" 
                class="px-4 py-2 rounded-xl bg-green-500 text-white text-sm hover:bg-green-600 transition">
                Start
            </button>

            <button onclick="addKnock()" 
                class="px-4 py-2 rounded-xl bg-blue-500 text-white text-sm hover:bg-blue-600 transition">
                Knock
            </button>

            <button onclick="stopRecording()" 
                class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600 transition">
                Stop
            </button>

        </div>

        <!-- STATUS -->
        <p id="statusText" class="text-sm text-stone-600 mt-4">
            Status: Idle
        </p>

        <!-- RESULT -->
        <p id="patternResult" class="text-sm text-stone-800 mt-2 font-semibold">
            Pattern: -
        </p>

    </div>

</div>

<!-- SCRIPT -->
<script>
    let pattern = [];
    let recording = false;

    function startRecording() {
        pattern = [];
        recording = true;
        document.getElementById('statusText').innerText = "Status: Recording...";
        document.getElementById('patternResult').innerText = "Pattern: -";
    }

    function addKnock() {
        if (!recording) return;
        pattern.push("•");
        document.getElementById('patternResult').innerText = "Pattern: " + pattern.join(" ");
    }

    function stopRecording() {
        recording = false;
        document.getElementById('statusText').innerText = "Status: Stopped";

        // Delay biar user lihat hasil dulu
        setTimeout(() => {
            alert("Pattern berhasil disimpan!");
            window.location.href = "{{ route('pengaturan') }}";
        }, 1000);
    }
</script>

</body>
</html>