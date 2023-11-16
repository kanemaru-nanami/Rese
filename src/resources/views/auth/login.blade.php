@extends('layouts.menu2')

@section('main')
@if (session('result'))
<div class="flash_message">
  {{ session('result') }}
</div>
@endif
<h2 class="main-ttl">Login</h2>
<form class="form" action="/login" method="post">
  @csrf
  <div class="input-container">
    <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
    @error('email')
    <p>{{ $message }}</p>
    @enderror
  </div>
  <div class="input-container">
    <input type="password" placeholder="Password" name="password">
    @error('password')
    <p>{{ $message }}</p>
    @enderror
  </div>
  <div class="btn-container">
    <input type="submit" value="ログイン">
  </div>
</form>
@endsection