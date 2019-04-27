@extends('layouts.app')
@section('title', 'Register')

@section('content')
<main class="container">
  <div class="columns is-mobile is-centered">
    <h1 class="title">Register Form</h1>
  </div>
  <form method="POST" action="/api/register" onsubmit="cacheInput()">
    <div class="columns is-mobile is-centered">
      <div class="column is-one-third">
        <div class="field">
          <p class="control has-icons-left">
            <input name="name" id="name" class="input" type="text" placeholder="Full Name" autofocus>
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
            <input name="username" id="nis" class="input" type="text" placeholder="Student's Number" autofocus>
            <span class="icon is-small is-left">
              <i class="fa fa-address-card"></i>
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
            <input name="password_confirmation" id="confirm-password" class="input" type="password" placeholder="Confirm Password">
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
              <select name="major" id="select-major">
                <option value="null" selected>Major</option>
                <option value="Teacher">Teacher</option>
                <option value="AK">AK</option>
                <option value="MM">MM</option>
                <option value="AP">AP</option>
                <option value="TKJ">TKJ</option>
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
              <select name="class" id="select-class">
                <option value="null" selected>Class</option>
                <option value="10">X</option>
                <option value="11">XI</option>
                <option value="12">XII</option>
              </select>
            </div>
            <div class="icon is-small is-left">
              <i class="fas fa-id-card-alt"></i>
            </div>
          </div>
          <div class="control is-expanded has-icons-left">
            <div class="select is-fullwidth">
              <select name="grade" id="select-grade">
                <option value="null" selected>Grade</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
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
<script type="text/javascript">
  const cacheInput = () => {
    store.set('name', $('#name').value)
    store.set('nis', $('#nis').value)
    store.set('major', $('#select-major').value)
    store.set('grade', $('#select-grade').value)
    store.set('class', $('#select-class').value)

  }

  const validateMajor = () => {
    let isDisable = $('#select-major').value === 'Teacher' ? true : false
    $('#select-class').disabled = isDisable
    $('#select-grade').disabled = isDisable
  }

  window.addEventListener('load', () => {
    $('#name').value = store.get('name') || ''
    $('#nis').value = store.get('nis') || ''
    $('#select-major').value = store.get('major')
    $('#select-grade').value = store.get('grade')
    $('#select-class').value = store.get('class')
    validateMajor()
  })

  $('#select-major').addEventListener('change', validateMajor)

  @if (Session::has('success'))
    toggleModal('green', 'Register Success', '{{ Session::get('success') }}')
    store.clear()
  @elseif ($errors->any())
    toggleModal('red', 'Register Error', '{{ $errors->first() }}')
  @endif
</script>
@endsection