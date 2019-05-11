window.addEventListener('load', () => {
  readAllNotifications()
  showAllNotifications()
})

setInterval(readAllNotifications, 5001)