<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use Illuminate\Http\Request;

class AccessLogController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $query = AccessLog::orderBy('created_at', 'desc');

        if ($filter === 'success') {
            $query->where('result', 'success');
        } elseif ($filter === 'failed') {
            $query->where('result', 'failed');
        }

        $logs = $query->get();

        $formattedLogs = $logs->map(function ($log) {
            return [
                'log_id' => $log->log_id,
                'event' => $this->formatEvent($log->event_type),
                'door_state' => $this->formatText($log->door_state),
                'lock_state' => $this->formatText($log->lock_state),
                'status' => $this->formatStatus($log),
                'date' => $log->created_at ? $log->created_at->format('Y-m-d') : '-',
                'time' => $log->created_at ? $log->created_at->format('H:i:s') : '-',
            ];
        });

        $allLogs = AccessLog::all();

        $totalEvents = $allLogs->count();
        $successCount = $allLogs->where('result', 'success')->count();
        $failedCount = $allLogs->where('result', 'failed')->count();

        $latestLog = $allLogs->sortByDesc('created_at')->first();
        $latestDate = $latestLog && $latestLog->created_at
            ? $latestLog->created_at->format('Y-m-d')
            : '-';

        return view('status', [
            'logs' => $formattedLogs,
            'totalEvents' => $totalEvents,
            'successCount' => $successCount,
            'failedCount' => $failedCount,
            'latestDate' => $latestDate,
            'activeFilter' => $filter ?? 'all',
        ]);
    }

    private function formatEvent($eventType)
    {
        if (!$eventType) {
            return '-';
        }

        $eventType = trim($eventType);

        $map = [
            'Door Unlocked (Knock Pattern)' => 'Door Unlocked (Knock Pattern)',
            'Wrong Knock Pattern' => 'Wrong Knock Pattern',
            'Door Opened' => 'Door Opened',
            'Door Locked' => 'Door Locked',
            'Unauthorized Attempt' => 'Unauthorized Attempt',

            'door_unlocked' => 'Door Unlocked',
            'door_opened' => 'Door Opened',
            'door_locked' => 'Door Locked',
            'unauthorized_attempt' => 'Unauthorized Attempt',
            'wrong_knock_pattern' => 'Wrong Knock Pattern',
            'knock_attempt' => 'Wrong Knock Pattern',
            'door_access' => 'Door Unlocked (Knock Pattern)',
        ];

        if (isset($map[$eventType])) {
            return $map[$eventType];
        }

        return ucwords(str_replace('_', ' ', strtolower($eventType)));
    }

    private function formatText($text)
    {
        if (!$text) {
            return '-';
        }

        return ucwords(str_replace('_', ' ', strtolower($text)));
    }

    private function formatStatus($log)
    {
        return strtolower($log->result) === 'failed' ? 'Failed' : 'Success';
    }
}