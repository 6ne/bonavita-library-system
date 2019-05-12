@extends('layouts.app')
@section('title', 'Books')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/book-page.css') }}">
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="column heading is-paddingless">
    <figure class="image">
      <img src="{{ asset('heading/booklist.png') }}">
    </figure>
  </div>
  <div class="field">
    <div class="control has-icons-left search-bar">
      <input class="input is-large" id="search" placeholder="Search" onkeyup="searchBook()">
      <span class="icon is-medium is-left">
        <i class="fas fa-search"></i>
      </span>
    </div>
  </div>
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
  <div id="books"></div>
</main>
@endsection

@section('script')
<script type="text/javascript">
  const searchBook = async () => {
    let books = null
    await searchBooks({
      'title': $('#search').value
    }, res => {
      books = res
    })

    $('main.container #books').innerHTML = ''

    books.forEach(book => {
      $('main.container #books').innerHTML += `
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
        ${store.get('books_on_held') == 2 || store.get('id') == 0 || book.stock == 0 ? 'disabled=true' : '' }
        onclick="borrowBook(${book.id})">
        Request
      </span>
      </div>
      </div>
      </div>
      `
    })
  }
  const borrowBook = id => {
    if (store.get('books_on_held') == 2 || store.get('id') == 0) {
      return
    }

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
    
    books.forEach(book => {
      $('main.container #books').innerHTML += `
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
      <span class="button is-fullwidth req-btn"
        ${store.get('books_on_held') == 2 || store.get('id') == 0 || book.stock == 0 ? 'disabled=true' : '' }
        onclick="borrowBook(${book.id})
        ">
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