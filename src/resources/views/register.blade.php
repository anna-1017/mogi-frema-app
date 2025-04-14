@extends('layouts.header-no-nav')

    @section('title')
    <title>会員登録</title>
    @endsection
    
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header-no-nav.css') }}">
    @endsection

        @section('content')
            <div class="register">
                <div class="register__inner">
                    <h2 class="register-header">会員登録</h2>
                    <form action="/register" class="register-form" method="POST">
                        @csrf
                        <label class="label">ユーザー名</label>
                        <input class="form-input" type="text" name="name" value="{{ old('name') }}" />
                        @error('name')
                        <span class="input_error">
                            <p class="input_error_message">{{ $message }}</p>
                        </span>
                        @enderror

                        <label class="label">メールアドレス</label>
                        <input class="form-input" type="email" name="email" value="{{ old('email') }}" />
                        @error('email')
                        <span class="input_error">
                            <p class="input_error_message">{{ $errors->first('email') }}</p>
                        </span>
                        @enderror

                        <label class="label">パスワード</label>
                        <input class="form-input" type="password" name="password" />
                        @error('password')
                        <span class="input_error">
                            <p class="input_error_message">{{ $errors->first('password') }}</p>
                        </span>
                        @enderror

                        <label class="label">確認用パスワード</label>
                        <input class="form-input" type="password" name="password_confirmation"/>
                        @error('password')
                        <span class="input_error">
                            <p class="input_error_message">{{ $errors->first('password') }}</p>
                        </span>
                        @enderror
                        
                        
                        <button class="form-button" type="submit">登録する</button>

                        <a href="/login" class="login-notion">ログインはこちら</a>
                        

                    </form>
                </div>
            </div>
        @endsection
    