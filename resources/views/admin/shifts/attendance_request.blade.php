@extends('adminlte::page')

@section('title', 'シフト管理 - 出勤要請')

@section('content_header')
    <h1>シフト管理</h1>
@stop

@section('content')
    {{-- フォーム --}}
    <div class="container mx-auto w-1/2">
        <form>
            <div class="mb-6">
                <label for="year_month" class="block mb-2 text-sm font-medium text-gray-900">対象月</label>
                <input type="month" name="year_month" class="form-control" id="year_month" min="{{ app(App\Models\Shift::class)->first_registered_year_month->format('Y-m') }}" max="{{ app(App\Models\Shift::class)->last_registered_year_month->format('Y-m') }}" value="{{ app(App\Models\Shift::class)->last_registered_year_month->format('Y-m') }}">
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">スタッフ</label>
                {!! Form::select('user', $users->pluck('name', 'id'), false, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-full']) !!}
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">展開</button>
        </form>
    </div>


@stop

@section('css')
    @vite('resources/css/app.css')
@stop

@section('js')
    @vite('resources/js/app.js')
@stop
