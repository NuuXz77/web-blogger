<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visits;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Exports\AuditReportExport;
use Maatwebsite\Excel\Facades\Excel;

class AuditController extends Controller
{
    /**
     * Display a listing of visits for admin
     */
    public function index()
    {
        $visits = Visits::with(['auditor', 'author'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.audit.index', compact('visits'));
    }

    /**
     * Show the form for creating a new visit
     */
    public function create()
    {
        $auditors = User::where('role', 'auditor')->get();
        $authors = User::where('role', 'user')->get();
        
        return view('admin.audit.create', compact('auditors', 'authors'));
    }

    /**
     * Store a newly created visit in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:users,id',
            'auditor_id' => 'required|exists:users,id',
            'tanggal' => 'required|date|after:today',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        Visits::create([
            'author_id' => $request->author_id,
            'auditor_id' => $request->auditor_id,
            'tanggal' => $request->tanggal,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'status' => 'waiting_author', // Status awal: menunggu konfirmasi author
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Jadwal audit berhasil dibuat! Author akan mendapat notifikasi untuk konfirmasi.');
    }

    /**
     * Display the specified visit
     */
    public function show(Visits $audit)
    {
        $audit->load(['auditor', 'author']);
        return view('admin.audit.show', compact('audit'));
    }

    /**
     * Show the form for editing the specified visit
     */
    public function edit(Visits $audit)
    {
        $auditors = User::where('role', 'auditor')->get();
        $authors = User::where('role', 'user')->get();
        
        return view('admin.audit.edit', compact('audit', 'auditors', 'authors'));
    }

        /**
     * Update the specified visit in storage
     */
    public function update(Request $request, Visits $audit)
    {
        $request->validate([
            'author_id' => 'required|exists:users,id',
            'auditor_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'alamat' => 'required|string',
            'keterangan' => 'nullable|string',
            'status' => 'in:waiting_author,waiting_reschedule,ready_for_audit,in_progress,completed',
        ]);

        $audit->update($request->only([
            'author_id', 'auditor_id', 'tanggal', 'alamat', 'keterangan', 'status'
        ]));

        return redirect()->route('admin.audit.index')
            ->with('success', 'Data audit berhasil diperbarui.');
    }

    /**
     * Confirm auditor report (admin only) - Final approval
     */
    public function confirmReport(Visits $audit)
    {
        // Only allow admin to confirm
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Only allow confirmation if status is 'in_progress'
        if ($audit->status !== 'in_progress') {
            return redirect()->back()
                ->with('error', 'Laporan tidak dapat dikonfirmasi pada status saat ini.');
        }

        $audit->update([
            'status' => 'completed',
            'admin_final_approved_at' => now(),
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Laporan kunjungan berhasil dikonfirmasi dan audit selesai!');
    }

    /**
     * Reject auditor report (admin only)
     */
    public function rejectReport(Request $request, Visits $audit)
    {
        // Only allow admin to reject
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Only allow rejection if status is 'in_progress'
        if ($audit->status !== 'in_progress') {
            return redirect()->back()
                ->with('error', 'Laporan tidak dapat ditolak pada status saat ini.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $audit->update([
            'status' => 'confirmed_by_admin', // Return to confirmed status
            'rejection_reason' => $request->rejection_reason,
            'hasil' => null,
            'selfie' => null,
            'lat' => null,
            'long' => null,
            'visited_at' => null,
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Laporan kunjungan ditolak dan dikembalikan ke auditor!');
    }

    /**
     * Admin approve reschedule request from author (clearer method name)
     */
    public function approveRescheduleRequest(Request $request, Visits $audit)
    {
        // Only allow admin to approve reschedule
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menyetujui perubahan jadwal.');
        }

        // Only allow if status is waiting_reschedule
        if ($audit->status !== 'waiting_reschedule') {
            return redirect()->back()
                ->with('error', 'Tidak ada permintaan perubahan jadwal yang perlu disetujui.');
        }

        $request->validate([
            'tanggal' => 'required|date|after:today',
            'waktu' => 'nullable|string|max:100'
        ]);

        $audit->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'status' => 'ready_for_audit',
            'reschedule_requested' => false,
            'reschedule_reason' => null,
            'preferred_date' => null,
            'preferred_time' => null,
            'reschedule_requested_at' => null,
            'admin_approved_schedule' => true,
            'admin_approved_schedule_at' => now(),
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Perubahan jadwal disetujui! Audit siap dilaksanakan auditor.');
    }

    /**
     * Admin reject reschedule request from author (clearer method name)
     */
    public function rejectRescheduleRequest(Request $request, Visits $audit)
    {
        // Only allow admin to reject reschedule
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menolak perubahan jadwal.');
        }

        // Only allow if status is waiting_reschedule
        if ($audit->status !== 'waiting_reschedule') {
            return redirect()->back()
                ->with('error', 'Tidak ada permintaan perubahan jadwal yang perlu ditolak.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $audit->update([
            'status' => 'waiting_author',
            'reschedule_requested' => false,
            'reschedule_reason' => null,
            'preferred_date' => null,
            'preferred_time' => null,
            'reschedule_requested_at' => null,
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Permintaan perubahan jadwal ditolak. Author harus konfirmasi ulang dengan jadwal asli.');
    }

    /**
     * Admin approve author confirmation (final approval for audit to start)
     */
    public function approveAuthorConfirmation(Visits $audit)
    {
        // Only allow admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menyetujui jadwal audit.');
        }

        // Only allow if author already confirmed (status waiting_author but author_confirmed = true)
        if ($audit->status !== 'waiting_author' || !$audit->author_confirmed) {
            return redirect()->back()
                ->with('error', 'Author belum mengkonfirmasi jadwal audit.');
        }

        $audit->update([
            'status' => 'ready_for_audit',
            'admin_approved_schedule' => true,
            'admin_approved_schedule_at' => now(),
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Jadwal audit disetujui! Auditor sekarang dapat melaksanakan kunjungan.');
    }

    /**
     * Reject reschedule request from author
     */
    public function rejectReschedule(Request $request, Visits $audit)
    {
        // Only allow admin to reject reschedule
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Only allow if there's a reschedule request
        if (!$audit->reschedule_requested) {
            return redirect()->back()
                ->with('error', 'Tidak ada permintaan perubahan jadwal untuk audit ini.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $audit->update([
            'reschedule_requested' => false,
            'reschedule_reason' => null,
            'preferred_date' => null,
            'preferred_time' => null,
            'reschedule_requested_at' => null,
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.audit.index')
            ->with('success', 'Permintaan perubahan jadwal ditolak. Author harus konfirmasi ulang dengan jadwal asli.');
    }

    /**
     * Remove the specified visit from storage
     */
    public function destroy(Visits $audit)
    {
        if ($audit->selfie) {
            Storage::delete($audit->selfie);
        }
        
        $audit->delete();

        return redirect()->route('admin.audit.index')
            ->with('success', 'Audit berhasil dihapus.');
    }

    // === AUDITOR METHODS ===

    /**
     * Author cancels/rejects audit
     */
    public function authorCancel(Visits $audit)
    {
        // Only allow author to cancel their own audit
        if ($audit->author_id !== Auth::id()) {
            abort(403);
        }

        // Only allow cancellation if status is 'pending'
        if ($audit->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Audit tidak dapat dibatalkan pada status saat ini.');
        }

        $audit->update([
            'status' => 'cancelled_by_author',
            'author_cancelled_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Audit dibatalkan. Admin akan meninjau ulang jadwal.');
    }

    /**
     * Admin confirms author's confirmation (approve to proceed)
     */
    public function adminConfirm(Visits $audit)
    {
        // Only allow admin to confirm
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Only allow confirmation if author has confirmed
        if ($audit->status !== 'confirmed_by_author') {
            return redirect()->back()
                ->with('error', 'Author belum mengkonfirmasi atau status tidak sesuai.');
        }

        $audit->update([
            'status' => 'confirmed_by_admin',
            'admin_confirmed_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Audit disetujui! Auditor sekarang dapat melakukan kunjungan.');
    }

    /**
     * Admin rejects author's confirmation
     */
    public function adminReject(Request $request, Visits $audit)
    {
        // Only allow admin to reject
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Only allow rejection if author has confirmed
        if ($audit->status !== 'confirmed_by_author') {
            return redirect()->back()
                ->with('error', 'Author belum mengkonfirmasi atau status tidak sesuai.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $audit->update([
            'status' => 'pending',
            'rejection_reason' => $request->rejection_reason,
            'author_confirmed_at' => null,
        ]);

        return redirect()->back()
            ->with('success', 'Konfirmasi author ditolak dan dikembalikan ke status pending.');
    }

    /**
     * Display a listing of visits for auditor
     */
    public function auditorIndex()
    {
        $visits = Visits::with(['auditor', 'author'])
            ->where('auditor_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        
        return view('auditor.audit.index', compact('visits'));
    }

    /**
     * Reject visit (change status back to pending)
     */
    public function reject(Visits $audit)
    {
        $audit->update(['status' => 'pending']);
        
        return redirect()->back()
            ->with('success', 'Kunjungan dikembalikan ke status pending!');
    }

    // === AUDITOR METHODS ===

    /**
     * Display visits assigned to logged in auditor
     */
    public function auditorIndex()
    {
        $visits = Visits::with(['author'])
            ->where('auditor_id', Auth::id())
            ->orderBy('tanggal', 'asc')
            ->paginate(10);
        
        return view('auditor.audit.index', compact('visits'));
    }

    /**
     * Show form for auditor to report visit
     */
    public function auditorReport(Visits $audit)
    {
        // Only allow auditor to report their own visits
        if ($audit->auditor_id !== Auth::id()) {
            abort(403);
        }

        // Only allow report if admin has confirmed
        if ($audit->status !== 'confirmed_by_admin') {
            return redirect()->route('auditor.audit.show', $audit)
                ->with('error', 'Kunjungan belum disetujui admin. Tidak dapat melakukan laporan.');
        }

        return view('auditor.audit.report', compact('audit'));
    }

    /**
     * Show audit detail for auditor
     */
    public function auditorShow(Visits $audit)
    {
        // Check if auditor can view this audit
        if (auth()->user()->role !== 'auditor' || ($audit->auditor_id && $audit->auditor_id !== auth()->id())) {
            abort(403);
        }

        return view('auditor.audit.show', compact('audit'));
    }

    /**
     * Store auditor report
     */
    public function auditorStoreReport(Request $request, Visits $audit)
    {
        // Only allow auditor to report their own visits
        if ($audit->auditor_id !== Auth::id()) {
            abort(403);
        }

        // Only allow report if admin has confirmed
        if ($audit->status !== 'confirmed_by_admin') {
            return redirect()->back()
                ->with('error', 'Kunjungan belum disetujui admin. Tidak dapat melakukan laporan.');
        }

        $request->validate([
            'hasil' => 'required|string',
            'selfie' => 'required|string', // base64 data from camera
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        // Process base64 image data
        $imageData = $request->selfie;
        
        // Remove data:image/jpeg;base64, prefix if exists
        if (strpos($imageData, 'data:image') === 0) {
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
        }
        
        // Decode base64
        $decodedImage = base64_decode($imageData);
        
        // Generate unique filename
        $fileName = 'selfie_' . $audit->id . '_' . time() . '.jpg';
        $filePath = 'selfies/' . $fileName;
        
        // Store the image
        Storage::disk('public')->put($filePath, $decodedImage);

        $audit->update([
            'hasil' => $request->hasil,
            'selfie' => $filePath,
            'lat' => $request->lat,
            'long' => $request->long,
            'status' => 'in_progress', // Change to in_progress, waiting for admin final approval
            'visited_at' => now(),
        ]);

        return redirect()->route('auditor.audit.index')
            ->with('success', 'Laporan kunjungan berhasil disimpan dan menunggu konfirmasi final admin!');
    }

    /**
     * Show auditor's visit recap with map
     */
    public function auditorRecap()
    {
        $visits = Visits::with(['author'])
            ->where('auditor_id', Auth::id())
            ->where('status', 'completed')
            ->whereNotNull('lat')
            ->whereNotNull('long')
            ->orderBy('tanggal', 'asc')
            ->get();
        
        return view('auditor.audit.recap', compact('visits'));
    }

    /**
     * Return visits data for chart (JSON) for admin dashboard.
     * Supports filters: range (day, week, month, custom), start, end, and auditor_id
     */
    public function visitsChartData(Request $request)
    {
        try {
            // Check authentication and authorization
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'Not authenticated',
                    'labels' => ['Auth Error'],
                    'data' => [0]
                ], 401);
            }

            if (Auth::user()->role !== 'admin') {
                return response()->json([
                    'error' => 'Not authorized - need admin role',
                    'labels' => ['Auth Error'],
                    'data' => [0]
                ], 403);
            }

            $range = $request->query('range', 'week');
            $auditorId = $request->query('auditor_id');
            $startDate = $request->query('start');
            $endDate = $request->query('end');

            // Base query
            $query = Visits::query();
            if ($auditorId) {
                $query->where('auditor_id', $auditorId);
            }

            $labels = [];
            $data = [];
            $now = \Carbon\Carbon::now();

            switch ($range) {
                case 'day':
                    // Last 7 days with day names and dates
                    for ($i = 6; $i >= 0; $i--) {
                        $date = $now->copy()->subDays($i);
                        // Format: "Senin, 6 Okt"
                        $dayNames = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin', 
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];
                        $dayName = $dayNames[$date->format('l')];
                        $labels[] = $dayName . ', ' . $date->format('d M');
                        $count = (clone $query)
                            ->whereDate('created_at', $date)
                            ->count();
                        $data[] = $count;
                    }
                    break;

                case 'week':
                    // Last 4 weeks with date ranges
                    for ($i = 3; $i >= 0; $i--) {
                        $startWeek = $now->copy()->subWeeks($i)->startOfWeek();
                        $endWeek = $now->copy()->subWeeks($i)->endOfWeek();
                        // Format: "1-7 Okt" or "30 Sep-6 Okt" for cross-month weeks
                        if ($startWeek->month === $endWeek->month) {
                            $labels[] = $startWeek->format('d') . '-' . $endWeek->format('d M');
                        } else {
                            $labels[] = $startWeek->format('d M') . '-' . $endWeek->format('d M');
                        }
                        $count = (clone $query)
                            ->whereBetween('created_at', [$startWeek, $endWeek])
                            ->count();
                        $data[] = $count;
                    }
                    break;

                case 'month':
                    // Last 12 months with Indonesian month names
                    $monthNames = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    
                    for ($i = 11; $i >= 0; $i--) {
                        $date = $now->copy()->subMonths($i);
                        $monthName = $monthNames[$date->month];
                        $labels[] = $monthName . ' ' . $date->year;
                        $count = (clone $query)
                            ->whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->count();
                        $data[] = $count;
                    }
                    break;

                case 'custom':
                    if (!$startDate || !$endDate) {
                        return response()->json([
                            'error' => 'Start date and end date are required for custom range',
                            'labels' => ['Error'],
                            'data' => [0]
                        ]);
                    }

                    $start = \Carbon\Carbon::parse($startDate);
                    $end = \Carbon\Carbon::parse($endDate);
                    
                    if ($end->lt($start)) {
                        return response()->json([
                            'error' => 'End date must be after start date',
                            'labels' => ['Error'],
                            'data' => [0]
                        ]);
                    }

                    // Determine the appropriate interval based on date range
                    $daysDiff = $start->diffInDays($end);
                    
                    if ($daysDiff <= 31) {
                        // Show daily data for ranges up to 31 days with day names
                        $dayNames = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin', 
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];
                        
                        $current = $start->copy();
                        while ($current->lte($end)) {
                            if ($daysDiff <= 7) {
                                // For weekly range, show day name with date
                                $dayName = $dayNames[$current->format('l')];
                                $labels[] = $dayName . ', ' . $current->format('d M');
                            } else {
                                // For longer daily ranges, just show date
                                $labels[] = $current->format('d M');
                            }
                            $count = (clone $query)
                                ->whereDate('created_at', $current)
                                ->count();
                            $data[] = $count;
                            $current->addDay();
                        }
                    } else {
                        // Show monthly data for longer ranges with Indonesian month names
                        $monthNames = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                        
                        $current = $start->copy()->startOfMonth();
                        while ($current->lte($end)) {
                            $monthName = $monthNames[$current->month];
                            $labels[] = $monthName . ' ' . $current->year;
                            $count = (clone $query)
                                ->whereYear('created_at', $current->year)
                                ->whereMonth('created_at', $current->month)
                                ->whereBetween('created_at', [$start, $end])
                                ->count();
                            $data[] = $count;
                            $current->addMonth();
                        }
                    }
                    break;

                default:
                    return response()->json([
                        'error' => 'Invalid range parameter',
                        'labels' => ['Error'],
                        'data' => [0]
                    ]);
            }

            return response()->json([
                'labels' => $labels,
                'data' => $data,
                'debug' => [
                    'range' => $range,
                    'auditor_id' => $auditorId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'total_visits' => Visits::count(),
                    'filtered_visits' => $query->count(),
                    'user' => Auth::user()->name . ' (' . Auth::user()->role . ')'
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Chart data error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'labels' => ['Server Error'],
                'data' => [0]
            ], 500);
        }
    }

    /**
     * Export visits data to Excel
     */
    public function exportExcel(Request $request)
    {
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
        $status = $request->status;
        
        $filename = 'laporan_audit_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        return Excel::download(
            new AuditReportExport($dateFrom, $dateTo, $status), 
            $filename
        );
    }
}
