@extends('layouts.menu1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('main')
<div class="my_page__content">
    @if (session('result'))
    <div class="flash_message">
    {{ session('result') }}
    </div>
    @endif
    @if( Auth::check() )
    <h1 class="welcome">{{ Auth::user()->name }}さん</h1>
    @endif
    <!-- 予約状況 -->
    <div class="reservations_content1">
      <h2 class="title">予約状況</h2>
      <!-- 予約カード一覧 -->
      <div class="reservations_content2">
        @foreach ($reservations as $reservation)
        <div class="reservations_content3" >
          <h3 class="reservation_title">予約{{ $reservation['id'] }}</h3>
          <table class="reservations_table">
            <tr>
              <td>
                <span>店名</span>
              </td>
              <td>
                <span>{{ $reservation['shop'] }}</span>
              </td>
            </tr>
            <tr>
              <td>
                <span>日付</span>
              </td>
              <td>
                <span>{{ $reservation['date'] }}</span>
              </td>
            </tr>
            <tr>
              <td>
                <span>時刻</span>
              </td>
              <td>
                <span>{{ $reservation['start-time'] }}</span>
              </td>
            </tr>
            <tr>
              <td>
                <span>人数</span>
              </td>
              <td>
                <span>{{ $reservation{'number'} }}</span>
              </td>
            </tr>
          </table>
          <form class="delete-form" action="/reservations/delete" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form_button">
              <input type="hidden" name="id" value="{{ $reservation['id'] }}">
              <button class="delete-form_button-submit" type="submit">削除</button>
            </div>
          </form>
        </div>
        @endforeach
      </div>
    </div>
    <!-- お気に入り店舗 -->
    <div class="favorite_content1">
      <h2 class="title">お気に入り店舗</h2>
      <!-- お気に入りカード一覧 -->
      <div class="favorite_content2">
        @foreach ($favorites as $shop)
        <div class="favorite_content3">
          <div>
            <img class="favorite_img" src="{{ $shop['URL'] }}">
          </div>
          <div class="favorite_detail">
            <h2 class="favorite_shop-name">{{ $shop['name'] }}</h2>
            <div class="favorite_shop-#">
              <span>#{{ $shop['region'] }}</span>
              <span>#{{ $span['genre'] }}</span>
            </div>
            <div class="favorite_shop-detail">
              <a class="favorite_shop-detail_label" href="{{ url('/detail/'.$shop['id']) }}">詳しくみる</a>
              @if(Auth::check())
              <form method="POST" action="{{ url('/favorite') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                <button class="favorite_shop-detail_button" type="submit">&#9829;</button>
              </form>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection