@extends('layouts.app')
@section('title', 'Login')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<main class="container login-container">
  <form method="POST" action="/api/login">
    <div class="columns is-vcentered box">
      <div class="column is-half left-side-login">
        <div><img class="login-img" src="{{ asset('library-logo.png') }}"></div>
        <div class="column has-text-centered is-size-5 member-text has-text-white-bis">MEMBER</div>
        <div><img class="login-img" src="{{ asset('img/library-isometric-1.png') }}"></div>
      </div>
      <div class="column">
        <div class="columns">
          <div class="column is-size-3 has-text-centered">MEMBER LOGIN</div>
        </div>
        <div class="columns">
          <div class="column is-size-7 has-text-centered">The library is the temple of learning, and learning has liberated more people than all the wars in history.</div>
        </div>
        <div class="columns">
          <div class="column input-column">
            <div class="field">
              <p class="control has-icons-left">
                <input name="username" id="nis" class="input" type="text" placeholder="Student's Number" autofocus>
                <span class="icon is-small is-left">
                  <i class="fa fa-user"></i>
                </span>
              </p>
            </div>
          </div>
        </div>
        <div class="columns">
          <div class="column input-column">
            <div class="field">
              <p class="control has-icons-left">
                <input name="password" id="password" class="input" type="password" placeholder="Password">
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </p>
            </div>
          </div>
        </div>
        <div class="columns">
          <div class="column input-column">
            <input id="login-button" type="submit" class="button is-link is-fullwidth is-rounded" value="Login">
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
@endsection

@section('script')
<script type="text/javascript">
  @if ($errors->any())
  toggleModal('red', 'Authentication Error', 'Wrong Username / Password')
  @endif
  store.clear()
</script>
@endsection