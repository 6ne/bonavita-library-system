@extends('layouts.app')
@section('title', 'Users')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/users-page.css') }}">
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="columns is-multiline first-columns">
    
  </div>
</main>
@endsection

@section('script')
<script type="text/javascript">
  window.addEventListener('load', async () => {
    let users = null
    await getUsers(res => {
      console.log(res)
      users = res
    })
    users.forEach(child => {
      $('.first-columns').innerHTML += `
      <div class="column is-one-third">
      <div class="columns message user-card box">
      <div class="column left-side-card" id="major-${child.id}">
      <div class="major">${child.major == 'Teacher' ? 'TCR' : `${child.major}`}</div>
      <div class="class">${(child.grade) == 0 || child.class == 0 ? '<div class="column"></div>' : `${child.grade}-${child.class}`}</div>
      </div>
      <div class="column">
      <div>${child.nis}</div>
      <div class="name">${child.name}</div>
      <div>Books: <span class="tag" id="onheld-${child.id}">${child.books_on_held}</span></div>
      <div class="detail-button button is-primary is-fullwidth is-rounded">
      <span class="icon is-small"><i class="fas fa-list-ul"></i></span>
      <span>Details</span>
      </div>
      </div>
      </div>
      </div>
      `

      // books_on_held
      if(child.books_on_held == 0){
        $(`#onheld-${child.id}`).setAttribute('class', 'tag is-primary')
      }
      else if(child.books_on_held == 1){
        $(`#onheld-${child.id}`).setAttribute('class', 'tag is-warning')
      }
      else{
        $(`#onheld-${child.id}`).setAttribute('class', 'tag is-danger')
      }

      // card
      if(child.major == 'TKJ'){
        $(`#major-${child.id}`).setAttribute('class', 'column left-side-card has-background-success')
      }
      else if(child.major == 'MM'){
        $(`#major-${child.id}`).setAttribute('class', 'column left-side-card has-background-danger')
      }
      else if(child.major == 'AK'){
        $(`#major-${child.id}`).setAttribute('class', 'column left-side-card has-background-warning')
      }
      else if(child.major == 'AP'){
        $(`#major-${child.id}`).setAttribute('class', 'column left-side-card has-background-info')
      }
      else if(child.major == 'Teacher'){
        $(`#major-${child.id}`).setAttribute('class', 'column left-side-card has-background-grey-lighter')
      }
      else {
        $(`#major-${child.id}`).setAttribute('class', 'column left-side-card has-background-grey-lighter')
      }
    })
  })
</script>
@endsection