@extends('layouts.app')
@section('title', 'Register')

@section('content')
<main class="container">
  <div class="columns is-mobile is-centered">
    <h1 class="title">Register Form</h1>
  </div>
  <form method="POST" action="/api/register">
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
        <div class="field">
          <p class="control has-icons-left">
            <input name="confirm-password" id="confirm-password" class="input" type="password" placeholder="Confirm Password">
            <span class="icon is-small is-left">
              <i class="fa fa-lock"></i>
            </span>
          </p>
        </div>
      </div>
    </div>
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
        <div class="field">
          <div class="control has-icons-left">
            <div class="select is-fullwidth">
              <select id="select-major">
                <option value=0 selected>Major</option>
                <option value='Teacher'>Teacher</option>
                <option value='AK'>AK</option>
                <option value='MM'>MM</option>
                <option value='AP'>AP</option>
                <option value='TKJ'>TKJ</option>
              </select>
            </div>
            <div class="icon is-small is-left">
              <i class="fas fa-book-reader"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
        <div class="field is-grouped">
          <div class="control is-expanded has-icons-left">
            <div class="select is-fullwidth">
              <select id="select-class">
                <option value=0 selected>Class</option>
                <option value=10>X</option>
                <option value=11>XI</option>
                <option value=12>XII</option>
              </select>
            </div>
            <div class="icon is-small is-left">
              <i class="fas fa-id-card-alt"></i>
            </div>
          </div>
          <div class="control is-expanded has-icons-left">
            <div class="select is-fullwidth">
              <select id="select-grade">
                <option value=0 selected>Grade</option>
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                <option value=6>6</option>
                <option value=7>7</option>
                <option value=8>8</option>
                <option value=9>9</option>
                <option value=10>10</option>
              </select>
            </div>
            <div class="icon is-small is-left">
              <i class="fas fa-id-card-alt"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
        <input id="register-button" type="submit" class="button is-link is-fullwidth" value="Register">
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
@else

<script type="text/javascript">
  $('#select-major').addEventListener('click', () => {
    if($('#select-major').value === 'Teacher'){

      $('#select-class').setAttribute('disabled', 'disabled')
      $('#select-grade').setAttribute('disabled', 'disabled')
    }
    else{
      $('#select-class').removeAttribute('disabled')
      $('#select-grade').removeAttribute('disabled')
    }
  })
</script>
@endif
@endsection