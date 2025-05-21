@extends('layouts.header-nav')

@section('title')
<title>購入完了画面</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/show_complete.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
@endsection

@section('content')    
  <div class="complete">
    <div class="complete__inner">
      <h2>購入完了</h2>
      <p class="complete-message">ご購入ありがとうございました！</p>
    </div>
  </div>
@endsection