'use strict'
/* selector alias */
const $ = el => document.querySelector(el)
const $$ = el => document.querySelectorAll(el)

const store = {
  len: localStorage.length,
  set: (key, val) => { localStorage.setItem(key, val) },
  get: key => localStorage.getItem(key),
  del: key => { localStorage.removeItem(key) },
  clear: () => { localStorage.clear() }
}

const esc = str => {
  const _ = document.createElement('p')
  _.appendChild(document.createTextNode(str))
  return _.innerHTML.trim()
}

const go = url => {
  window.location = esc(url)
}

const num2idr = num => `Rp ${new Intl.NumberFormat('id-ID').format(esc(num))},-`

const dateFormat = (date, format='YYYY-MM-DD HH:mm:ss') => moment(date).format(format)

const dateNow = (format='YYYY-MM-DD HH:mm:ss') => dateFormat(moment.now(), format)

const dateNext = (number, unit='days', format='YYYY-MM-DD HH:mm:ss') => dateFormat(moment(dateNow()).add(number, unit))

const dateDiff = (a, b, unit) => moment(b).diff(moment(a), unit)

const isEmpty = obj => {
  for (let i in obj) if (obj.hasOwnProperty(i)) return false
  return true
}

const getBooks = async callback => {
  await req.get('/api/books').then(res => {
    callback(res)
  })
}

const getBook = async (id, callback) => {
  await req.get(`/api/books/${id}`).then(res => {
    callback(res)
  })
}

const createBook = async (data, callback=null) => {
  await req.post('/api/books', data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const updateBook = async  (id, data, callback=null) => {
  await req.put(`/api/books/${id}/update`, data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const deleteBook = async  (id, callback=null) => {
  await req.delete(`/api/books/${id}/delete`).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const searchBooks = async (data, callback) => {
  await req.post('/api/books/search', data).then(res => {
    callback(res)
  })
}

const getUsers = async callback => {
  await req.get('/api/users').then(res => {
    callback(res)
  })
}

const getUser = async (id, callback) => {
  await req.get(`/api/users/${id}`).then(res => {
    callback(res)
  })
}

const createUser = async (data, callback=null) => {
  await req.post('/api/users', data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const updateUser = async  (id, data, callback=null) => {
  await req.put(`/api/users/${id}/update`, data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const deleteUser = async  (id, callback=null) => {
  await req.delete(`/api/users/${id}/delete`).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const getNotificationsFor = async (id, callback) => {
  await req.get(`/api/notifications/${id}`).then(res => {
    callback(res)
  })
}

const getNewNotificationsFor = async (id, callback) => {
  await req.get(`/api/notifications/${id}/new`).then(res => {
    callback(res)
  }) 
}

const readNotificationFor = async (id, callback=null) => {
  await req.put(`/api/notifications/${id}/read`).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const updateNotification = async (id, data, callback=null) => {
  await req.put(`/api/notifications/${id}/update`, data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const createNotification = async (data, callback=null) => {
  await req.post('/api/notifications', data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const createTransaction = async (data, callback=null) => {
  await req.post('/api/transactions', data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}

const getTransactions = async callback => {
  await req.get('/api/transactions').then(res => {
    callback(res)
  })
}

const getTransaction = async (id, callback) => {
  await req.get(`/api/transactions/${id}`).then(res => {
    callback(res)
  })
}

const getDeadlineTransactions = async callback => {
  await req.get('/api/transactions/deadline').then (res => {
    callback(res)
  })
}

const getTodayTransactions = async callback => {
  await req.get('/api/transactions/today').then(res => {
    callback(res)
  })
}

const getTransactionsByUser = async (id, callback) => {
  await req.get(`/api/transactions/user/${id}`).then(res => {
    callback(res)
  })
}

const updateTransaction = async (id, data, callback) => {
  await req.put(`/api/transactions/${id}/update`, data).then(res => {
    if (callback != null) {
      callback(res)
    }
  })
}