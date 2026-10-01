<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'dob' => 'date',
        'attend_dinner' => 'boolean',
        'request_cme' => 'boolean',
        'amount_vnd' => 'decimal:2',
        'checked_in_at' => 'datetime',
        'email_sent_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public static function generateDelegateId(): string
    {
        $year = '26';
        $prefix = "VDUH{$year}-DEL-";
        
        $latest = static::where('delegate_id', 'like', "{$prefix}%")
            ->orderByDesc('id')
            ->value('delegate_id');

        if ($latest) {
            $num = (int) substr($latest, strlen($prefix));
            $next = str_pad($num + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $next = '0001';
        }

        return $prefix . $next;
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount_vnd, 0, ',', '.') . ' VND';
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'invited_speaker' => __('conference.categories.invited_speaker'),
            'vduh_staff' => __('conference.categories.vduh_staff'),
            'vip' => __('conference.categories.vip'),
            default => __('conference.categories.independent_delegate'),
        };
    }

    public function getPaymentStatusBadgeClass(): string
    {
        return match ($this->payment_status) {
            'paid' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'complimentary' => 'bg-blue-100 text-blue-800 border-blue-300',
            'pending_verification' => 'bg-amber-100 text-amber-800 border-amber-300',
            'cancelled' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }
}
