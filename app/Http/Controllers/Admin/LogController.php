<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    /**
     * Display Laravel logs
     */
    public function index(Request $request)
    {
        $logPath = storage_path('logs/laravel.log');
        
        if (!File::exists($logPath)) {
            return view('admin.logs.index', [
                'logs' => [],
                'message' => 'Log file tidak ditemukan'
            ]);
        }

        $logs = $this->parseLogs($logPath, $request);
        
        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Parse log file and extract entries
     */
    private function parseLogs($logPath, $request)
    {
        $content = File::get($logPath);
        $logs = [];
        
        // Split by log pattern (Laravel log format)
        $pattern = '/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*?)(?=\[\d{4}-\d{2}-\d{2}|\Z)/s';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
        
        foreach ($matches as $match) {
            $datetime = $match[1];
            $environment = $match[2];
            $level = strtoupper($match[3]);
            $message = trim($match[4]);
            
            // Filter by level if specified
            if ($request->level && $request->level !== 'all' && strtolower($level) !== strtolower($request->level)) {
                continue;
            }
            
            // Filter by search if specified
            if ($request->search && stripos($message, $request->search) === false) {
                continue;
            }
            
            $logs[] = [
                'datetime' => $datetime,
                'environment' => $environment,
                'level' => $level,
                'message' => $message,
                'level_class' => $this->getLevelClass($level)
            ];
        }
        
        // Sort by datetime descending (newest first)
        usort($logs, function($a, $b) {
            return strtotime($b['datetime']) - strtotime($a['datetime']);
        });
        
        // Pagination
        $perPage = 50;
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $paginatedLogs = array_slice($logs, $offset, $perPage);
        $totalPages = ceil(count($logs) / $perPage);
        
        return [
            'data' => $paginatedLogs,
            'total' => count($logs),
            'current_page' => $page,
            'total_pages' => $totalPages,
            'per_page' => $perPage,
            'has_prev' => $page > 1,
            'has_next' => $page < $totalPages,
            'prev_page' => $page > 1 ? $page - 1 : null,
            'next_page' => $page < $totalPages ? $page + 1 : null
        ];
    }

    /**
     * Get CSS class for log level
     */
    private function getLevelClass($level)
    {
        switch (strtolower($level)) {
            case 'emergency':
            case 'alert':
            case 'critical':
            case 'error':
                return 'danger';
            case 'warning':
                return 'warning';
            case 'notice':
            case 'info':
                return 'info';
            case 'debug':
                return 'secondary';
            default:
                return 'primary';
        }
    }

    /**
     * Clear log file
     */
    public function clear()
    {
        $logPath = storage_path('logs/laravel.log');
        
        if (File::exists($logPath)) {
            File::put($logPath, '');
            return redirect()->route('admin.logs.index')->with('success', 'Log file berhasil dibersihkan');
        }
        
        return redirect()->route('admin.logs.index')->with('error', 'Log file tidak ditemukan');
    }

    /**
     * Download log file
     */
    public function download()
    {
        $logPath = storage_path('logs/laravel.log');
        
        if (!File::exists($logPath)) {
            return redirect()->route('admin.logs.index')->with('error', 'Log file tidak ditemukan');
        }
        
        return Response::download($logPath, 'laravel-' . date('Y-m-d-H-i-s') . '.log');
    }

    /**
     * Get log statistics
     */
    public function stats()
    {
        $logPath = storage_path('logs/laravel.log');
        
        if (!File::exists($logPath)) {
            return response()->json(['error' => 'Log file tidak ditemukan'], 404);
        }

        $content = File::get($logPath);
        $stats = [
            'file_size' => $this->formatBytes(File::size($logPath)),
            'total_lines' => substr_count($content, "\n"),
            'last_modified' => date('d/m/Y H:i:s', File::lastModified($logPath))
        ];

        // Count by level
        $levels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];
        foreach ($levels as $level) {
            $stats['levels'][$level] = substr_count(strtolower($content), strtolower($level));
        }

        return response()->json($stats);
    }

    /**
     * Format bytes to human readable
     */
    private function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}