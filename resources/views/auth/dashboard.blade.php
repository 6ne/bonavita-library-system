@extends('layouts.app')
@section('title', 'Dashboard')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
<style type="text/css">
.column {
  margin: 10px;
}
</style>
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="tabs is-centered is-fullwidth">
    <ul>
      <li class="is-active deadline-active">
        <a class="deadline">
          <span class="icon is-small"><i class="fas fa-calendar-times"></i></span>
          <span>Deadline</span>
        </a>
      </li>
      <li>
        <a class="today">
          <span class="icon is-small"><i class="fas fa-calendar-day"></i></span>
          <span>Today</span>
        </a>
      </li>
    </ul>
  </div>
  <a class="button is-warning is-rounded">
    <span class="icon">
      <i class="fas fa-bell"></i>
    </span>
    <span>Remind All</span>
  </a>
  <div class="tile is-ancestor anc-div first-anc heading-list">
    <div class="tile is-parent message">
      <div class="tile is-child">
        <div class="title is-6">Username</div>
      </div>
      <div class="tile is-child">
        <div class="title is-6">Title</div>
      </div>
      <div class="tile is-child">
        <div class="title is-6">Author</div>
      </div>
      <div class="tile is-child">
        <div class="title is-6">Day Pass</div>
      </div>
      <div class="tile is-child">
        <div class="title is-6">Penalty</div>
      </div>
    </div>
  </div>
  <div class="tile is-ancestor anc-div first-anc">
    <div class="tile is-parent message book-borrower-list">
      <div class="tile is-child">
        <div class="subtitle is-6">clavinjune</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6">Kisah Seorang Wibu</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6">Weabo</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6 tag is-danger is-rounded">7 days</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6">Rp 7000,-</div>
      </div>
    </div>
  </div>
  <div class="tile is-ancestor anc-div first-anc">
    <div class="tile is-parent message book-borrower-list">
      <div class="tile is-child">
        <div class="subtitle is-6">munyaaa</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6">Kucingku Istanaku</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6">Pecinta Miauw</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6 tag is-danger is-rounded">5 days</div>
      </div>
      <div class="tile is-child">
        <div class="subtitle is-6">Rp 5000,-</div>
      </div>
    </div>
  </div>
</div>
</main>
@endsection

@section('script')
<script type="text/javascript">
  @if(Session::has('user'))
  store.set('id', "{{Session::get('user')->id}}")
  if ("{{Session::get('user')->is_admin}}" == true) {
    store.set('id', "0")
  }
  store.set('real_id', "{{Session::get('user')->id}}")
  store.set('name', "{{Session::get('user')->name}}")
  store.set('username', "{{Session::get('user')->username}}")
  store.set('major', "{{Session::get('user')->major}}")
  store.set('grade', "{{Session::get('user')->grade}}")
  store.set('class', "{{Session::get('user')->class}}")
  store.set('is_admin', "{{Session::get('user')->is_admin}}")
  store.set('books_on_held', "{{Session::get('user')->books_on_held}}")
  @endif

  // if(store.get('is_admin') == 1){
  //   $('main.container').innerHTML = '<div>astagaa</div>'
  // }
  // else if(store.get('is_admin') == 0){
  //   console.log('a')
  // }
</script>
@endsection