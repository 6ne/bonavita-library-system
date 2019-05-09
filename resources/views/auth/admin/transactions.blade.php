@extends('layouts.app')
@section('title', 'Transactions')

@section('content')
<main class="container has-text-centered">
</main>
@endsection

@section('script')
  <script type="text/javascript">
    const showDetail = async (id) => {
        // @TODO munculin ini sebagai modal box datanya jangan kesamping tapi kebawah
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

      let borrowedAt = dateFormat(transaction.borrowed_at, 'ddd, DD MMM YYYY HH:mm:ss')

      let returnedAt = transaction.returned_at === null ?
        '-' :
        dateFormat(transaction.returned_at, 'ddd, DD MMM YYYY HH:mm:ss')


      // @TODO rapiin
      $('.modal-content').innerHTML = `
      <div>
        borrowername: ${borrowerName} |
        borrowernis: ${borrowerNis} |
        penalty : ${penalty} |
        status : ${transaction.is_active === 1 ? 'Active' : 'Nonactive'} |
        lend by : ${transaction.lend_by} |
        borrowed at : ${borrowedAt} |
        return to : ${transaction.returned_to === null ? '-' : transaction.returned_to} |
        returned at : ${returnedAt} |
      </div>
      `

      $('.modal').classList.toggle('is-active')
    }

    window.addEventListener('load', async () => {
      let transactions = null
      await getTransactions(res => {
        transactions = res
      })

      transactions.forEach(async transaction => {
        let book = null
        await getBook(esc(transaction.book_id), res => {
          book = res.title
        })

        let borrowerName = null
        await getUser(esc(transaction.user_id), res => {
          borrowerName = res.name
        })

        // @TODO munculin ini sebagai row table dengan
          $('main.container').innerHTML += `
          <div>
            Borrower name : ${borrowerName} |
            Book : ${book} |
            status : ${transaction.is_active === 1 ? 'Active' : 'Inactive'} |
            <button onclick="showDetail(${transaction.id})">Detail</button>
          </div>
          `
      })
    })
  </script>
@endsection