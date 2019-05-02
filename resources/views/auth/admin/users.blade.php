@extends('layouts.app')
@section('title', 'Users')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/users-page.css') }}">
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="columns">
    <div class="column">
      <div class="columns message user-card box">
        <div class="column left-side-card">
          <div class="major">TKJ</div>
          <div class="class">12-2</div>
        </div>
        <div class="column">
          <div>2101651035</div>
          <div class="name">Clavin June</div>
          <div>Books: <span class="tag is-danger">2</span></div>
          <div class="detail-button button is-primary is-fullwidth is-rounded">
            <span class="icon is-small"><i class="fas fa-list-ul"></i></span>
            <span>Details</span>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="columns message user-card box">
        <div class="column">
          <div>MM</div>
          <div>11-1</div>
        </div>
        <div class="column">
          <div>2101651035</div>
          <div>Jessica Tania J</div>
          <div>Books on held : <span>2</span></div>
          <div class="detail-button button is-link is-fullwidth is-rounded">
            <span class="icon is-small"><i class="fas fa-list-ul"></i></span>
            <span>Details</span>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="columns message user-card box">
        <div class="column">
          <div>TCR</div>
        </div>
        <div class="column">
          <div>2101651035</div>
          <div>Markidi</div>
          <div>Books on held : <span>2</span></div>
          <div class="detail-button button is-link is-fullwidth is-rounded">
            <span class="icon is-small"><i class="fas fa-list-ul"></i></span>
            <span>Details</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('script')
<script type="text/javascript">
  window.addEventListener('load', async () => {
    await getUsers(res => {
      console.log(res)
      res.forEach(child => {
        console.log(child)
      })
    })
  })
</script>
@endsection