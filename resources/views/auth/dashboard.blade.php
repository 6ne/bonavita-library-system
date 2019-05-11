@extends('layouts.app')
@section('title', 'Dashboard')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
<style type="text/css">
.column {
  margin: 10px;
}
</style>
@endsection

@section('content')
<main class="container has-text-centered">
  <div class="tabs is-centered is-fullwidth">
    <ul>
      <li class="is-active deadline-active" id="deadline">
        <a class="deadline">
          <span class="icon is-small"><i class="fas fa-calendar-times"></i></span>
          <span>Deadline</span>
        </a>
      </li>
      <li id="today">
        <a class="today">
          <span class="icon is-small"><i class="fas fa-calendar-day"></i></span>
          <span>Today</span>
        </a>
      </li>
    </ul>
  </div>
  <a class="button is-warning is-rounded">
    <span class="icon">
      <i class="fas fa-bell"></i>
    </span>
    <span>Remind All</span>
  </a>
  <div class="users-div" id="users">
    <div class="tile is-ancestor anc-div first-anc heading-list">
      <div class="tile is-parent message">
        <div class="tile is-child">
          <div class="title is-6">NIS</div>
        </div>
        <div class="tile is-child">
          <div class="title is-6">Title</div>
        </div>
        <div class="tile is-child">
          <div class="title is-6">Due Date</div>
        </div>
        <div class="tile is-child">
          <div class="title is-6">Day Pass</div>
        </div>
        <div class="tile is-child">
          <div class="title is-6">Penalty</div>
        </div>
        <div class="tile is-child">
          <div class="title is-6">Action</div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('script')
<script type="text/javascript">
  @if(Session::has('user'))
  store.set('id', "{{Session::get('user')->id}}")
  if ("{{Session::get('user')->is_admin}}" == true) {
    store.set('id', "0")
  }
  store.set('real_id', "{{Session::get('user')->id}}")
  store.set('name', "{{Session::get('user')->name}}")
  store.set('nis', "{{Session::get('user')->nis}}")
  store.set('major', "{{Session::get('user')->major}}")
  store.set('grade', "{{Session::get('user')->grade}}")
  store.set('class', "{{Session::get('user')->class}}")
  store.set('is_admin', "{{Session::get('user')->is_admin}}")
  store.set('books_on_held', "{{Session::get('user')->books_on_held}}")
  @endif

  let globalTransaction = []
  let globalState = 'deadline'

  const renderDeadlinedTransaction = async () => {
    let transactions = null
    await getDeadlineTransactions(res => {
      transactions = res
      globalTransaction = res
    })

    $('#users').innerHTML = ''

    if (transactions.length == 0) {
      $('#users').innerHTML += `
        <div>
          <h1 class="title">No Deadline Transactions</h1>
        </div>`
    } else {
      $('#users').innerHTML = `
        <div class="tile is-ancestor anc-div first-anc heading-list">
          <div class="tile is-parent message">
            <div class="tile is-child">
              <div class="title is-6">NIS</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Title</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Due Date</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Day Pass</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Penalty</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Action</div>
            </div>
          </div>
        </div>`
      transactions.forEach(transaction => {
        let dayPass = dateDiff(transaction.returned_at, dateNow(), 'days')
        dayPass = dayPass < 0 ? 0 : dayPass
        $('#users').innerHTML += `
          <div class="tile is-ancestor anc-div first-anc">
            <div class="tile is-parent message book-borrower-list">
              <div class="tile is-child">
                <div class="subtitle is-6">${transaction.nis}</div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6">${transaction.title}</div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6">
                  ${dateFormat(transaction.returned_at, 'ddd, D MMM YYYY')}
                  </div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6 tag is-danger is-rounded">
                  ${dayPass}
                </div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6">
                  ${ num2idr(dayPass * 1000) }
                </div>
              </div>
              <div class="tile is-child">
                <span class="button is-success is-fullwidth"
                  onclick="collectBook(${transaction.user_id},${transaction.book_id}, ${transaction.transaction_id}, ${dayPass})">
                  Collect
                </span>
              </div>
            </div>
          </div>
        `
      })
    }
  }

  const renderTodayTransaction = async () => {
    let transactions = null
    await getTodayTransactions(res => {
      transactions = res
      globalTransaction = res
    })

    $('#users').innerHTML = ''

    if (transactions.length == 0) {
      $('#users').innerHTML += `
        <div>
          <h1 class="title">No Books will be returned today</h1>
        </div>`
    } else {
      $('#users').innerHTML = `
        <div class="tile is-ancestor anc-div first-anc heading-list">
          <div class="tile is-parent message">
            <div class="tile is-child">
              <div class="title is-6">NIS</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Title</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Due Date</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Day Pass</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Penalty</div>
            </div>
            <div class="tile is-child">
              <div class="title is-6">Action</div>
            </div>
          </div>
        </div>`

      transactions.forEach(transaction => {
        let dayPass = dateDiff(transaction.returned_at, dateNow(), 'days')

        $('#users').innerHTML += `
          <div class="tile is-ancestor anc-div first-anc">
            <div class="tile is-parent message book-borrower-list">
              <div class="tile is-child">
                <div class="subtitle is-6">${transaction.nis}</div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6">${transaction.title}</div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6">
                  ${dateFormat(transaction.returned_at, 'ddd, D MMM YYYY')}
                  </div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6 tag is-danger is-rounded">
                  ${dayPass}
                </div>
              </div>
              <div class="tile is-child">
                <div class="subtitle is-6">
                  ${ num2idr(dayPass * 1000) }
                </div>
              </div>
              <div class="tile is-child">
                <span class="button is-success is-fullwidth"
                  onclick="collectBook(${transaction.user_id},${transaction.book_id}, ${transaction.transaction_id}, ${dayPass})">
                  Collect
                </span>
              </div>
            </div>
          </div>
        `
      })
    }
  }

  const renderUserTransaction = async () => {
    $('main.container').innerHTML = ''

    let columns = document.createElement('div')

    columns.classList.add('columns')
    columns.classList.add('is-centered')

    let transactions = null
    await getTransactionsByUser(store.get('id'), res => {
      transactions = res
      console.log(transactions)
    })

    transactions.forEach(async transaction => {
      let bookTitle = null
      let bookAuthor = null
      await getBook(transaction.book_id, res => {
        bookTitle = res.title
        bookAuthor = res.author
      })

      let borrowedAt = dateFormat(transaction.borrowed_at, 'ddd, D MMM YYYY')
      let returnedAt = dateFormat(transaction.returned_at, 'ddd, D MMM YYYY')

      let dayPass = dateDiff(transaction.returned_at, dateNow(), 'days')
      dayPass = dayPass < 0 ? 0 : dayPass
      columns.innerHTML += `
      <div class="column is-half">
        <div class="box">
          <h1 class="title">${bookTitle}</h1>
          <h2 class="subtitle">${bookAuthor}</h2>
          <div class="columns">
            <div class="column">
              <h2 class="title is-5">Transaction Date</h2>
              <h2 class="subtitle">${borrowedAt}</h2>
            </div>
            <div class="column">
              <h2 class="title is-5">Due Date</h2>
              <h2 class="subtitle">${returnedAt}</h2>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <span class="subtitle has-text-danger">Penalty</span>
              <span class="subtitle has-text-white tag is-medium is-danger">
                ${num2idr(dayPass * 1000)}
              </span>
            </div>
          </div>
        </div>
      </div>
    `
    })

    $('main.container').appendChild(columns)
  }

  const collectBook = async (user_id, book_id, transaction_id, dayPass) => {
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
      'penalty': esc(dayPass * 1000)
    })

    if ( globalState === 'deadline' ) {
      renderDeadlinedTransaction()
    } else {
      renderTodayTransaction()
    }
  }

  $('#deadline').addEventListener('click', () => {
    globalState = 'deadline'
    $('#deadline').classList.add('is-active')
    $('#deadline').classList.add('deadline-active')

    $('#today').classList.remove('is-active')
    $('#today').classList.remove('today-active')

    renderDeadlinedTransaction()
  })

  $('#today').addEventListener('click', () => {
    globalState = 'today'
    $('#today').classList.add('is-active')
    $('#today').classList.add('today-active')

    $('#deadline').classList.remove('is-active')
    $('#deadline').classList.remove('deadline-active')

    renderTodayTransaction()
  })


  if (store.get('is_admin') !== '0') {
    window.addEventListener('load', renderDeadlinedTransaction)
  } else {
    window.addEventListener('load', renderUserTransaction)
    }
  // window.addEventListener('load', async () => {
    
  // })
</script>
@endsection