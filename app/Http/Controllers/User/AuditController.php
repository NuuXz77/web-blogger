<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visits;
use Illuminate\Support\Facades\Auth;

class AuditController extends Controller
{
    /**
     * Display a listing of visits for the logged in author/user
     */
    public function index()
    {
        $visits = Visits::with(['auditor'])
            ->where('author_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        
        return view('user.audit.index', compact('visits'));
    }

    /**
     * Display the specified visit for the author
     */
    public function show(Visits $audit)
    {
        // Only allow author to view their own visits
        if ($audit->author_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat audit ini.');
        }

        $audit->load(['auditor']);
        return view('user.audit.show', compact('audit'));
    }

    /**
     * Confirm the visit schedule by author (new status flow)
     */
    public function authorConfirm(Visits $audit)
    {
        // Only allow author to confirm their own visits
        if ($audit->author_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengkonfirmasi audit ini.');
        }

        // Only allow confirmation if status is pending
        if ($audit->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Audit tidak dapat dikonfirmasi pada status saat ini.');
        }

        $audit->update([
            'status' => 'confirmed_by_author',
            'author_confirmed' => true,
            'author_confirmed_at' => now(),
            'rejection_reason' => null, // Clear previous rejection
        ]);

        return redirect()->back()
            ->with('success', 'Jadwal audit berhasil dikonfirmasi! Menunggu persetujuan admin.');
    }

    /**
     * Cancel confirmation by author
     */
    public function authorCancel(Visits $audit)
    {
        // Only allow author to cancel their own visits
        if ($audit->author_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk membatalkan audit ini.');
        }

        // Only allow cancellation if status is confirmed_by_author
        if ($audit->status !== 'confirmed_by_author') {
            return redirect()->back()
                ->with('error', 'Audit tidak dapat dibatalkan pada status saat ini.');
        }

        $audit->update([
            'status' => 'pending',
            'author_confirmed' => false,
            'author_confirmed_at' => null,
        ]);

        return redirect()->back()
            ->with('success', 'Konfirmasi audit berhasil dibatalkan.');
    }

    /**
     * Request reschedule by author
     */
    public function requestReschedule(Request $request, Visits $audit)
    {
        // Only allow author to request reschedule for their own visits
        if ($audit->author_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk meminta perubahan jadwal audit ini.');
        }

        // Only allow reschedule request if status is pending
        if ($audit->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Tidak dapat meminta perubahan jadwal pada status saat ini.');
        }

        $request->validate([
            'reschedule_reason' => 'required|string|max:500',
            'preferred_date' => 'nullable|date|after:today',
            'preferred_time' => 'nullable|string|max:100',
        ]);

        $audit->update([
            'author_confirmed' => true,
            'author_confirmed_at' => now(),
            'reschedule_requested' => true,
            'reschedule_reason' => $request->reschedule_reason,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'status' => 'confirmed_by_author',
            'reschedule_requested_at' => now(),
            'rejection_reason' => null, // Clear previous rejection
        ]);

        return redirect()->back()
            ->with('success', 'Permintaan perubahan jadwal berhasil dikirim! Admin akan segera menghubungi Anda.');
    }
}