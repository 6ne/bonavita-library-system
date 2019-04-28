@extends('layouts.app')
@section('title', 'Books')

@section('content')
<main class="container has-text-centered">
  <div class="field">
    <div class="control has-icons-left search-bar">
      <input class="input is-large" type="text" placeholder="Search">
      <span class="icon is-medium is-left">
        <i class="fas fa-search"></i>
      </span>
    </div>
  </div>
</main>
@endsection

@section('script')
<script type="text/javascript">
  window.addEventListener('load', () => {
    req.get('/api/books').then(res => {
      console.log(store.get('books_on_held'))
      $('main.container').innerHTML += `
        <div class="tile is-ancestor anc-div first-anc">
        <div class="tile is-parent box">
        <div class="tile is-child">
        <div class="title is-5">Title</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5">Author</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5">Stock</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5"></div>
        </div>
        </div>
        </div
        `
      res.forEach(child => {

        console.log(child)
        $('main.container').innerHTML += `
        <div class="tile is-ancestor anc-div">
        <div class="tile is-parent box">
        <div class="tile is-child">
        <div class="subtitle">${child.title}</div>
        </div>
        <div class="tile is-child">
        <div class="subtitle">${child.author}</div>
        </div>
        <div class="tile is-child">
        <div class="subtitle">${child.stock}</div>
        </div>
        <div class="tile is-child">
        <span class="button is-success is-fullwidth req-btn" disabled="${store.get('books_on_held') == 2 ? true : false }">Request</span>
        </div>
        </div>
        </div>
        `
      })
    })
  })
</script>

@endsection