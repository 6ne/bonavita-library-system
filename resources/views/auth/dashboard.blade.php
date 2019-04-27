@extends('layouts.app')
@section('title', 'Dashboard')

@section('style')
<style type="text/css">
  .column {
    margin: 10px;
  }
</style>
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="columns">
    <div class="column">
      <div class="box">
        <h1 class="title">Book's Title</h1>
        <h2 class="subtitle">Book's Author</h2>
        <div class="columns">
          <div class="column">
            <h2 class="subtitle">Transaction Date</h2>
            <h2 class="subtitle">01 Jan 1970</h2>
          </div>
          <div class="column">
            <h2 class="subtitle">Due Date</h2>
            <h2 class="subtitle">03 Jan 1970</h2>
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <span class="subtitle has-text-danger">Penalty</span>
            <span class="subtitle has-text-danger">Rp 5.000,-</span>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="box">
        <h1 class="title">Book's Title</h1>
        <h2 class="subtitle">Book's Author</h2>
        <div class="columns">
          <div class="column">
            <h2 class="subtitle">Transaction Date</h2>
            <h2 class="subtitle">01 Jan 1970</h2>
          </div>
          <div class="column">
            <h2 class="subtitle">Due Date</h2>
            <h2 class="subtitle">03 Jan 1970</h2>
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <span class="subtitle has-text-danger">Penalty</span>
            <span class="subtitle has-text-danger">Rp 5.000,-</span>
          </div>
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
</script>
@endsection