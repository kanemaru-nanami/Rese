@extends('layouts.menu1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('main')
<div class="shop_all__content">
    @if (session('result'))
    <div class="flash_message">
    {{ session('result') }}
    </div>
    @endif
    <form class="search-form" action="/shops/search" method="get">
        @csrf
        <div class="search-form__item">
            <select class="search-form__item-select" name="region">
                <option value="{{ $shop['region'] }}">All area</option>
                @foreach ($shops as $shop)
                <option value="{{ $shop['region'] }}">{{ $shop['region'] }}</option>
                @endforeach
            </select>
            <select class="search-form__item-select" name="genre">
                <option value="{{ $shop['genre'] }}">All genre</option>
                @foreach ($shops as $shop)
                <option value="{{ $shop['genre'] }}">{{ $shop['genre'] }}</option>
                @endforeach
            </select>
            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
        </div>
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
    </form>
    <!-- カード一覧 -->
    <div class="cards">
        @foreach ($shops as $shop)
        <div class="card">
            <div class="card__img">
                <img src="{{ $shop['URL'] }}" alt="" />
            </div>
            <div class="card__content">
                <h2 class="card__content-ttl">
                    {{ $shop['shop'] }}
                </h2>
                <div class="card__content-tag">
                    <span>#{{ $shop['region'] }}</span>
                    <span>#{{ $shop['genre'] }}</span>
                </div>
                <div class="favorite_shop-detail">
                    <a class="favorite_shop-detail_label" href="{{ url('/detail/'.$shop['id']) }}">詳しくみる</a>
                    @if( Auth::check() )
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
@endsection