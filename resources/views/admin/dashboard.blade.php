@extends('adminlte::page')

@section('title', '管理画面トップ')

@section('content_header')
    <h1>管理画面トップページ</h1>
@stop

@section('content')
    <div>ここにコンテンツが入ります。</div>
@stop

@section('css')
    {{-- CSSファイルを記述 --}}
@stop

@section('js')
    {{-- JSファイルを記述 --}}
@stop

{{-- <x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> --}}
