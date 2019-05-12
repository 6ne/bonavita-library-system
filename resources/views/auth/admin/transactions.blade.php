@extends('layouts.app')
@section('title', 'Transactions')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/transaction.css') }}">
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="column heading is-paddingless">
    <figure class="image">
      <img src="{{ asset('heading/transactions.png') }}">
    </figure>
  </div>
</main>
@endsection

@section('script')
  <script type="text/javascript">

    const collectBook = async (user_id, book_id, transaction_id, dayPass, is_active) => {

      if ( is_active === 0 ) {
        return
      }

      await updateBook(esc(book_id), {
        'stock': 1
      })

      await updateUser(esc(user_id), {
        'books_on_held': -1
      })

      await updateTransaction(esc(transaction_id), {
        'is_active': esc(0),
        'returned_at': esc(dateNow()),
        'returned_to': esc(store.get('name')),
        'penalty': esc(dayPass < 0 ? 0 : dayPass * 1000)
      })

      toggleModal()
      $('main.container').innerHTML = ''
      loadTransaction()
    }

    const showDetail = async (id) => {
      let transaction = null
      await getTransaction(esc(id), res => {
        transaction = res
      })

      let book = null
      await getBook(esc(transaction.book_id), res => {
        book = res.title
      })

      let borrowerName = null
      let borrowerNis = null
      await getUser(esc(transaction.user_id), res => {
        borrowerName = res.name
        borrowerNis = res.nis
      })

      let penalty = num2idr(transaction.penalty)

      let borrowedAt = dateFormat(transaction.borrowed_at, 'ddd, DD MMM YYYY')

      let returnedAt = transaction.returned_at === null ?
        '-' :
        dateFormat(transaction.returned_at, 'ddd, DD MMM YYYY')

      $('.modal-content').innerHTML = `
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title has-text-centered has-text-white">Detail Transaction</p>
          </header>
          <section class="modal-card-body">
            <div style="display: flex">
              <div style="display: flex;flex-direction:column;flex-grow:1">
                <span class="subtitle">Borrower Name</span>
                <span class="subtitle">Borrower NIS</span>
                <span class="subtitle">Penalty</span>
                <span class="subtitle">Status</span>
                <span class="subtitle">Lend by</span>
                <span class="subtitle">Borrowed at</span>
                <span class="subtitle">Returned to</span>
                <span class="subtitle">
                  ${transaction.is_active === 1 ? 'Due Date' : 'Returned at'}
                  </span>
              </div>
              <div style="display: flex;flex-direction:column;flex-grow:1">
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
                <span class="subtitle">:</span>
              </div>
              <div style="display: flex;flex-direction:column;flex-grow:1">
                <span class="subtitle">${borrowerName}</span>
                <span class="subtitle">${borrowerNis}</span>
                <span class="subtitle">${penalty}</span>
                <span class="subtitle">
                  ${transaction.is_active === 1 ? 'Active' : 'Inactive'}
                </span>
                <span class="subtitle">${transaction.lend_by}</span>
                <span class="subtitle">${borrowedAt}</span>
                <span class="subtitle">
                  ${transaction.returned_to === null ? '-' : transaction.returned_to}
                </span>
                <span class="subtitle">
                  ${returnedAt}
                </span>
              </div>
            </div>
          </section>
          <footer class="modal-card-foot">
            <span class="button is-success is-fullwidth"
            ${ transaction.is_active === 0 ? 'disabled=true' : '' }
            onclick="collectBook(${transaction.user_id}, ${transaction.book_id}, ${id}, ${dateDiff(transaction.returned_at, dateNow(), 'days')}, ${transaction.is_active})">
              Collect
            </span>
          </footer>`

      $('.modal').classList.toggle('is-active')
    }

    const loadTransaction = async () => {
      let transactions = null
      await getTransactions(res => {
        transactions = res
      })


      $('main.container').innerHTML += `
        <div class="tile is-ancestor anc-div first-anc">
        <div class="tile is-parent message heading-transaction">
        <div class="tile is-child">
        <div class="title is-5">Borrower</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5">Book's Title</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5">Transaction Status</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5">Borrowed At</div>
        </div>
        <div class="tile is-child">
        <div class="title is-5">Action</div>
        </div>
        </div>
        </div>
        `

      transactions.forEach(async transaction => {
        let book = null
        await getBook(esc(transaction.book_id), res => {
          book = res.title
        })

        let borrowerName = null
        await getUser(esc(transaction.user_id), res => {
          borrowerName = res.name
        })

        let borrowedAt = dateFormat(transaction.borrowed_at, 'ddd, DD MMM YYYY')

        $('main.container').innerHTML += `
        <div class="tile is-ancestor anc-div">
        <div class="tile is-parent message transaction-list">
        <div class="tile is-child">
        <div class="subtitle">${borrowerName}</div>
        </div>
        <div class="tile is-child">
        <div class="subtitle">${book}</div>
        </div>
        <div class="tile is-child">
        <div class="subtitle tag ${transaction.is_active === 1 ? 'is-success' : 'is-danger'} is-medium">${transaction.is_active === 1 ? 'Active' : 'Inactive'}</div>
        </div>
        <div class="tile is-child">
        <div class="subtitle">${borrowedAt}</div>
        </div>
        <div class="tile is-child">
        <span class="button is-fullwidth detail-btn"
          onclick="showDetail(${transaction.id})">
          Detail
        </span>
        </div>
        </div>
        </div>
        `
      })
    }

    window.addEventListener('load', loadTransaction)
  </script>
@endsection