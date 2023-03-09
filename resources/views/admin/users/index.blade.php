@extends('adminlte::page')

@section('title', 'ユーザー管理 - 一覧')

@section('content_header')
    <h1>ユーザー管理</h1>
@stop

@section('content')
    {{-- ボタン --}}
    <div class="mt-2">
        <a href="{{ route('admin.user.create') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg px-5 py-2.5 mr-2 mb-2">
            新規作成
        </a>
    </div>

    {{-- テーブル --}}
    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-center text-gray-500 border-collapse border border-slate-600">
            <thead class="text-white uppercase bg-gray-600">
                <tr>
                    <th scope="col" class="px-6 py-3 border border-slate-600">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-600">
                        名前
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-600">
                        メールアドレス
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-600">
                        電話番号
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-600">
                        所定
                    </th>
                    <th scope="col" class="px-6 py-3 border border-slate-600">
                        役職
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap border border-slate-700">
                            {{ $user->id }}
                        </th>
                        <td class="px-6 py-4 border border-slate-700">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 border border-slate-700">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 border border-slate-700">
                            {{ $user->telephone_number }}
                        </td>
                        <td class="px-6 py-4 border border-slate-700">
                            {{ $user->prescribed }}
                        </td>
                        <td class="px-6 py-4 border border-slate-700">
                            {{ $user->position->name }}
                        </td>
                        <td class="border border-slate-700">
                            <a href="{{ route('admin.user.edit', ['user' => $user]) }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg px-5 py-2.5 mr-2 mb-2">
                                更新
                            </a>
                            <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal-{{ $user->id }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg px-5 py-2.5 mr-2 mb-2">
                                削除
                            </button>
                        </td>

                        {{-- モーダル --}}
                        <div id="popup-modal-{{ $user->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            {!! Form::open(['method' => 'delete', 'route' => ['admin.user.destroy', ['user' => $user]]]) !!}
                                <div class="relative w-full h-full max-w-md md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal-{{ $user->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $user->name }}を削除しますか？</h3>
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                削除する
                                            </button>
                                            <button data-modal-hide="popup-modal-{{ $user->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">戻る</button>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@stop

@section('css')
    @vite('resources/css/app.css')
@stop

@section('js')
    @vite('resources/js/app.js')
@stop
