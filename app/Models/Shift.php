<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'year_month',
    ];

    /**
     * シフト年月をCarbonで取得
     *
     * @return Carbon
     */
    public function getYearMonthAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * 登録されている一番最初のシフトの年月を取得
     *
     * @return Carbon
     */
    public function getFirstRegisteredYearMonthAttribute()
    {
        return $this->orderBy('year_month', 'asc')
            ->first()
            ->year_month;
    }

    /**
     * 登録されている一番最後のシフトの年月を取得
     *
     * @return Carbon
     */
    public function getLastRegisteredYearMonthAttribute()
    {
        return $this->orderBy('year_month', 'desc')
            ->first()
            ->year_month;
    }

    /**
     * 次に登録すべきシフトの年月を取得
     *
     * @return Carbon
     */
    public function getNextYearMonthAttribute()
    {
        return $this->last_registered_year_month->addMonth();
    }

    /**
     * 今月のシフトを取得
     *
     * @return Shift
     */
    public function getCurrentMonthShift()
    {
        $current_month = Carbon::today()->format('Y-m');

        return $this->where('year_month', 'LIKE', $current_month . '%')->first();
    }
}
