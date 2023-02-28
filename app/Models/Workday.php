<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workday extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'shift_id',
        'shift_pattern_id',
        'workday',
    ];

    /**
     * 出勤日をCarbon形式で取得
     *
     * @return Carbon\Carbon
     */
    public function getWorkdayAttribute($value)
    {
        $year_month = $this
            ->shift
            ->year_month
            ->format('Y-m');

        return Carbon::parse($year_month . '-' . $value);
    }

    /**
     * リレーション（シフト）
     *
     * @return BelongsTo
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    /**
     * リレーション（シフトパターン）
     *
     * @return BelongsTo
     */
    public function shiftPattern()
    {
        return $this->belongsTo(ShiftPattern::class);
    }
}
