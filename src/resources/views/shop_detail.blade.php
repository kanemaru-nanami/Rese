@extends('layouts.menu1')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('main')
<div class="container">
    <!-- 店の詳細表示 -->
    <div class="shop-detail_content">
      <!-- 店名 -->
      <div class="shop-detail_shop-name">
        <a class="shop-detail_shop-name_a" href="{{url('/') }}"> < </a>
        <h1 class="shop-detail_shop-name_h1">{{ $shop['shop'] }}</h1>
      </div>
      <!-- 画像 -->
      <div class="shop-detail_shop-img">
        <img class="shop-detail_shop-img_img" src="{{ $shop['URL'] }}">
      </div>
      <!-- 分類 -->
      <div class="shop-detail_shop-tag">
        <span>#{{ $shop['region'] }}</span>
        <span>#{{ $shop['genre'] }}</span>
      </div>
      <!-- 説明 -->
      <div class="shop-detail_shop-explanation">
        <p>{{ $shop['store_overview']}}</p>
      </div>
      <!-- 予約 -->
    <div class="shop-reservation_content">
      <h1 class="shop-reservation_content_h1">予約</h1>
      <p class="shop-reservation_content_p">{{ $time_explanation }}</p>
      <!-- 日付の選択 -->
      <form method="GET" action="{{ url('/detail/'.$shop['id']) }}" name="calender_form">
        @csrf
        <input class="shop-reservation_content_date-select" type="date" id="date" name="date" value="{{ $reserve_date }}" min="{{ $tomorrow }}" onchange="document.calender_form.submit()" />
      </form>
      
      <!-- 時間のドロップダウン -->
      <div class="flex items-center mt-3">
        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button class="flex items-center bg-white rounded hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div class="w-48 text-left py-1 px-3">
                      <span id="reserve_time_trigger">{{ empty($time_array) ? "定休日" : $time_array[0] }}</span>
                    </div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
              @foreach ($time_array as $time)
                <x-dropdown-link onclick="on_reserve_time_changed('{{$time}}')">{{$time}}</x-dropdown-link>
              @endforeach
            </x-slot>
        </x-dropdown>
      </div>
       <!-- 人数のドロップダウン -->
      <div class="flex items-center mt-3">
        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button class="flex items-center bg-white rounded hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div class="w-48 text-left py-1 px-3">
                      <span id="reserve_num_trigger">{{ empty($num_array) ? "予約できません" : $num_array[0] . '人' }}</span>
                    </div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
            <x-slot name="content">
              @foreach ($num_array as $num)
                <x-dropdown-link onclick="on_reserve_num_changed('{{$num}}')">{{$num}}人</x-dropdown-link>
              @endforeach                  
            </x-slot>
        </x-dropdown>
      </div>

      <!-- 予約内容の表示 -->
      <div class="shop-reservation_content">
        <table class="text-white">
          <tr>
            <td>
              <span>店名</span>
            </td>
            <td class="pl-8">
              <span>{{ $shop['shop'] }}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span>日付</span>
            </td>
            <td class="pl-8">
              <span id="reserve_date_confirm">{{ $reserve_date }}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span>時刻</span>
            </td>
            <td class="pl-8">
              <span id="reserve_time_confirm">{{ empty($time_array) ? '' : $time_array[0] }}</span>
            </td>
          </tr>
          <tr>
            <td>
              <span>人数</span>
            </td>
            <td class="pl-8">
              <span id="reserve_num_confirm">{{ empty($num_array) ? '' : $num_array[0] . '人' }}</span>
            </td>
          </tr>
        </table>
      </div>

      <form method="POST" action="{{ url('/reserve') }}" >
        @csrf
        <input type="hidden" id="reserve_shop_input" name="shop_id" value="{{ $shop['id'] }}">
        <input type="hidden" id="reserve_date_input" name="date" value="{{ $reserve_date }}">
        <input type="hidden" id="reserve_time_input" name="start_time" value="{{ empty($time_array) ? '' : $time_array[0] }}">
        <input type="hidden" id="reserve_num_input" name="number_of_people" value="{{ empty($num_array) ? '' : $num_array[0] }}">
        <input type="hidden" id="reserve_length" name="time_per_reservation" value="{{ $shop['time_per_reservation'] }}">
        <div class="text-red-600">
          @error('shop_id')
            ※{{ $message }} <BR>
          @enderror
          @error('date')
            ※{{ $message }} <BR>
          @enderror
          @error('start_time')
            ※{{ $message }} <BR>
          @enderror
          @error('number_of_people')
            ※{{ $message }} <BR>
          @enderror
          @error('time_per_reservation')
            ※{{ $message }} <BR>
          @enderror
        </div>
        <button type="submit" class="bg-blue-700 text-white disabled:text-blue-500 w-full py-4 rounded-b absolute bottom-0 left-0" {{ empty($time_array) ? 'disabled' : '' }}>予約する</button>
      </form>
      
    </div>

  </div>
@endsection