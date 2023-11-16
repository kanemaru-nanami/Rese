@extends('layouts.menu1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('main')
<div class="done_container">
    <div class="done_content">
      @if ($is_succeeded)
        <p class="done_content_message">
          ご予約ありがとうございます
        </p>
        <div class="done_content_my-page">
          <a class="done_content_my-page_submit" href="{{ url('/my_page') }}">マイページへ</a>
        </div>
      @else
        <p class="done_content_message">定員のためご予約できませんでした。</p>
        <div class="done_content_back">
          <a class="done_content_back_submit" href="{{ url('/detail/'.$shop_id) }}">戻る</a>
        </div>
      @endif
    </div>
  </div>
@endsection