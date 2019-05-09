@extends('layouts.app')
@section('title', 'Books')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/book-page.css') }}">
@endsection

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
  const borrowBook = id => {
    createNotification({
      book_id: esc(id),
      from: esc(store.get('id')),
      to: esc(0),
      status: esc('info'),
      reason: esc('')
    }, res => {
      toggleModal('green', 'Borrow Success', 'Successed borrowing book! Wait for the admin response, and check the notification page!')
    })
  }
  window.addEventListener('load', async () => {
    let books = null
    await getBooks(res => {
      books = res
    })

    $('main.container').innerHTML += `
      <div class="tile is-ancestor anc-div first-anc">
      <div class="tile is-parent message heading-book-list">
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
      </div>
      `

    books.forEach(book => {
      $('main.container').innerHTML += `
      <div class="tile is-ancestor anc-div">
      <div class="tile is-parent message book-list">
      <div class="tile is-child">
      <div class="subtitle">${book.title}</div>
      </div>
      <div class="tile is-child">
      <div class="subtitle">${book.author}</div>
      </div>
      <div class="tile is-child">
      <div class="subtitle">${book.stock}</div>
      </div>
      <div class="tile is-child">
      <span class="button is-success is-fullwidth req-btn"
        ${store.get('books_on_held') == 2 ? 'disabled=true' : '' }
        onclick="borrowBook(${book.id})">
        Request
      </span>
      </div>
      </div>
      </div>
      `
    })
  })
</script>

@endsection