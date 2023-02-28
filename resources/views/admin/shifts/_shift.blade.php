<div class="relative overflow-x-auto mt-3">
    <table class="w-full text-sm text-left text-gray-500 border-collapse border border-slate-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th></th>
                @foreach ($period_day as $date)
                    <th scope="col" class="text-center py-3 border border-slate-600 @if ($date->dayOfWeek === 0 | $date->dayOfWeek === 6) bg-gray-500 text-white @endif">
                        {{ $date->isoFormat('ddd'); }}
                    </th>
                @endforeach
            </tr>
            <tr>
                <th scope="col" class="text-center py-3 border border-slate-600">スタッフ名</th>
                @foreach ($period_day as $date)
                    <th scope="col" class="text-center py-3 border border-slate-600 @if ($date->dayOfWeek === 0 | $date->dayOfWeek === 6) bg-gray-500 text-white @endif">
                        {{ $date->day }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-slate-700">
                    {{ $user->name }}
                </th>
                @foreach ($period_day as $date)
                    <td class="px-6 py-4 border border-slate-700 @if ($date->dayOfWeek === 0 | $date->dayOfWeek === 6) bg-gray-500 @endif">
                        @foreach ($user->workdays ?? [] as $workday)
                            @if ($workday->workday == $date)
                                @if (request()->is('*/edit'))
                                    {!! Form::select('workday', $shift_patterns->pluck('name', 'id'), $workday->shiftPattern->id, ['class' => 'workday', 'data-id' => $workday->id]) !!}
                                @else
                                    {{ $workday->shiftPattern->name }}
                                @endif
                            @endif
                        @endforeach
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
