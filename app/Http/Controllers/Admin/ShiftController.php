<?php

namespace App\Http\Controllers\Admin;

use App\Exports\WorkdaysExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShiftRequest;
use App\Models\Shift;
use App\Models\Workday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;

class ShiftController extends Controller
{
    /**
     * シフト管理画面
     *
     * @return View
     */
    public function index()
    {
        $period_day = CarbonPeriod::create(Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth());

        return view('admin.shifts.index', compact('period_day'));
    }

    /**
     * シフト詳細画面
     *
     * @param Shift $shift
     * @return View
     */
    public function show(Shift $shift)
    {
        $period_day = CarbonPeriod::create(Carbon::parse($shift->year_month)->startOfMonth(), Carbon::parse($shift->year_month)->endOfMonth());

        return view('admin.shifts.index', compact('shift', 'period_day'));
    }

    /**
     * シフト作成画面
     *
     * @return View
     */
    public function create()
    {
        return view('admin.shifts.create');
    }

    /**
     * シフト作成処理画面
     *
     * @param StoreShiftRequest $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreShiftRequest $request)
    {
        $shift = Shift::create($request->validated());

        return to_route('admin.shift.show', compact('shift'));
    }

    /**
     * シフト編集画面
     *
     * @param  Shift $shift
     * @return View
     */
    public function edit(Shift $shift)
    {
        $period_day = CarbonPeriod::create(Carbon::parse($shift->year_month)->startOfMonth(), Carbon::parse($shift->year_month)->endOfMonth());

        return view('admin.shifts.index', compact('shift', 'period_day'));
    }

    /**
     * シフト更新処理
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $shift_pattern_id = $request->shift_pattern_id;

        Workday::findOrFail($id)->update(['shift_pattern_id' => $shift_pattern_id]);
    }

    /**
     * シフト表エクスポート
     *
     * @param Shift $shift
     * @return void
     */
    public function export(Shift $shift)
    {
        return Excel::download(new WorkdaysExport($shift), 'shifts.xlsx');
    }

    /**
     * シフト展開画面
     *
     * @return View
     */
    public function showDeployment()
    {
        return view('admin.shifts.deployment');
    }

    /**
     * シフト展開処理
     *
     * @return View
     */
    public function deployment()
    {
        // 該当月シフトのメールを送る

        // 該当月確定シフトをユーザーページに表示させる
    }

    /**
     * 追加出勤依頼画面
     *
     * @return View
     */
    public function showAttendanceRequest()
    {
        return view('admin.shifts.attendance_request');
    }

    /**
     * 追加出勤依頼処理
     *
     * @return View
     */
    public function attendanceRequest()
    {
        //
    }
}
