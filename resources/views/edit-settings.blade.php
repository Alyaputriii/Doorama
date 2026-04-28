<!DOCTYPE html>
<html>
<head>
    <title>Edit Settings - Doorama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gradient-to-br from-stone-900 via-stone-800 to-stone-700 p-3 md:p-5">

<nav class="max-w-5xl mx-auto mb-5 flex flex-col md:flex-row md:justify-between md:items-center bg-white/10 backdrop-blur-md px-4 md:px-6 py-3 rounded-2xl shadow gap-3">
    <div class="text-stone-100 font-bold tracking-widest text-xl md:text-2xl">
        DOORAMA
    </div>

    <div class="flex gap-6 text-stone-200 text-sm md:text-base">
        <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
        <a href="{{ route('status') }}" class="hover:text-white transition">Status</a>
        <a href="{{ route('settings') }}" class="text-white border-b-2 border-white pb-1">Settings</a>
    </div>
</nav>

<div class="max-w-5xl mx-auto bg-white/95 rounded-2xl shadow-lg p-5 md:p-6">

    <h1 class="text-2xl md:text-3xl font-bold text-stone-800 mb-2">
        Knock Pattern Settings
    </h1>

    <p class="text-stone-500 text-sm md:text-base mb-5">
        Configure your door unlock pattern using knock sequences.
    </p>

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-xl bg-red-100 border border-red-200 text-red-700 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div id="waveBox" class="bg-black rounded-2xl h-32 md:h-36 flex items-center justify-center mb-5 overflow-hidden relative">
        <div id="waveBars" class="flex items-end gap-1 h-20"></div>
    </div>

    <div class="flex gap-3 mb-5 flex-wrap">
        <button id="startBtn" type="button"
            class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-xl text-sm md:text-base transition">
            Start
        </button>

        <button id="knockBtn" type="button"
            class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl text-sm md:text-base transition disabled:opacity-50 disabled:cursor-not-allowed"
            disabled>
            Knock
        </button>

        <button id="stopBtn" type="button"
            class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl text-sm md:text-base transition disabled:opacity-50 disabled:cursor-not-allowed"
            disabled>
            Stop
        </button>
    </div>

    <div class="text-stone-600 text-base md:text-lg mb-1">
        Status: <span id="statusText">Idle</span>
    </div>

    <div class="text-stone-800 text-base md:text-lg font-semibold mb-2">
        Pattern: <span id="patternText">-</span>
    </div>

    <div class="text-stone-600 text-sm md:text-base mb-1">
    Number of Knocks: <span id="knockCountText">{{ $knockCount ?? 0 }}</span>
    </div>

    <p class="text-xs text-red-500 mb-5">
        Minimum pattern is 3 knocks.
    </p>

    <form action="{{ route('settings.store') }}" method="POST" id="savePatternForm">
        @csrf

        <input type="hidden" name="intervals" id="intervalsInput" value="{{ old('intervals', !empty($intervals) ? implode(',', $intervals) : '') }}">
        <input type="hidden" name="knock_count" id="knockCountInput" value="{{ old('knock_count', $knockCount ?? 0) }}">

        <div class="flex justify-between items-center mt-3">
            <a href="{{ route('settings') }}"
               class="px-4 py-2 rounded-xl bg-stone-300 text-stone-800 text-sm hover:bg-stone-400 transition">
                Cancel
            </a>

            <button type="button"
                id="saveBtn"
                onclick="openSaveModal()"
                class="px-4 py-2 rounded-xl bg-stone-700 text-white text-sm hover:bg-stone-800 transition">
                Save Pattern
            </button>
        </div>
    </form>
</div>

<script>
    let recording = false;
    let knockTimes = [];
    let intervals = [];

    const startBtn = document.getElementById('startBtn');
    const knockBtn = document.getElementById('knockBtn');
    const stopBtn = document.getElementById('stopBtn');
    const saveBtn = document.getElementById('saveBtn');

    const statusText = document.getElementById('statusText');
    const patternText = document.getElementById('patternText');
    const knockCountText = document.getElementById('knockCountText');
    const intervalsInput = document.getElementById('intervalsInput');
    const knockCountInput = document.getElementById('knockCountInput');
    const waveBars = document.getElementById('waveBars');
    const savePatternForm = document.getElementById('savePatternForm');

    function updateSaveButtonState() {
        const knockCount = parseInt(knockCountInput.value) || 0;

        saveBtn.disabled = false;

        if (knockCount < 3) {
            saveBtn.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }

    function renderBars(values) {
        waveBars.innerHTML = '';

        if (!values.length) {
            const bar = document.createElement('div');
            bar.className = 'w-2 bg-white rounded-sm';
            bar.style.height = '24px';
            waveBars.appendChild(bar);
            return;
        }

        const max = Math.max(...values, 1);

        values.forEach(value => {
            const bar = document.createElement('div');
            const height = Math.max(18, Math.round((value / max) * 80));
            bar.className = 'w-2 bg-white rounded-sm';
            bar.style.height = `${height}px`;
            waveBars.appendChild(bar);
        });
    }

    function showPatternDots(count) {
        if (count <= 0) {
            patternText.textContent = '-';
            knockCountText.textContent = '0';
            knockCountInput.value = '0';
            updateSaveButtonState();
            return;
        }

        patternText.textContent = '● '.repeat(count).trim();
        knockCountText.textContent = count;
        knockCountInput.value = count;
        updateSaveButtonState();
    }

    function resetButtons() {
        knockBtn.disabled = true;
        stopBtn.disabled = true;
    }

    startBtn.addEventListener('click', () => {
        recording = true;
        knockTimes = [];
        intervals = [];

        statusText.textContent = 'Recording';
        patternText.textContent = '-';
        knockCountText.textContent = '0';

        knockCountInput.value = '0';
        intervalsInput.value = '';
        waveBars.innerHTML = '';

        knockBtn.disabled = false;
        stopBtn.disabled = false;

        updateSaveButtonState();
    });

    knockBtn.addEventListener('click', () => {
        if (!recording) return;

        const now = Date.now();

        if (knockTimes.length > 0) {
            const interval = now - knockTimes[knockTimes.length - 1];
            intervals.push(interval);
        }

        knockTimes.push(now);

        const knockCount = knockTimes.length;
        showPatternDots(knockCount);

        // intervals tetap disimpan untuk backend
        intervalsInput.value = intervals.length ? intervals.join(',') : '0';

        // visual ritme tetap tampil
        if (intervals.length) {
            renderBars(intervals);
        } else {
            renderBars([80]);
        }
    });

    stopBtn.addEventListener('click', () => {
        recording = false;
        statusText.textContent = 'Stopped';
        resetButtons();

        if (!knockTimes.length) {
            patternText.textContent = '-';
            knockCountText.textContent = '0';
            knockCountInput.value = '0';
            intervalsInput.value = '';
            waveBars.innerHTML = '';
            updateSaveButtonState();
            return;
        }

        if (!intervals.length && knockTimes.length > 0) {
            intervalsInput.value = '0';
            renderBars([40]);
        }
    });

    savePatternForm.addEventListener('submit', (e) => {
        const knockCount = parseInt(knockCountInput.value) || 0;

        if (knockCount < 3) {
            e.preventDefault();
            statusText.textContent = 'Failed';
            alert('Pattern tidak valid. Minimal harus terdiri dari 3 ketukan.');
        }
    });

    function openSaveModal() {
        const knockCount = parseInt(knockCountInput.value) || 0;

        if (knockCount < 3) {
            statusText.textContent = 'Failed';
            return;
        }

        const modal = document.getElementById('saveModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeSaveModal() {
        const modal = document.getElementById('saveModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function submitSaveForm() {
        savePatternForm.submit();
    }

    window.addEventListener('DOMContentLoaded', () => {
        const existingIntervals = intervalsInput.value.trim();
        const existingKnockCount = parseInt(knockCountInput.value) || 0;

        if (existingKnockCount > 0) {
            showPatternDots(existingKnockCount);

            if (existingIntervals === '0') {
                renderBars([40]);
            } else if (existingIntervals !== '') {
                renderBars(existingIntervals.split(',').map(Number));
            }

            statusText.textContent = 'Saved Pattern Loaded';
        } else {
            updateSaveButtonState();
        }
    });
</script>

    <!-- SAVE CONFIRMATION MODAL -->
    <div id="saveModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

        <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">

            <h3 class="text-lg font-bold text-stone-800 mb-2">
                Save Pattern?
            </h3>

            <p class="text-sm text-stone-600 mb-6">
                Are you sure you want to save this knock pattern?
            </p>

            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="closeSaveModal()"
                    class="px-4 py-2 rounded-xl bg-stone-200 text-stone-700 text-sm hover:bg-stone-300 transition">
                    Cancel
                </button>

                <button type="button"
                    onclick="submitSaveForm()"
                    class="px-4 py-2 rounded-xl bg-green-500 text-white text-sm hover:bg-green-600 transition">
                    Yes, Save
                </button>
            </div>

        </div>
    </div>
</body>
</html>