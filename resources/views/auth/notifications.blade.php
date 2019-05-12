@extends('layouts.app')
@section('title', 'Notifications')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/notification.css') }}">
@endsection

@section('content')
<main class="container">
  <div class="column heading is-paddingless">
    <figure class="image">
      <img src="{{ asset('heading/notification.png') }}">
    </figure>
  </div>
  <div id="notification">
    
  </div>
</main>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/services/notification.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pages/notification.js') }}"></script>
@endsection