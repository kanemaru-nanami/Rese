@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('main')
<div class="thanks__content-parent">
  <div class="thanks__content-child">
    <div class="thanks__heading">
      <h2>会員登録ありがとうございます</h2>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">ログインする</button>
    </div>
  </div>
</div>
@endsection