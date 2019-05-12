'use strict'

/* modalbox with message */
const toggleModal = (color='', header='', body='') => {
  $('.modal-content').innerHTML = renderMessage(color, header, body)
  $('.modal').classList.toggle('is-active')
}

const renderMessage = (color='', header='', body='') => {
  switch (color) {
    case 'red':
      color = 'is-danger'
      break
    case 'green':
      color = 'is-success'
      break
    case 'blue':
      color = 'is-link'
      break
    case 'yellow':
      color = 'is-warning'
      break
    default:
      color = 'is-dark'
  }

  return `
  <article class="message ${color}">
    <div class="message-header">
      <p>${header}</p> 
      <button class="delete" onclick="toggleModal()"></button>
    </div>
    <div class="message-body has-text-centered">
      ${body}
    </div>
  </article>`
}

const replyNotification = async (id, book_id, from, to, status, reason) => {
  updateNotification(esc(id), {
    status: esc(status),
    reason: esc(reason)
  })

  createNotification({
    book_id: esc(book_id),
    from: esc(store.get('real_id')),
    to: esc(from),
    status: esc(status),
    reason: esc(reason)
  })

  if (status == 'approved') {
    /*
     * @TODO user from books_on_held + 1
    */
    let user = null
    await getUser(esc(store.get('real_id')), res => {
      user = res.name
    })

    await createTransaction({
      user_id: esc(from),
      book_id: esc(book_id),
      lend_by: esc(user),
      returned_at: esc(dateNext(3))
    })

    await updateBook(esc(book_id), {
      'stock': -1
    })

    await updateUser(esc(from), {
      'books_on_held': 1
    })
  }

  let notifications = null
  await getNotificationsFor(esc(store.get('id')), res => {
    notifications = res
  })

  $('main.container').innerHTML = ''
  renderNotifications(notifications, 'append')
}

const renderNotifications = (res, mode) => {
  res.forEach( async item => {
    let book = null
    await getBook(esc(item.book_id), res => {
      book = res.title
    })

    let from = null
    await getUser(esc(item.from), res => {
      from = res.name
    })

    let newItem = document.createElement('div')
    newItem.classList.add('message')

    let replyBar = ''
    let message = ''

    switch (item.status) {
      case 'warning':
        newItem.classList.add('is-warning')
        if (item.to != 0) {
          message = `Don't forget to return your book titled [${book}] because the due date is today`
        }
      break
      case 'rejected':
        newItem.classList.add('is-danger')
        if (item.to != 0) {
          message = `You have been rejected to borrow [${book}] book by ${from}. ${item.reason}`
        }
        else {
          message = `The Admin has rejected ${from} to borrow [${book}] book.
          <div>Reason: ${item.reason}</div>
          <div>Rejected at ${dateFormat(item.updated_at, 'ddd, D MMM YYYY HH:mm:ss')}</div>`
        }
      break
      case 'approved':
        newItem.classList.add('is-info')
        if ( item.to != 0 ) {
          message = `You have been approved to borrow [${book}] book by ${from}. Don't forget to pick your book at the library`
        } else {
          message = `The Admin has approved ${from} to borrow a book titled [${book}].
          <div>Reason: ${item.reason}</div>
          <div>Approved at ${dateFormat(item.updated_at, 'ddd, D MMM YYYY HH:mm:ss')}</div>`
        }
      break
      case 'info':
        message = `${from} has a request to borrow [${book}] book`
        replyBar = `
          <input id="reason" class="input" placeholder="Reason">
          <a class="button has-text-white has-background-info"
            onclick="replyNotification(${item.id}, ${item.book_id}, ${item.from}, ${item.to}, 'approved', $('#reason').value)">
            Approve
          </a>
          <a class="button has-text-white has-background-danger"
            onclick="replyNotification(${item.id}, ${item.book_id}, ${item.from}, ${item.to}, 'rejected', $('#reason').value)">
            Reject
          </a>
        `
      break
    }

    // let x = moment(item.created_at)
    // let y = moment(Date.now())
    // console.log(Math.floor(moment.duration(y.diff(x)).asDays()))

    newItem.innerHTML = `
        <div class="message-header">
          <span>${dateFormat(item.created_at, 'ddd, D MMM YYYY')}</span>
          <span>${dateFormat(item.created_at, 'HH:mm:ss')}</span>
        </div>
        <div class="message-body">
          ${message}
          ${replyBar}
        </div>`

    if (mode === 'append') {
      $('main.container').append(newItem) 
    } else {
      $('main.container').insertBefore(newItem, $('main.container').childNodes[0])
    }
  })
}

const showNotification = (body) => {
  new Notification('Bonavita Library System', {
    body:body,
    icon: '/favicon.ico'
  })
}

/* check notification on page load */
window.addEventListener('load', async () => {
  if ('Notification' in window && Notification.permission !== 'granted') {
    Notification.requestPermission().then(permission => {
      if (permission === 'granted') {
        showNotification('Thank you for activate notification system!')
      }
    })
  }

  if (store.get('id') !== null) {
    let notifications = null
    await getNewNotificationsFor(esc(store.get('id')), res => {
      notifications = res
    })

    if (notifications.length > 0) {
      $('#notificationsNumber').innerHTML = `(${notifications.length})`
    }
  }
})

/* check update of new notification every 15 second */
setInterval( async() => {
  if (store.get('id') !== null) {
    let notifications = null
    await getNewNotificationsFor(esc(store.get('id')), res => {
      notifications = res
    })

    if (notifications.length > 0) {
      showNotification(`${notifications.length} new notifications`)
      $('#notificationsNumber').innerHTML = `(${notifications.length})`

      if (window.location.href.includes('notifications')) {
        let divider = document.createElement('div')
        divider.classList.add('has-text-centered')
        divider.innerHTML = `
          <span class="icon">
            <i class="fa fa-arrow-up"></i>
          </span>
          <span class="subtitle">Recent Update</span>
          <span class="icon">
            <i class="fa fa-arrow-up"></i>
          </span>`
        $('main.container').insertBefore(divider, $('main.container').childNodes[0])

        renderNotifications(notifications, 'insertBefore')
      }
    } else {
      $('#notificationsNumber').innerHTML = ''
    }
  }
}, 5000)

/* window on scroll */
window.addEventListener('scroll', () => {
  if (window.scrollY > 0) {
    $('.fab').style = 'opacity:1'
    $('.hero-head.navbar').style = 'background-color: rgba(96,120,234,0.5)'
  } else {
    $('.fab').style = 'opacity:0'
    $('.hero-head.navbar').style = ''
  }
})

/* fab on click */
$('.fab').addEventListener('click', () => {
  $('body').scrollIntoView()
})

/* modal background on click */
$('.modal-background').addEventListener('click', toggleModal)

/* burger menu on click */
$('.navbar-burger').addEventListener('click', () => {
  $('.navbar-burger').classList.toggle('is-active')
  $('.navbar-menu').classList.toggle('is-active')
})