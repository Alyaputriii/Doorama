<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnockPattern;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $activePattern = KnockPattern::where('user_id', $user->user_id)
            ->where('is_active', 1)
            ->latest()
            ->first();

        $knockCount = 0;
        $patternDots = '-';

        if ($activePattern && !empty($activePattern->feature_data)) {
            $featureData = $activePattern->feature_data;

            $knockCount = $featureData['knock_count'] ?? 0;

            if ($knockCount > 0) {
                $patternDots = trim(str_repeat('● ', $knockCount));
            }
        }

        $deviceStatus = 'Online';

        return view('settings', compact(
            'activePattern',
            'knockCount',
            'patternDots',
            'deviceStatus'
        ));
    }

    public function edit()
    {
        $user = Auth::user();

        $activePattern = KnockPattern::where('user_id', $user->user_id)
            ->where('is_active', 1)
            ->latest()
            ->first();

        $knockCount = 0;
        $intervals = [];

        if ($activePattern && !empty($activePattern->feature_data)) {
            $featureData = $activePattern->feature_data;
            $knockCount = $featureData['knock_count'] ?? 0;
            $intervals = $featureData['intervals'] ?? [];
        }

        return view('edit-settings', compact(
            'activePattern',
            'knockCount',
            'intervals'
        ));
    }

   public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'intervals' => ['required', 'string'],
            'knock_count' => ['required', 'integer', 'min:3'],
        ], [
            'intervals.required' => 'Pattern wajib direkam terlebih dahulu.',
            'knock_count.required' => 'Jumlah ketukan wajib ada.',
            'knock_count.min' => 'Pattern minimal harus terdiri dari 3 ketukan.',
        ]);

        $intervalString = trim($request->intervals);
        $knockCount = (int) $request->knock_count;

        $intervals = [];

        if ($intervalString !== '0' && $intervalString !== '') {
            $intervals = array_map('intval', explode(',', $intervalString));
        }

        $featureData = [
            'intervals' => $intervals,
            'knock_count' => $knockCount,
        ];

        KnockPattern::where('user_id', $user->user_id)
            ->where('is_active', 1)
            ->update(['is_active' => 0]);

        KnockPattern::create([
            'user_id' => $user->user_id,
            'pattern_name' => 'Knock Pattern ' . now()->format('YmdHis'),
            'feature_data' => $featureData,
            'threshold' => 0.80,
            'is_active' => 1,
        ]);

        return redirect()
            ->route('settings')
            ->with('success', 'Pattern saved successfully.');
    }

    public function reset()
    {
        $user = Auth::user();

        KnockPattern::where('user_id', $user->user_id)
            ->where('is_active', 1)
            ->update(['is_active' => 0]);

        return redirect()
            ->route('settings')
            ->with('success', 'Pattern reset successfully.');
    }
}