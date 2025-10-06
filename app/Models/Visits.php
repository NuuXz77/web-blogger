<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'auditor_id',
        'author_id',
        'tanggal',
        'alamat',
        'keterangan',
        'lat',
        'long',
        'selfie',
        'hasil',
        'status',
        'rejection_reason',
        'author_confirmed',
        'author_confirmed_at',
        'reschedule_requested',
        'reschedule_reason',
        'preferred_date',
        'preferred_time',
        'reschedule_requested_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'lat' => 'decimal:7',
        'long' => 'decimal:7',
        'author_confirmed' => 'boolean',
        'author_confirmed_at' => 'datetime',
        'reschedule_requested' => 'boolean',
        'preferred_date' => 'date',
        'reschedule_requested_at' => 'datetime',
    ];

    /**
     * Get the auditor (user with auditor role) assigned to this visit
     */
    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    /**
     * Get the author (user) that this visit is for
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Check if visit is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if visit is confirmed
     */
    public function isConfirmed()
    {
        return $this->status === 'konfirmasi';
    }

    /**
     * Check if visit is completed
     */
    public function isCompleted()
    {
        return $this->status === 'selesai';
    }
}
