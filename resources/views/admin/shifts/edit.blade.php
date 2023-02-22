@extends('adminlte::page')

@section('title', 'シフト管理 - 編集')

@section('content_header')
    <h1>シフト管理</h1>

@stop

@section('content')
    {{-- 日付 --}}
    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/5">
        <option selected>2023/2</option>
        <option value="US">2023/3</option>
        <option value="CA">2023/4</option>
        <option value="FR">2023/5</option>
        <option value="DE">2023/6</option>
        <option value="DE">2023/7</option>
        <option value="DE">2023/8</option>
        <option value="DE">2023/9</option>
        <option value="DE">2023/10</option>
        <option value="DE">2023/11</option>
        <option value="DE">2023/12</option>
    </select>

    {{-- ボタン --}}
    <div class="mt-3">
        <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">保存</button>
        <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">DL</button>
        <a href="{{ route('admin.shift.deployment') }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">展開</a>
        <a href="{{ route('admin.shift.attendance_request') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">出勤要請</a>
    </div>


    {{-- シフト --}}
    <div class="relative overflow-x-auto mt-3">
        <table class="w-full text-sm text-left text-gray-500 border-collapse border border-slate-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="text-center py-3 border border-slate-600">スタッフ名</th>
                @foreach (range(1, 31) as $day)
                    <th scope="col" class="text-center py-3 border border-slate-600">
                        {{ $day }}
                    </th>
                @endforeach
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-slate-700">
                        山田 太郎
                    </th>
                    @foreach (range(1, 31) as $day)
                        <td class="px-6 py-4 border border-slate-700">○</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@stop

@section('css')
    @vite('resources/css/app.css')
@stop

@section('js')
    @vite('resources/js/app.js')
@stop
