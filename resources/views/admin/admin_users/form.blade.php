@extends('adminlte::page')

@php
    if (request()->is('*/create')) {
        $text = '登録';
    } else {
        $text = '更新';
    }
@endphp

@section('title', '管理者管理 - ' . $text)

@section('content_header')
    <h1>{{ '管理者管理 ' . $text }}</h1>
@stop

@section('content')
<div class="mt-3 border-collapse border border-slate-600 bg-white">
  <h1 class="bg-gray border-b border-slate-500">管理者管理</h1>
    <div class="p-3">
      {{-- フォーム --}}
      @if (request()->is('*/create'))
        {!! Form::open(['route' => 'admin.admin_user.store']) !!}
      @else
        {!! Form::open(['method' => 'put', 'route' => ['admin.admin_user.update', ['admin_user' => $admin_user]]]) !!}
      @endif
        <div class="mb-6">
          {!! Form::label('name', '名前', ['class' => 'block mb-2 font-medium text-gray-900']) !!}
          {!! Form::text('name', old('name', $admin_user->name ?? ''), ['class' => ['shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5', $errors->has('name') ? 'border-red-500' : 'border-gray-300'], 'placeholder' => '（例）管理者 太郎', 'required']) !!}
          @includeWhen($errors->has('name'), 'components.input-error', ['messages' => $errors->get('name')])
        </div>
        <div class="mb-6">
          {!! Form::label('email', 'メールアドレス', ['class' => 'block mb-2 font-medium text-gray-900']) !!}
          {!! Form::email('email', old('email', $admin_user->email ?? ''), ['class' => ['shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5', $errors->has('email') ? 'border-red-500' : 'border-gray-300'], 'placeholder' => '（例）example@example.com', 'required']) !!}
          @includeWhen($errors->has('email'), 'components.input-error', ['messages' => $errors->get('email')])
        </div>
        <div class="mb-6">
          {!! Form::label('telephone_number', '電話番号', ['class' => 'block mb-2 font-medium text-gray-900']) !!}
          {!! Form::text('telephone_number', old('telephone_number', $admin_user->telephone_number ?? ''), ['class' => ['shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-full p-2.5', $errors->has('telephone_number') ? 'border-red-500' : 'border-gray-300'], 'placeholder' => '（例）01234567890', 'required']) !!}
          @includeWhen($errors->has('telephone_number'), 'components.input-error', ['messages' => $errors->get('telephone_number')])
        </div>
        <div class="mb-6">
          {!! Form::label('password', 'パスワード', ['class' => 'block mb-2 font-medium text-gray-900']) !!}
          <div class="flex">
            {!! Form::password('password', ['class' => ['shadow-sm bg-gray-50 text-gray-900 rounded-lg block w-1/3 p-2.5 mr-2', $errors->has('password') ? 'border-red-500' : 'border-gray-300'], 'required', 'id' => 'random_pass']) !!}
            @includeWhen($errors->has('password'), 'components.input-error', ['messages' => $errors->get('password')])
            {!! Form::button('自動生成', ['class' => 'bg-gray-500 hover:bg-gray-400 text-white font-medium rounded-lg px-5 py-2.5 text-center', 'id' => 'auto_pass']) !!}
          </div>
        </div>
        {!! Form::submit($text . 'する', ['class' => 'text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg px-5 py-2.5 text-center']) !!}
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('css')
    @vite('resources/css/app.css')
@stop

@section('js')
    @vite('resources/js/app.js')
    <script>
      function genRandomStr() {
        // 使用する文字の定義
        var str = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";

        // 桁数の定義
        var len = 8;

        // ランダムな文字列生成
        var result = "";
        for (var i=0; i<len; i++) {
            result += str.charAt(Math.floor(Math.random() * str.length));
        }

        // 結果表示
        $('#random_pass').val(result);
      }

      $('#auto_pass').on("click",function(){
        genRandomStr();
      });
    </script>
@stop
