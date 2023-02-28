@extends('adminlte::page')

@section('title')
    @if (request()->is('*/edit'))
        シフト管理 - 更新
    @else
        シフト管理 - 一覧
    @endif
@stop

@section('content_header')
    <h1>シフト管理</h1>
@stop

@section('content')
    {{-- 日付 --}}
    @if (request()->is('*/edit'))
        <select name="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/6 mb-3">
            @foreach ($shifts as $value)
                <option value="{{ route('admin.shift.edit', ['shift' => $value]) }}" @if ($shift == $value) selected @endif disabled>
                    {{ $value->year_month->format('Y-m') }}
                </option>
            @endforeach
        </select>
    @else
        <select name="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/6 mb-3" id="target_month">
            @foreach ($shifts as $value)
                <option value="{{ route('admin.shift.show', ['shift' => $value]) }}" @if (($shift ?? app(App\Models\Shift::class)->getCurrentMonthShift()) == $value) selected @endif>
                    {{ $value->year_month->format('Y-m') }}
                </option>
            @endforeach
        </select>
    @endif

    {{-- ボタン --}}
    @if (request()->is('*/edit'))
        <div class="mt-3">
            <a href="{{ route('admin.shift.show', ['shift' => $shift]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">終了</a>
        </div>
    @else
        <a href="{{ route('admin.shift.create') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">新規作成</a>
        <a href="{{ route('admin.shift.edit', ['shift' => $shift ?? app(App\Models\Shift::class)->getCurrentMonthShift()]) }}" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">編集モード</a>
        <a href="{{ route('admin.shift.export', ['shift' => $shift ?? app(App\Models\Shift::class)->getCurrentMonthShift()]) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">DL</a>
        <a href="{{ route('admin.shift.deployment') }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">展開</a>
        <a href="{{ route('admin.shift.attendance_request') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">出勤要請</a>
    @endif

    {{-- シフト --}}
    @include('admin.shifts._shift')
@stop

@section('css')
    @vite('resources/css/app.css')
@stop

@section('js')
    @vite('resources/js/app.js')
    <script>
        $('#target_month').change(function () {
            if ($(this).val() != '') {
                location.href = $(this).val();
            }
        });

        $('.workday').change(function () {
            const id = $(this).data('id');
            const shift_pattern_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax(
                {
                    url: '/admin/shift/update',
                    type: 'PUT',
                    data: {
                        'id': id,
                        'shift_pattern_id': shift_pattern_id
                    },
                    dataType: 'json'
                }
            )
                .then((res) => {
                    console.log(res);
                })
                .fail((error) => {
                    console.log(error.statusText);
                });
        });
    </script>
@stop
