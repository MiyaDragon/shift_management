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
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">対象月</label>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-full">
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
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">スタッフ</label>
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-full">
                    <option selected>山田 太郎</option>
                    <option value="US">山田 花子</option>
                </select>
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
