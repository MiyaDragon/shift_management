<?php

namespace App\Exports;

use App\Models\Shift;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class WorkdaysExport implements FromView
{
    private CarbonPeriod $period_day;

    /**
     * @param string $year_month
     */
    public function __construct(Shift $shift)
    {
        $this->period_day = CarbonPeriod::create(Carbon::parse($shift->year_month)->startOfMonth(), Carbon::parse($shift->year_month)->endOfMonth());
    }

    public function view(): View
    {
        $period_day = $this->period_day;

        return view('admin.shifts._shift', compact('period_day'));
    }
}
