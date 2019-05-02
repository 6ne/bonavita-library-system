@extends('layouts.app')
@section('title', 'Users')

@section('content')
<main class="container has-text-centered">
  <div class="columns">
    <div class="column">
      <div class="columns box">
        <div class="column">
          <span>TKJ</span>
        </div>
        <div class="column">
          <div class="columns">
            <div class="column">
              <div>ID</div>
              <div>Name</div>
            </div>
            <div class="column">
              <div>2011219829</div>
              <div>Clavin June</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="columns box">
        <div class="column">
          <span>MM</span>
        </div>
        <div class="column">
          <div>2101651035</div>
          <div>Jessica Tania J</div>
        </div>
      </div>
    </div>
    <div class="column">
      <div class="columns box">
        <div class="column">
          <span>TCR</span>
        </div>
        <div class="column">
          <span>Markidi</span>
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