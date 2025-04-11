@extends('layouts.header-no-nav')

    @section('title')
    <title>ログイン</title>
    @endsection
    
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @endsection

            @section('content')
            <div class="login">
                <div class="login__inner">
                    <h2 class="login-header">ログイン</h2>
                    <form action="/login" class="login-form" method="POST">
                        @csrf
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
                        
                        
                        <button class="form-button" type="submit">ログインする</button>

                        <a href="/register" class="login-notion">会員登録はこちら</a>
                        

                    </form>
                </div>
            </div>

            
            
            
        