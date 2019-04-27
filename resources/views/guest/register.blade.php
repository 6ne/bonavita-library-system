@extends('layouts.app')
@section('title', 'Register')

@section('content')
<main class="container">
  <div class="columns is-mobile is-centered">
    <h1 class="title">Register Form</h1>
  </div>
  <form method="POST" action="/api/login">
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
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
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
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
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
        <input id="login-button" type="submit" class="button is-link is-fullwidth" value="Login">
      </div>
    </div>
  </form>
</main>
@endsection

@section('script')
  @if ($errors->any())
    <script type="text/javascript">
      toggleModal('red', 'Authentication Error', 'Wrong Username / Password')
    </script>
  @endif
@endsection