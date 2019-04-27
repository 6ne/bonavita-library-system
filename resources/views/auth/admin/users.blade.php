@extends('layouts.app')
@section('title', 'Users')

@section('content')
<main class="container has-text-centered">
  <h1 class="title">Coming Soon</h1>
</main>
@endsection

@section('script')
<script type="text/javascript">
  window.addEventListener('load', async () => {
    await getUsers(res => {
      console.log(res)
    })
  })
</script>
@endsection