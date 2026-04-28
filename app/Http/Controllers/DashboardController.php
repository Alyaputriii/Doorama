<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $latestLog = AccessLog::latest('created_at')->first();

        $doorStatus = $latestLog ? $latestLog->door_state : 'unknown';

        $failedAttempts = AccessLog::where('result', 'failed')
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        $recentActivities = AccessLog::latest('created_at')
            ->take(3)
            ->get();
        
        $lastFailed = AccessLog::where('result', 'failed')
            ->latest('created_at')
            ->first();

        $lastActivity = $latestLog;

        return view('dashboard', compact(
            'user',
            'doorStatus',
            'failedAttempts',
            'recentActivities',
            'lastFailed',
            'lastActivity'
        ));
    }
}