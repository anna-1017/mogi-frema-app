@extends('layouts.header-nav')

@section('title')
<title>送付先住所変更画面 </title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/update_address.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-nav.css') }}">
@endsection


@section('content')
  <div class="update-address">
    <div class="update-address__inner">
      <h2>住所の変更</h2>

      <form class="update-address__form" action="{{ route('address.update', ['item' => $item->id] )}}" method="POST">
      @csrf
        <div class="form-group">
          <div class="form-wrapper">
            <label for="postcode">郵便番号</label>
            <input type="text" name="postcode" value="{{ old('postcode', $item->postcode ?? '') }}">
          </div>

          <div class="form-wrapper">
            <label for="address">住所</label>
            <input type="text" name="address" value="{{ old('address', $item->address ?? '') }}">
          </div>

          <div class="form-wrapper">
            <label for="building">建物名</label>
            <input type="text" name="building" value="{{ old('building', $item->building ?? '') }}">
          </div>

          <button type="submit">更新する</button>
        </div>
      </form>
    </div>
  </div>
    
@endsection
    