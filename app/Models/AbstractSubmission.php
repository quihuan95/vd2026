<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbstractSubmission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function generateAbstractId(string $specialty): string
    {
        $code = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $specialty), 0, 3));
        if (strlen($code) < 3) {
            $code = str_pad($code, 3, 'X');
        }

        $prefix = "VDUH26-{$code}-";
        $latest = static::where('abstract_id', 'like', "{$prefix}%")
            ->orderByDesc('id')
            ->value('abstract_id');

        if ($latest) {
            $num = (int) substr($latest, strlen($prefix));
            $next = str_pad($num + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $next = '001';
        }

        return $prefix . $next;
    }

    public function getSpecialtyLabelAttribute(): string
    {
        return __('conference.specialties.' . $this->specialty) ?? $this->specialty;
    }

    public function getReviewStatusBadgeClass(): string
    {
        return match ($this->review_status) {
            'accepted' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'under_review' => 'bg-amber-100 text-amber-800 border-amber-300',
            'revision_requested' => 'bg-blue-100 text-blue-800 border-blue-300',
            'rejected' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }
}
